<?php

namespace App\Charts;

use App\Models\Transaction;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    // public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    // {
    //     // Lakukan query untuk mengambil data transaksi beserta user yang melakukannya
    //     $transactions = Transaction::with('user')->get();

    //     // Inisialisasi array data
    //     $data = [];

    //     // Inisialisasi array untuk menyimpan total transaksi untuk setiap user
    //     $totalTransactionsByUser = [];

    //     // Inisialisasi array untuk menyimpan semua nama pengguna
    //     $userNames = [];

    //     // Loop melalui setiap transaksi dan tambahkan data ke dalam array
    //     foreach ($transactions as $transaction) {
    //         // Anda dapat mengakses informasi user seperti nama dari relasi 'user'
    //         $userName = $transaction->user->username; // Ubah 'username' sesuai dengan kolom yang Anda inginkan dari model User

    //         // Tambahkan nama pengguna ke array jika belum ada
    //         if (!in_array($userName, $userNames)) {
    //             $userNames[] = $userName;
    //         }

    //         // Hitung total transaksi untuk user ini
    //         $totalTransactions = isset($totalTransactionsByUser[$userName]) ? $totalTransactionsByUser[$userName] : 0;
    //         $totalTransactions += 1; // Misalnya, Anda ingin menambah 1 untuk setiap transaksi

    //         // Simpan total transaksi kembali ke array totalTransactionsByUser
    //         $totalTransactionsByUser[$userName] = $totalTransactions;
    //     }

    //     foreach ($totalTransactionsByUser as $userName => $totalTransactions) {
    //         // Simpan data dalam array
    //         $data[] = [
    //             'x' => $userName, // Nama user akan digunakan di sumbu X
    //             'y' => $totalTransactions, // Jumlah transaksi akan digunakan sebagai nilai pada grafik
    //         ];
    //     }

    //     // Buat objek grafik Pie Chart
    //     return $this->chart->pieChart()
    //         ->addData(array_values($totalTransactionsByUser), $userNames)
    //         ->setLabels($userNames);
    // }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
{
    $now = now(); // Mendapatkan tanggal dan waktu saat ini
    $chartTitle = 'Data Peminjaman Anggota ' . $now->isoFormat('MMMM - Y');
    // Lakukan query untuk mengambil data transaksi beserta user yang melakukannya
    $transactions = Transaction::with('user')
        ->whereYear('loan_date', $now->year)
        ->whereMonth('loan_date', $now->month)
        ->get();

    // Inisialisasi array data
    $data = [];

    // Inisialisasi array untuk menyimpan total transaksi untuk setiap user
    $totalTransactionsByUser = [];

    // Inisialisasi array untuk menyimpan semua nama pengguna
    $userNames = [];

    // Loop melalui setiap transaksi dan tambahkan data ke dalam array
    foreach ($transactions as $transaction) {
        // Anda dapat mengakses informasi user seperti nama dari relasi 'user'
        $userName = $transaction->user->username; // Ubah 'username' sesuai dengan kolom yang Anda inginkan dari model User

        // Tambahkan nama pengguna ke array jika belum ada
        if (!in_array($userName, $userNames)) {
            $userNames[] = $userName;
        }

        // Hitung total transaksi untuk user ini
        $totalTransactions = isset($totalTransactionsByUser[$userName]) ? $totalTransactionsByUser[$userName] : 0;
        $totalTransactions += 1; // Misalnya, Anda ingin menambah 1 untuk setiap transaksi

        // Simpan total transaksi kembali ke array totalTransactionsByUser
        $totalTransactionsByUser[$userName] = $totalTransactions;
    }

    foreach ($totalTransactionsByUser as $userName => $totalTransactions) {
        // Simpan data dalam array
        $data[] = [
            'x' => $userName, // Nama user akan digunakan di sumbu X
            'y' => $totalTransactions, // Jumlah transaksi akan digunakan sebagai nilai pada grafik
        ];
    }

    // Buat objek grafik Pie Chart
    return $this->chart->pieChart()
        ->setTitle($chartTitle)
        ->addData(array_values($totalTransactionsByUser), $userNames)
        ->setLabels($userNames);
}


}
