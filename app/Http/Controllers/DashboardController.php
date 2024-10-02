<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Rack;
use App\Models\User;
use App\Models\Cupboard;
use App\Models\RentLogs;
use App\Charts\BookChart;
use App\Charts\UsersChart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    //Super
    public function super(BookChart $chart, UsersChart $datachart)
    {
        $bookCount = Book::all()->count();
        $userCount = User::whereIn('work_id', [2,4])->where('status', 'active')->count();
        return view('super/dashboard-super', ['book_count' => $bookCount, 'user_count' => $userCount, 'chart' => $chart->build(), 'datachart' => $datachart->build()]);
    }

    //Admin
    public function index(Request $request, BookChart $chart, UsersChart $datachart)
    {
        $pagination = 2;
        $bookCount = Book::count();
        $transactionCount = Transaction::count();
        $userCount = User::where('role_id', 2)->where('status', 'active')->count();
        return view('admin/dashboard', ['book_count' => $bookCount, 'transaction_count' => $transactionCount, 'user_count' => $userCount, 'chart' => $chart->build(), 'datachart' => $datachart->build()])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }
    
    // public function message(Request $request)
    // {
    //     $pagination = 20;

    //     $query = Transaction::with(['user'])
    //     ->whereHas('user', function ($userQuery) {
    //         $userQuery->where('status', 'active');
    //     })->orderBy('created_at', 'desc');

    //     $transaction = $query->paginate($pagination);

    //     $admin = User::where('role_id', 1)->where('status', 'active')->get();
        
    //     return view('admin/message', ['admin' => $admin, 'transaction' => $transaction])->with('i', ($request->input('page', 1) - 1) * $pagination);
    // }

    public function message(Request $request)
    { 
        $pagination = 20;
        $transaction = Transaction::with(['user'])->get();
        $user = User::leftJoin('transactions', function($join) {
            $join->on('users.id', '=', 'transactions.user_id')
                 ->whereRaw('transactions.id = (select max(id) from transactions where user_id = users.id)');
                })->select('users.*', 'transactions.return_date')->where('work_id', 3)->where('status', 'active')
                ->get();
            $admin = User::where('work_id', 3)->where('status', 'active')->get();
        return view('admin/message', ['admin' => $admin, 'user' => $user, 'transaction' => $transaction])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function message_print()
    { 
        $user = User::where('role_id', 2)->where('status', 'active')->with('work')->get();
        $admin = User::where('role_id', 1)->where('status', 'active')->get();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('admin.message-print', ['user' => $user, 'admin' => $admin]);
        return $pdf->download('surat-'.Carbon::now()->timestamp.'.pdf');
    }

    public function message_print_non()
    { 
        $user = User::with('work')->get();
        $admin = User::where('role_id', 1)->where('status', 'active')->get();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('admin.message-print-non', ['user' => $user, 'admin' => $admin]);
        return $pdf->download('surat-'.Carbon::now()->timestamp.'.pdf');
    }

    public function message_print_id($id)
    { 
        $user = User::with('work')->where('id', $id)->first();
        $admin = User::where('role_id', 1)->where('status', 'active')->get();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('admin.message-print-id', ['user' => $user, 'admin' => $admin]);
        return $pdf->download('surat-'.Carbon::now()->timestamp.'.pdf');
    }

    public function place(Request $request)
    {
        $pagination = 10;
        $racks   = Rack::orderBy('created_at', 'desc')->paginate($pagination);
        $cupboards   = Cupboard::orderBy('created_at', 'desc')->paginate($pagination);
        return view('admin/place', ['cupboards' => $cupboards, 'racks' => $racks])->with('i', ($request->input('page', 1) - 1) * $pagination)->with('j', ($request->input('page', 1) - 1) * $pagination);
    }

    public function cupboardAdd()
    {
        return view('admin/cupboard-add');
    }

    public function storeCupboard(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:cupboards|max:100',
        ],[
        'name.required'=>'Nama Lemari Harus Diisi',
        'name.unique'=>'Nama Lemari Telah Digunakan',
        ]);
        $cupboard = Cupboard::create($request->all());
    return redirect('admin/places')->with('success', 'Lemari Berhasil Ditambahkan');
    }

    public function cupboardEdit($id)
    {
        $cupboard = Cupboard::where('id', $id)->first();
        return view('admin/cupboard-edit', ['cupboard' => $cupboard]);
    }

    public function cupboardUpdate(Request $request, $id)
    {
        $cupboard = Cupboard::where('id', $id)->first();

        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('cupboards')->ignore($cupboard->id),
                'max:100',
            ],
        ],[
            'name.required' => 'Nama Lemari Harus Diisi',
            'name.unique' => 'Nama Lemari Telah Digunakan',
        ]);

        // Perbarui nama kategori
        $cupboard->name = $request->name;
        $cupboard->save();
        return redirect('admin/places')->with('success', 'Lemari Berhasil Diperbarui');
    }

    public function rackAdd()
    {
        return view('admin/rack-add');
    }

    public function storeRack(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:racks|max:100',
        ],[
        'name.required'=>'Nama Rak Harus Diisi',
        'name.unique'=>'Nama Rak Telah Digunakan',
        ]);
        $racks = Rack::create($request->all());
    return redirect('admin/places')->with('success', 'Rak Berhasil Ditambahkan');
    }

    public function rackEdit($id)
    {
        $racks = Rack::where('id', $id)->first();
        return view('admin/rack-edit', ['racks' => $racks]);
    }

    public function rackUpdate(Request $request, $id)
    {
        $racks = Rack::where('id', $id)->first();

        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('racks')->ignore($racks->id),
                'max:100',
            ],
        ],[
            'name.required' => 'Nama Rak Harus Diisi',
            'name.unique' => 'Nama Rak Telah Digunakan',
        ]);

        // Perbarui nama kategori
        $racks->name = $request->name;
        $racks->save();
        return redirect('admin/places')->with('success', 'Lemari Berhasil Diperbarui');
    }
}
