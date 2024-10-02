<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BookChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
{
    $now = now(); // Mendapatkan tanggal dan waktu saat ini

    // Mengambil daftar judul buku yang memiliki transaksi pada bulan ini
    $bookIdsWithTransactions = Transaction::whereYear('loan_date', $now->year)
        ->whereMonth('loan_date', $now->month)
        ->distinct('book_id')
        ->pluck('book_id');

    // Dapatkan semua judul buku yang memiliki transaksi pada bulan ini
    $booksWithTransactions = Book::whereIn('id', $bookIdsWithTransactions)->get();

    // Cek apakah ada data transaksi
    if ($booksWithTransactions->isEmpty()) {
        // Jika tidak ada data transaksi, maka tidak perlu membuat grafik
        return $this->chart->barChart()->setTitle('Tidak ada data peminjaman bulan ini');
    }

    $datasets = [];
    $xAxisLabels = [];
    $colors = []; // Tambahkan array kosong untuk menyimpan warna

    $chartTitle = 'Data Peminjaman Buku ' . $now->isoFormat('MMMM - Y');

    // Buat array sementara untuk menyimpan total transaksi untuk setiap buku
    $tempData = [];

    foreach ($booksWithTransactions as $book) {
        // Mengambil transaksi hanya untuk buku dengan ID tertentu pada bulan ini
        $latestTransaction = Transaction::whereYear('loan_date', $now->year)
            ->whereMonth('loan_date', $now->month)
            ->where('book_id', $book->id)
            ->latest() // Mengambil transaksi terbaru berdasarkan tanggal
            ->first();

        // Cek apakah ada transaksi terbaru untuk buku ini
        if ($latestTransaction) {
            // Menambahkan jumlah count ke data sementara
            $totalTransactions = isset($tempData[$book->title]) ? $tempData[$book->title] : 0;
            $tempData[$book->title] = $totalTransactions + $latestTransaction->count;
        }
    }

    // Urutkan array sementara berdasarkan total transaksi secara descending
    arsort($tempData);

    foreach ($tempData as $bookTitle => $totalTransactions) {
        // Tambahkan judul buku ke sumbu X hanya jika ada transaksi
        $xAxisLabels[] = $bookTitle;

        // Simpan data dalam dataset dengan urutan yang benar
        $datasets[] = [
            'name' => $bookTitle,
            'data' => [$totalTransactions], 'kali dipinjam'
        ];
    }

    return $this->chart->barChart()
        ->setTitle($chartTitle)
        ->setXAxis($xAxisLabels)
        ->setDataset($datasets);
}

}

    