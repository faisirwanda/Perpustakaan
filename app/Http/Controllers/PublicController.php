<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Rack;
use App\Charts\BookChart;
use App\Charts\DataChart;
use App\Models\BookOrder;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


class PublicController extends Controller
{
    // halaman index
    public function index( Request $request, BookChart $chart)
    {
        $transactions = Transaction::with(['book'])
        ->whereHas('book')
        ->orderBy('count', 'desc')
        ->paginate(1000);
        
        $latestBooks = Book::orderBy('created_at', 'desc')->get();
        $errorMessage = '';
        $relatedBooks = []; // Inisialisasi variabel $relatedBooks
        
        $search = $request->input('search');
        $pagination = 1000;

        $books = Book::where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhereHas('categories', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('rack', function ($rackQuery) use ($search) {
                    $rackQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('cupboard', function ($cupboardQuery) use ($search) {
                    $cupboardQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('publisher', 'like', '%' . $search . '%')
                ->orWhere('edition', 'like', '%' . $search . '%')
                ->orWhere('publication_year', 'like', '%' . $search . '%')
                ->orWhere('book_condition', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        })
        ->with(['categories', 'rack', 'cupboard'])
        ->orderBy('title')
        ->paginate($pagination);

        if ($books->isEmpty()) {
            $errorMessage = 'Buku Tidak Tersedia!!';
        }else {
            // Ambil beberapa buku terkait berdasarkan kategori atau penulis
            $relatedBooks = Book::where(function ($query) use ($search, $books) {
                // Kondisi untuk memfilter buku terkait
                $query->where('category_id', $books[0]->category_id) // Contoh: Ambil buku dengan kategori yang sama
                    ->orWhere('author', $books[0]->author); // Contoh: Ambil buku oleh penulis yang sama
            })
            ->where('id', '<>', $books[0]->id) // Hindari menampilkan buku yang sama
            ->limit(8) // Ambil 5 buku terkait
            ->get();
        }

        $books->appends(['search' => $search]); // Menambahkan parameter ke URL pagination

        return view('index', ['books' => $books, 'chart' => $chart->build(), 'latestBooks' => $latestBooks, 'errorMessage' => $errorMessage, 'transactions' => $transactions, 'relatedBooks' => $relatedBooks])
            ->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function regulation(){
        return view('regulation');
    }

    public function librarian(){
        $user = User::where('role_id', 1)->where('status', 'active')->orderBy('created_at', 'asc')->first();
        return view('librarian', ['user' => $user]);
    }

    

    public function book_detail($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        // $transactions = Transaction::with(['user', 'book'])->where('book_id', $book->id)
        //     ->whereNotNull('rating') // Hanya transaksi yang memiliki rating yang akan dihitung
        //     ->get();
        
        // Ambil semua transaksi yang terkait dengan buku yang memiliki judul yang sama
        $transactions = Transaction::with(['user', 'book'])
        ->whereHas('book', function ($query) use ($book) {
            $query->where('title', $book->title);
        })
        ->whereNotNull('rating')
        ->get();

        // Hitung jumlah judul buku yang sama
        // Hitung jumlah judul buku yang sama (kecuali buku yang sedang dilihat)
        $bookTitleCounts = Book::where('title', $book->title)->count();
        // ->where('id', '!=', $book->id) // Tambahkan kondisi ini untuk mengabaikan buku yang sedang dilihat
        $bookTitleAvailable = Book::where('title', $book->title)->where('status', 'Ada' )->count();

          // Hitung jumlah rating dari judul buku yang sama
        $bookTitleRatingCount = Transaction::whereHas('book', function ($query) use ($book) {
            $query->where('title', $book->title);
        })->whereNotNull('rating')->count();

        // Hitung rata-rata nilai rating 1 buku
        $averageRating = $transactions->avg('rating');

        // Hitung rata-rata rating dari judul buku yang sama
        $bookTitleAverageRating = Transaction::whereHas('book', function ($query) use ($book) {
            $query->where('title', $book->title);
        })->whereNotNull('rating')->avg('rating');

        $catgeories = Category::all();
        return view('book-detail', ['categories' => $catgeories, 'book' => $book,
        'averageRating' => $averageRating, 'transactions' => $transactions, 'bookTitleCounts' => $bookTitleCounts, 'bookTitleAvailable' => $bookTitleAvailable, 'bookTitleAverageRating' => $bookTitleAverageRating]);
    }

//fungsi list buku

//admin
    public function admin(Request $request)
    {
        $search = $request->input('search');
        $pagination = 20;
        $errorMessage = '';
        $relatedBooks = [];
        $books = []; // Variabel $books didefinisikan di luar kondisi

        $books = Book::where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhereHas('categories', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('rack', function ($rackQuery) use ($search) {
                    $rackQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('cupboard', function ($cupboardQuery) use ($search) {
                    $cupboardQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('publisher', 'like', '%' . $search . '%')
                ->orWhere('edition', 'like', '%' . $search . '%')
                ->orWhere('publication_year', 'like', '%' . $search . '%')
                ->orWhere('book_condition', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        })
        ->with(['categories', 'rack', 'cupboard'])
        ->orderBy('title')
        ->paginate($pagination);

        $books->appends(['search' => $search]); // Menambahkan parameter ke URL pagination
        
        if ($books->isEmpty()) {
            $errorMessage = 'Buku Tidak Tersedia';
        } else {
            // Ambil beberapa buku terkait berdasarkan kategori atau penulis
            $relatedBooks = Book::where(function ($query) use ($search, $books) {
                // Kondisi untuk memfilter buku terkait
                $query->where('category_id', $books[0]->category_id) // Contoh: Ambil buku dengan kategori yang sama
                    ->orWhere('author', $books[0]->author); // Contoh: Ambil buku oleh penulis yang sama
            })
            ->where('id', '<>', $books[0]->id) // Hindari menampilkan buku yang sama
            ->limit(8) // Ambil 5 buku terkait
            ->get();
        }
        $bookIds = $books->pluck('id')->toArray();
        $bookSlugs = $books->pluck('slug')->toArray();
        return view('admin/book-list', ['books' => $books, 'relatedBooks' => $relatedBooks, 'errorMessage' => $errorMessage, 'bookIds' => $bookIds,
        'bookSlugs' => $bookSlugs])
            ->with('i', ($request->input('page', 1) - 1) * $pagination);
    }


    public function book_detail_admin($slug)
    {
        $book = Book::where('slug', $slug)->first();

        // Ambil semua transaksi yang terkait dengan buku ini
        $transactions = Transaction::where('book_id', $book->id)
            ->whereNotNull('rating') // Hanya transaksi yang memiliki rating yang akan dihitung
            ->get();

        // Hitung jumlah judul buku yang sama (kecuali buku yang sedang dilihat)
        $bookTitleAvailable = Book::where('title', $book->title)->where('status', 'Ada' )->count();
        // ->where('id', '!=', $book->id) // Tambahkan kondisi ini untuk mengabaikan buku yang sedang dilihat
        $bookTitleCounts = Book::where('title', $book->title)->count();

        // Hitung rata-rata nilai rating
        $averageRating = $transactions->avg('rating');

        $categories = Category::all();
        
        return view('admin/book-detail', [
            'categories' => $categories,
            'book' => $book,
            'transactions' => $transactions,
            'averageRating' => $averageRating, 
            'bookTitleAvailable' => $bookTitleAvailable,
            'bookTitleCounts' => $bookTitleCounts,
            // Kirim rata-rata rating ke tampilan
        ]);
    }

    public function book_detail_user($slug)
    {
        $book = Book::where('slug', $slug)->first();

        // Ambil semua transaksi yang terkait dengan buku ini
        $transactions = Transaction::with(['user', 'book'])->where('book_id', $book->id)
            ->whereNotNull('rating') // Hanya transaksi yang memiliki rating yang akan dihitung
            ->get();

        // Hitung jumlah judul buku yang sama (kecuali buku yang sedang dilihat)
        $bookTitleCounts = Book::where('title', $book->title)->count();
        // ->where('id', '!=', $book->id) // Tambahkan kondisi ini untuk mengabaikan buku yang sedang dilihat
        $bookTitleAvailable = Book::where('title', $book->title)->where('status', 'Ada' )->count();
        
        // Hitung rata-rata nilai rating
        $averageRating = $transactions->avg('rating');

        $categories = Category::all();
        
        return view('user/book-detail', [
            'categories' => $categories,
            'book' => $book,
            'transactions' => $transactions,
            'averageRating' => $averageRating,
            'bookTitleCounts' => $bookTitleCounts, // Kirim rata-rata rating ke tampilan
            'bookTitleAvailable' => $bookTitleAvailable // Kirim rata-rata rating ke tampilan
        ]);
    }


//history
    public function history(Request $request)
    {
        $pagination = 20;
        $relatedBooks = [];

        // Ambil data transaksi yang pernah dilakukan oleh pengguna
        $transactions = Transaction::with(['user', 'book'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate($pagination);

        $orders = BookOrder::with(['user', 'book'])->get();

        // Inisialisasi array untuk menyimpan buku-buku terkait
        $excludeBookIds = [];

        // Loop melalui setiap transaksi untuk mengumpulkan buku terkait
        foreach ($transactions as $transaction) {
            // Tambahkan ID buku yang akan dihindari
            $excludeBookIds[] = $transaction->book_id;

            // Hentikan jika sudah mencapai batasan jumlah buku terkait yang diinginkan
            if (count($relatedBooks) >= 8) {
                break;
            }
        }

        // Ambil semua buku yang memiliki kategori atau penulis yang sama,
        // tetapi ID yang tidak termasuk dalam transaksi pengguna
        $relatedBooks = Book::whereNotIn('id', $excludeBookIds)
            ->where(function ($query) use ($transactions) {
                foreach ($transactions as $transaction) {
                    $book = $transaction->book;
                    $query->orWhere(function ($subquery) use ($book) {
                        $subquery->where('category_id', $book->category_id)
                            ->orWhere('author', $book->author);
                    });
                }
            })
            ->limit(8)
            ->get();

        return view('user/book-history-loan-user', [
            'transactions' => $transactions,
            'relatedBooks' => $relatedBooks,
            'orders' => $orders,
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function rating(Request $request, $id)
    {
        $pagination = 20;
        $transaction = Transaction::with(['user', 'book'])
            ->where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate($pagination);

        return view('user/book-rating-user', [
            'transaction' => $transaction,
        ])->with('i', ($request->input('page', 1) - 1) * $pagination); 
    }

    public function store(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $validated = $request->validate([
            'rating' => 'required|max:255',
            'comment' => 'required|max:255',
        ], [
            'rating.required' => 'Rating Harus Diisi',
            'comment.required' => 'Komentar Harus Diisi',
        ]);
    
        // Perbarui nilai rating dan komentar pada transaksi yang sesuai
        Transaction::where('id', $id)
            ->where('user_id', $user_id)
            ->update([
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);
        return redirect('user/book-history-loan-user')->with('success', 'Penilaian Buku Berhasil');
    }
    
//super
    public function super(Request $request)
    {
        $search = $request->input('search');
        $pagination = 20;
        $errorMessage = '';
        $relatedBooks = [];
        $books = []; 
        $books = Book::where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhereHas('categories', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('rack', function ($rackQuery) use ($search) {
                    $rackQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('cupboard', function ($cupboardQuery) use ($search) {
                    $cupboardQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('publisher', 'like', '%' . $search . '%')
                ->orWhere('edition', 'like', '%' . $search . '%')
                ->orWhere('publication_year', 'like', '%' . $search . '%')
                ->orWhere('book_condition', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        })
        ->where('book_condition', 'Baik')
        ->with(['categories', 'rack', 'cupboard'])
        ->orderBy('title')
        ->paginate($pagination);

        $books->appends(['search' => $search]); // Menambahkan parameter ke URL pagination
        
        if ($books->isEmpty()) {
            $errorMessage = 'Buku Tidak Tersedia';
        } else {
            // Ambil beberapa buku terkait berdasarkan kategori atau penulis
            $relatedBooks = Book::where(function ($query) use ($search, $books) {
                // Kondisi untuk memfilter buku terkait
                $query->where('category_id', $books[0]->category_id) // Contoh: Ambil buku dengan kategori yang sama
                    ->orWhere('author', $books[0]->author); // Contoh: Ambil buku oleh penulis yang sama
            })
            ->where('id', '<>', $books[0]->id) // Hindari menampilkan buku yang sama
            ->limit(8) // Ambil 5 buku terkait
            ->get();
        }
        $bookIds = $books->pluck('id')->toArray();
        $bookSlugs = $books->pluck('slug')->toArray();
        return view('super/book-list-super', ['books' => $books, 'relatedBooks' => $relatedBooks, 'errorMessage' => $errorMessage, 'bookIds' => $bookIds,
        'bookSlugs' => $bookSlugs])
            ->with('i', ($request->input('page', 1) - 1) * $pagination);
    }
    

    public function book_detail_super($slug)
    {
        $book = Book::where('slug', $slug)->first();

        // Ambil semua transaksi yang terkait dengan buku ini
        $transactions = Transaction::where('book_id', $book->id)
            ->whereNotNull('rating') // Hanya transaksi yang memiliki rating yang akan dihitung
            ->get();

        // Hitung jumlah judul buku yang sama (kecuali buku yang sedang dilihat)
        $bookTitleCounts = Book::where('title', $book->title)->count();
        // ->where('id', '!=', $book->id) // Tambahkan kondisi ini untuk mengabaikan buku yang sedang dilihat
        $bookTitleAvailable = Book::where('title', $book->title)->where('status', 'Ada' )->count();

        // Hitung rata-rata nilai rating
        $averageRating = $transactions->avg('rating');

        $categories = Category::all();
        
        return view('super/book-detail', [
            'categories' => $categories,
            'book' => $book,
            'transactions' => $transactions,
            'averageRating' => $averageRating,
            'bookTitleCounts' => $bookTitleCounts, // Kirim rata-rata rating ke tampilan
            'bookTitleAvailable' => $bookTitleAvailable // Kirim rata-rata rating ke tampilan
        ]);
    }
    
}
