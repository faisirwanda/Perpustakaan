<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Work;
use App\Charts\BookChart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    //admin
    public function index(Request $request)
    {
        $pagination = 20;
        $workId = $request->input('work_id');
        $date = $request->input('date'); // Ambil nilai bulan dan tahun dari inputan date

        $query = Transaction::with(['user', 'book'])
        ->whereHas('user', function ($userQuery) {
            $userQuery->where('status', 'active');
        })
        ->orderBy('created_at', 'desc');
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
                $query->whereDate('loan_date', $dateObj)
                        ->orWhereDate('return_date', $dateObj)
                        ->orWhereDate('deadline', $dateObj);
            });
        }

        $transactions = $query->paginate($pagination);
        

        $works = Work::where('id', '!=', 1)->pluck('name', 'id');

        return view('admin/transaction', [
            'transactions' => $transactions,
            'works' => $works
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    //Ekspor Semua Data
    public function exportAll()
    {
        return Excel::download(new TransactionExport(), 'Transaksi-'.Carbon::now()->format('d-m-Y-His').'.xlsx');
    }

    public function exportByWorkId($workId)
    {
    return Excel::download(new TransactionExport($workId), 'Transaksi-' . now()->format('d-m-Y-His') . '.xlsx');
    }

    public function transaction_report(Request $request)
    {
        $pagination = 20;
        $workId = $request->input('work_id');
        $date = $request->input('date'); // Ambil nilai bulan dan tahun dari inputan date
        $query = Transaction::with(['user', 'book'])->orderBy('created_at', 'desc');
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
                $query->whereDate('loan_date', $dateObj)
                        ->orWhereDate('return_date', $dateObj)
                        ->orWhereDate('deadline', $dateObj);
            });
        }
        $transaction = $query->paginate($pagination);
        $works = Work::where('id', '!=', 1)->pluck('name', 'id');
        return view('super/transaction-report', [
            'transaction' => $transaction,
            'works' => $works
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function export_transaction() 
    {
        return Excel::download(new TransactionExport(), 'Transaksi-'.Carbon::now()->format('d-m-Y-His').'.xlsx');    
    }
    
    public function export_transaction_ByWorkId($workId)
    {
    return Excel::download(new TransactionExport($workId), 'Transaksi-' . now()->format('d-m-Y-His') . '.xlsx');
    }

}
