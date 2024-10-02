<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Guest;
use App\Exports\GuestExport;
use App\Models\Book;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    //admin
    public function index(Request $request)
    {
        $pagination = 20;
        $date = $request->input('date'); // Ambil nilai bulan dan tahun dari inputan date
        $query = Guest::orderBy('created_at', 'desc');

        if ($date) {
            $dateObj = Carbon::createFromFormat('Y-m-d', $date); // Mengubah format menjadi "Y-m-d"
            $query->where(function ($query) use ($dateObj) {
                $query->whereDate('created_at', $dateObj);
            });
        }

        $guests = $query->paginate($pagination);

        $works = Work::where('id', '!=', 1)->pluck('name', 'id');

        return view('admin/guest', [
            'guests' => $guests,
            'works' => $works
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function exportPdf()
    {
        $guests = Guest::all();
        $pdf = Pdf::loadView('admin.guest-export',['guests' => $guests] );
        return $pdf->download('guest-'.Carbon::now()->timestamp.'.pdf');    
    }

    public function add()
    {
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        return view('guest-add', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request['created_at'] = Carbon::now()->toDateString();
        $validated = $request->validate([
            'username' => 'required',
            
        ],[
            'username.required'=>'Nama Harus Diisi',
        ]);
        $guest = Guest::create($request->all());
        return redirect('guest-add')->with('success', 'Data Berhasil Disimpan');
    }
    

    //Ekspor Semua Data
    public function exportAll()
    {
        return Excel::download(new GuestExport(), 'Tamu-'.Carbon::now()->format('d-m-Y-His').'.xlsx');
    }
    //Ekspor Berdasarkan Id
    public function exportByWorkId($workId)
    {
    return Excel::download(new GuestExport($workId), 'Tamu-' . now()->format('d-m-Y-His') . '.xlsx');
    }

    public function guest_report(Request $request)
    {
        $pagination = 20;
        $date = $request->input('date'); // Ambil nilai bulan dan tahun dari inputan date
        $query = Guest::orderBy('created_at', 'desc');
        if ($date) {
            $dateObj = Carbon::createFromFormat('Y-m-d', $date); // Mengubah format menjadi "Y-m-d"
            $query->where(function ($query) use ($dateObj) {
                $query->whereDate('created_at', $dateObj);
            });
        }
        $guest = $query->paginate($pagination);
        $works = Work::where('id', '!=', 1)->pluck('name', 'id');
        return view('super/guest-report', [
            'guest' => $guest,
            'works' => $works
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function guest_export() 
    {
        return (new GuestExport)->download('Tamu-'.Carbon::now()->timestamp.'.xlsx');
    }

}
