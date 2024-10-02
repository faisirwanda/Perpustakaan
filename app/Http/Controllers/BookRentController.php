<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Work;
use App\Models\BookOrder;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    //admin
    public function index(Request $request)
    {
        $pagination = 20;
        
        $workId = $request->input('work_id');
        $date = $request->input('date'); // Ambil nilai bulan dan tahun dari inputan date

        $query = BookOrder::with(['user', 'book'])->orderBy('created_at', 'desc');

        if ($workId) {
            if ($workId !== 1) {
                $query->whereHas('user', function ($query) use ($workId) {
                    $query->where('work_id', $workId);
                });
            } else {
                $query->whereDoesntHave('user');
            }
        }

        if ($date) {
            $dateObj = Carbon::createFromFormat('Y-m-d', $date); // Mengubah format menjadi "Y-m-d"
            $query->where(function ($query) use ($dateObj) {
                $query->whereMonth('created_at', $dateObj->month)
                    ->whereYear('created_at', $dateObj->year);
            });
        }

        $orders = $query->paginate($pagination);
        

        $works = Work::where('id', '!=', 1)->pluck('name', 'id');

        return view('admin/book-rent', [
            'orders' => $orders,
            'works' => $works,
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function approve($id)
    {
        // Ambil data BookOrder berdasarkan ID yang diberikan
        $bookOrder = BookOrder::find($id);

        // Periksa apakah data BookOrder ada
        if ($bookOrder) {
            // Ambil data User berdasarkan user_id pada BookOrder
            $user = User::findOrFail($bookOrder->user_id);

            // Cek apakah work_id dari user bukan 3
            if ($user->work_id != 3) {
                $loan_date = Carbon::now()->toDateString();
                $deadline = Carbon::now()->addMonth(6)->toDateString();
            } else {
                $loan_date = Carbon::now()->toDateString();
                $deadline = Carbon::now()->addDay(3)->toDateString();
            }

            // Ambil data buku yang akan dipinjam
            $book = Book::findOrFail($bookOrder->book_id);

            // Ambil data transaksi sebelumnya untuk buku yang sama
            $previousTransaction = Transaction::where('book_id', $book->id)
                ->orderBy('count', 'desc')
                ->first();

                if ($bookOrder->status === 'Perpanjangan' && $previousTransaction) {
                    $return_date = Carbon::now()->toDateString();
                    // Ubah nilai return_date pada $previousTransaction
                    $previousTransaction->return_date = $return_date;
                
                    // Simpan perubahan ke dalam database
                    $previousTransaction->save();
                }

            // Hitung nilai count baru
            $newTransactionCount = ($previousTransaction ? $previousTransaction->count : 0) + 1;

            // Tambahkan kondisi untuk mengatur nilai description berdasarkan status bookOrder
            $description = ($bookOrder->status === 'Perpanjangan') ? 'Perpanjangan' : '';

            // Simpan data ke tabel Transaction
            Transaction::create([
                'user_id' => $bookOrder->user_id,
                'book_id' => $bookOrder->book_id,
                'loan_date' => $loan_date,
                'deadline' => $deadline,
                'count' => $newTransactionCount, // Nilai count berdasarkan perhitungan
                'description' => $description, // Tambahkan nilai description
            ]);

            // Hapus catatan BookOrder yang sesuai
            $bookOrder->delete();

            // Ubah status buku menjadi 'Dipinjam'
            $book->status = 'Dipinjam';
            $book->save();

            return redirect('admin/book-rent')->with('success', 'Peminjaman Berhasil');
        } else {
            // Jika data BookOrder tidak ditemukan, atasi kesalahan
            // Misalnya, arahkan kembali dengan pesan kesalahan
            return redirect()->back()->with('error', 'Pengajuan Peminjaman tidak ditemukan.');
        }
    }

    public function order()
    {
        // $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get(); 
        $users = User::where('role_id', 2)->where('status', 'active')->get(); //kondisi 2
        $books = Book::where('book_condition', 'baik')->where('status', 'Ada')->orderBy('title')->get();
        return view('admin/book-rent-add', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ], [
            'user_id.required' => 'User Harus Diisi',
            'book_id.required' => 'Buku Harus Diisi',
        ]);

        $users = User::findOrFail($request->user_id);

        if ($users['work_id'] != 3) {
            $request['loan_date'] = Carbon::now()->toDateString();
            $request['deadline'] = Carbon::now()->addMonth(6)->toDateString();
        } else {
            $request['loan_date'] = Carbon::now()->toDateString();
            $request['deadline'] = Carbon::now()->addDay(3)->toDateString();
        }

        $book = Book::findOrFail($request->book_id);

        if ($book['status'] != 'Ada') {
            return redirect('admin/book-rent-add')->with('error', 'Buku Sedang dipinjam');
        } else {
            $count = Transaction::where('user_id', $request->user_id)
                                ->where('return_date', null)
                                ->count();

            if ($count >= 3) {
                return redirect('admin/book-rent-add')->with('error', 'Tidak Bisa Meminjam, Anggota Sudah Mencapai Limit Peminjaman Buku');
            } else {
                try {
                    DB::beginTransaction();

                    //proses insert to transaction table
                    $latestTransaction = Transaction::where('book_id', $book->id)
                                                    ->latest('count')
                                                    ->first();

                    $userTransactionCount = ($latestTransaction ? $latestTransaction->count : 0) + 1;

                    $requestData = $request->all();
                    $requestData['count'] = $userTransactionCount;

                    Transaction::create($requestData);

                    //proses update book table
                    $book->status = 'Dipinjam';
                    $book->save();

                    DB::commit();

                    return redirect('admin/book-rent-add')->with('success', 'Peminjaman Berhasil');

                } catch (\Throwable $th) {
                    DB::rollBack();
                    dd($th);
                }
            }
        }
    }


    public function returnBook()
    { 
        $users = User::where('role_id', 2)->where('status', 'active')->whereHas('transactions', function($query) 
        {
            $query->whereNull('return_date');
        })
        ->get();
        $books = Book::where('book_condition', 'Baik')->where('status', 'Dipinjam')->orderBy('title')->get();
        return view('admin/return-book', ['users' => $users, 'books'=>$books]);
    }
  
    public function saveReturnBook(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'book_condition' => 'required',
            'punishment' => 'required_if:book_condition,Rusak,Hilang',
            'description' => 'required_if:book_condition,Rusak,Hilang'
        ],[
            'user_id.required'=>'User Harus Diisi',
            'book_id.required'=>'Buku Harus Diisi',
            'book_condition.required'=>'Kondisi Buku Harus Diisi',
            'punishment.required_if' => 'Denda Harus Diisi Jika Buku Rusak atau Hilang',
            'description.required_if' => 'Keterangan Harus Diisi Jika Buku Rusak atau Hilang'
        ]);

        $transaction = Transaction::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->where('return_date', null);

        $transactionData = $transaction->first();
        $countData = $transaction->count();

        if ($countData == 1) {
            try {
                DB::beginTransaction();
                // $transactionData->return_date = Carbon::now()->addDays(4)->toDateString();
                $transactionData->return_date = Carbon::now()->toDateString();

                $transactionData->book_condition = $request->book_condition;
                $transactionData->description = $request->description;

                // Hitung denda jika buku dikembalikan terlambat
                if ($transactionData->deadline < $transactionData->return_date) {
                    $daysLate = $transactionData->deadline->diffInDays($transactionData->return_date);
                    $punishmentLate = $daysLate * 1000; // Denda 1000 per hari

                    $punishment = $request->book_condition === 'Rusak' || $request->book_condition === 'Hilang' ? $request->punishment : null;

                    $totalPunishment = $punishmentLate + $punishment;

                    $transactionData->punishment = $totalPunishment;
                    // $transactionData->punishment += $punishment;    
                } 
                else if ($transactionData->deadline > $transactionData->return_date){
                    
                    $transactionData->punishment = $request->book_condition === 'Rusak' || $request->book_condition === 'Hilang' ? $request->punishment : null; 
                }

                $transactionData->save();
                $book = Book::findOrFail($request->book_id);
                $book->status = 'Ada';
                $book->save();

                DB::commit();

                return redirect('admin/book-return')->with('success', 'Pengembalian Buku Berhasil');
            } catch (\Throwable $th) {
                DB::rollBack();

                return redirect('admin/book-return')->with('error', 'Terjadi kesalahan saat menyimpan pengembalian buku.'.$th->getMessage());
            }
        } else {
            return redirect('admin/book-return')->with('error', 'Pengembalian Buku Gagal, Anggota Atau Buku Yang Dipinjam Tidak Valid');
        }
    }

    public function loan($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $user = Auth::user();

        $bookOrderCount = BookOrder::where('user_id', $user->id)->count();
        $transactionCount = Transaction::where('user_id', $user->id)
                                        ->where('return_date', null)
                                        ->count();
        // Maksimal total peminjaman yang diizinkan adalah 3
        $maxTotalLoans = 3;
        if ($bookOrderCount + $transactionCount >= $maxTotalLoans) {
            return redirect('user/dashboard-user')->with('error', 'Tidak Bisa Melakukan Pengajuan Peminjaman Buku Karena Anda Mencapai Limit Peminjaman Buku');
        } else {
            if ($book && $user) {
                $status = $book->status;

                if ($status == 'Ada') {
                    $book->status = 'Dipesan';
                    $book->save();
                    $bookOrder = new BookOrder();
                    $bookOrder->book_id = $book->id;
                    $bookOrder->user_id = $user->id;
                    $bookOrder->status = 'Peminjaman';
                    $bookOrder->save();

                    return redirect('user/dashboard-user')->with('success', 'Pengajuan Peminjaman Buku Berhasil!!');
                } elseif ($status == 'Dipesan') {
                    return redirect('user/dashboard-user')->with('error', 'Buku sudah dipesan!');
                } else {
                    return redirect('user/dashboard-user')->with('error', 'Buku Telah Dipinjam');
                }
            } else {
                return redirect('user/dashboard-user')->with('error', 'Buku tidak ditemukan atau user tidak valid!');
            }
        }
    }


    public function cancel($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $user = Auth::user(); // Mengambil nilai user id

        if ($book && $user) {
            // Periksa nilai status buku
            $status = $book->status;

            if ($status == 'Dipesan') {
                // Ubah status menjadi 'Ada'
                $book->status = 'Ada';
                $book->save();

                // Cari data pesanan buku yang sesuai dengan buku yang dipesan dan user yang sedang masuk (logged in)
                $bookOrder = BookOrder::where('book_id', $book->id)
                    ->where('user_id', $user->id)
                    ->first();

                if ($bookOrder) {
                    // Jika data pesanan buku ditemukan, hapus data dari tabel book_orders
                    $bookOrder->delete();
                    return redirect('user/dashboard-user')->with('success', 'Pengajuan Peminjaman Buku Dibatalkan!!');
                } else {
                    // Jika data pesanan buku tidak ditemukan (kemungkinan terhapus sebelumnya), berikan pesan kesalahan
                    return redirect('user/dashboard-user')->with('error', 'Data pesanan buku tidak ditemukan!');
                }
            } elseif ($status == 'Ada') {
                // Jika buku tidak dipesan, berikan pesan kesalahan
                return redirect('user/dashboard-user')->with('error', 'Buku tidak dipesan!');
            } else {
                // Status buku tidak diketahui atau tidak valid
                return redirect('user/dashboard-user')->with('error', 'Buku Telah Dipinjam');
            }
        } else {
            // Buku tidak ditemukan berdasarkan slug yang diberikan atau user tidak valid
            return redirect('user/dashboard-user')->with('error', 'Buku tidak ditemukan atau user tidak valid!');
        }
    }

    public function extra($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $user = Auth::user(); // Mengambil nilai user id
        
        $bookOrderCount = BookOrder::where('user_id', $user->id)->count();
        $transactionCount = Transaction::where('user_id', $user->id)
                                        ->where('return_date', null)
                                        ->count();

        if ($bookOrderCount >= 3) {
            return redirect('user/book-history-loan-user')->with('error', 'Anda Sudah Mencapai Limit Pengajuan Peminjaman Buku');
        }
         elseif ($transactionCount >= 4) {
            return redirect('user/book-history-loan-user')->with('error', 'Tidak Bisa Melakukan Pengajuan Peminjaman Buku Karena Anda Mencapai Limit Peminjaman Buku');
        }
         else {
            if ($book && $user && $transactionCount) {
                // Periksa nilai status buku
                $status = $book->status;
                if ($status == 'Dipinjam') {
                    // Ubah status menjadi 'Dipesan'
                    $book->status = 'Perpanjangan';
                    $book->save();

                    // Simpan data ke dalam tabel book_orders
                    $bookOrder = new BookOrder();
                    $bookOrder->book_id = $book->id;
                    $bookOrder->user_id = $user->id;
                    $bookOrder->status = 'Perpanjangan';
                    $bookOrder->save();
                    
                    return redirect('user/book-history-loan-user')->with('success', 'Pengajuan Perpanjangan Buku Berhasil!!');
                } elseif ($status == 'Dipesan') {
                    // Jika buku sudah dipesan, berikan pesan kesalahan
                    return redirect('user/book-history-loan-user')->with('error', 'Buku sudah dipesan!');
                } else {
                    // Status buku tidak diketahui atau tidak valid
                    return redirect('user/book-history-loan-user')->with('error', 'Buku Telah Dipinjam');
                }
            } else {
                // Buku tidak ditemukan berdasarkan slug yang diberikan atau user tidak valid
                return redirect('user/book-history-loan-user')->with('error', 'Buku tidak ditemukan atau user tidak valid!');
            }
        }
    }


    public function extra_cancel($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $user = Auth::user(); // Mengambil nilai user id

        if ($book && $user) {
            // Periksa nilai status buku
            $status = $book->status;

            if ($status == 'Perpanjangan') {
                // Ubah status menjadi 'Ada'
                $book->status = 'Dipinjam';
                $book->save();

                // Cari data pesanan buku yang sesuai dengan buku yang dipesan dan user yang sedang masuk (logged in)
                $bookOrder = BookOrder::where('book_id', $book->id)
                    ->where('user_id', $user->id)
                    ->first();

                if ($bookOrder) {
                    // Jika data pesanan buku ditemukan, hapus data dari tabel book_orders
                    $bookOrder->delete();
                    return redirect('user/book-history-loan-user')->with('success', 'Pengajuan Perpanjangan Buku Dibatalkan!!');
                } else {
                    // Jika data pesanan buku tidak ditemukan (kemungkinan terhapus sebelumnya), berikan pesan kesalahan
                    return redirect('user/book-history-loan-user')->with('error', 'Data pesanan buku tidak ditemukan!');
                }
            } elseif ($status == 'Ada') {
                // Jika buku tidak dipesan, berikan pesan kesalahan
                return redirect('user/book-history-loan-user')->with('error', 'Buku tidak dipesan!');
            } else {
                // Status buku tidak diketahui atau tidak valid
                return redirect('user/book-history-loan-user')->with('error', 'Buku Telah Dipinjam');
            }
        } else {
            // Buku tidak ditemukan berdasarkan slug yang diberikan atau user tidak valid
            return redirect('user/book-history-loan-user')->with('error', 'Buku tidak ditemukan atau user tidak valid!');
        }
    }

}
