<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [PublicController::class, 'index'])->name('index'); 

Route::get('/tes', function(){
    Artisan::call('storage:link');
});

Route::middleware('only_guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login'); //Route ke halaman login
    Route::post('login', [AuthController::class, 'authenticating']); //Route untuk autentikasi status user
    Route::get('register', [AuthController::class, 'register']); // Route ke halaman register 
    Route::post('register', [AuthController::class, 'registerProcess']); // Route proses register 
    Route::get('/regulation', [PublicController::class, 'regulation']); 
    Route::get('/librarian', [PublicController::class, 'librarian']); 
    Route::get('book-detail/{slug}', [PublicController::class, 'book_detail']); 
    Route::get('/forgot-password',[ForgotPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password',[ForgotPasswordController::class, 'send'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
    Route::post('/reset-password/{token}', [ResetPasswordController::class, 'update'])->name('password.update');
    Route::get('guest-add', [GuestController::class, 'add']); //Route ke halaman guest
    Route::post('guest-add', [GuestController::class, 'store']); //Route ke halaman guest
});


Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    
    Route::middleware('user')->group(function () {

        //Route User
        // Route::get('user/book-list-user', [PublicController::class, 'user']); //Route ke halaman book-list
        Route::get('user/book-history-loan-user', [PublicController::class, 'history']); //Route ke halaman book-history
        Route::get('user/book-rating-user/{id}', [PublicController::class, 'rating']); //Route ke halaman book-history
        Route::post('user/book-rating-user/{id}', [PublicController::class, 'store'])->name('book_rating'); //Route ke halaman book-history
        
        Route::get('user/book-detail/{slug}', [PublicController::class, 'book_detail_user']); //route ke halaman detail buku
        Route::get('user/dashboard-user', [UserController::class, 'dashboard']); // Route ke halaman user
        Route::get('user/profile-user', [UserController::class, 'profile_user']); // Route ke halaman user
        Route::get('user/profile-user-edit', [UserController::class, 'profile_user_edit']);//Reoute ke halaman edit profil
        Route::put('/user/profile-user-update', [UserController::class, 'profile_user_update'])->name('profile_user_update');//Reoute ke halaman update profil
        Route::get('user/card-user', [UserController::class, 'card']); // Route ke halaman card user
        Route::get('/card-user-print', [UserController::class, 'print']); // Route ke halaman card user
        Route::get('/export-pdf', [GuestController::class, 'exportPdf']); //Route Halaman Export kartu


        Route::get('user/book-loan/{slug}', [BookRentController::class, 'loan']); //Route memesan buku
        Route::get('user/book-cancel/{slug}', [BookRentController::class, 'cancel']); //Route membatalkan pesanan buku
        Route::get('user/book-cancel-extra/{slug}', [BookRentController::class, 'extra_cancel']); //Route membatalkan perpanjangan buku
        Route::get('user/book-loan-extra/{slug}', [BookRentController::class, 'extra']); //Route memperpanjang peminjaman buku 
    });

    //Super
    Route::middleware('super')->group(function () {
        
        Route::get('super/dashboard-super', [DashboardController::class, 'super']); // Route ke halaman super admin
        
        Route::get('super/book-list-super', [PublicController::class, 'super']); //Route ke halaman book-list
        Route::get('super/book-list-super-detail/{title}', [PublicController::class, 'book_super_detail']); //Route ke halaman book-list
        Route::get('super/book-detail/{slug}', [PublicController::class, 'book_detail_super']); //route ke halaman detail buku

        //fitur kelola admin
        Route::get('super/admin', [UserController::class, 'admin']); // Route ke halaman kelola admin
        Route::get('super/admin-detail/{slug}', [UserController::class, 'admin_show']); //Route ke halaman detail admin
        Route::get('super/admin-approve/{slug}', [UserController::class, 'admin_approve']); //Route ke halaman detail + acc admin
        Route::get('super/admin-delete/{slug}', [UserController::class, 'admin_delete']); //Route ke halaman detail + acc admin
        
        //cetak laporan transaksi
        Route::get('super/transaction-report', [TransactionController::class, 'transaction_report'])->name('transaction.report'); //Route ke halaman transaction
        Route::get('super/transaction-export-super', [TransactionController::class, 'export_transaction']); //Route Halaman Export 
        Route::get('/super/transaction-export-super/{work_id}', [TransactionController::class, 'export_transaction_ByWorkId'])->name('transaction_super.exportByWorkId');
        
        Route::get('super/guest-report', [GuestController::class, 'guest_report'])->name('guest.report'); //Route ke halaman rent log
        Route::get('super/guest-export-super', [GuestController::class, 'guest_export']); //Route Halaman Export

        //fitur profil super
        Route::get('super/profile-super', [UserController::class, 'profile_super']); // Route ke halaman user
        Route::get('super/profile-super-edit', [UserController::class, 'profile_super_edit']);//Reoute ke halaman edit profil
        Route::put('profile-super-update', [UserController::class, 'profile_super_update'])->name('profile_super_update');//Reoute ke halaman update profil

    });

    //middleware admin
    Route::middleware('admin')->group(function () {
        // fitur suket
        Route::get('admin/dashboard', [DashboardController::class, 'index']); // Route ke halaman admin
        Route::get('admin/message', [DashboardController::class, 'message']); // Route ke halaman admin
        Route::get('/message-print', [DashboardController::class, 'message_print']); // Route ke halaman admin
        Route::get('/message-print-non', [DashboardController::class, 'message_print_non']); // Route ke halaman admin
        Route::get('/message-print/{id}', [DashboardController::class, 'message_print_id']); // Route ke halaman admin

        //fitur-fitur menu book
        Route::get('admin/book-list', [PublicController::class, 'admin']); //Route ke halaman book-list
        // Route::get('admin/book-list-detail/{title}', [PublicController::class, 'book_detail']); //Route ke halaman book-list
        
        Route::get('admin/book-detail/{slug}', [PublicController::class, 'book_detail_admin']); //route ke halaman detail buku 
        Route::get('admin/books', [BookController::class, 'index']); //Route ke halaman books
        Route::get('admin/book-add', [BookController::class, 'add']); //Route ke halaman tambah book
        Route::post('admin/book-add', [BookController::class, 'store']); //Route ke input data book
        Route::get('admin/book-edit/{slug}', [BookController::class, 'edit']); //Route ke halaman edit book
        Route::post('admin/book-edit/{slug}', [BookController::class, 'update']); //Route ke proses edit book
        Route::post('/admin/book-import', [BookController::class, 'import']); //Route Halaman Export Semua Data

        // fitur-fitur menu tempat buku
        Route::get('admin/places', [DashboardController::class, 'place']); //Route ke halaman place
        Route::get('admin/cupboard-add', [DashboardController::class, 'cupboardAdd']); //Route ke halaman tambah lemari
        Route::post('admin/cupboard-add', [DashboardController::class, 'storeCupboard']); //Route ke halaman fungsi tambah lemari
        Route::get('admin/cupboard-edit/{id}', [DashboardController::class, 'cupboardEdit']); //Route ke halaman edit cupboard
        Route::put('admin/cupboard-edit/{id}', [DashboardController::class, 'cupboardUpdate']); //Route ke halaman proses update cupboard

        Route::get('admin/rack-add', [DashboardController::class, 'rackAdd']); //Route ke halaman tambah lemari
        Route::post('admin/rack-add', [DashboardController::class, 'storeRack']); //Route ke halaman fungsi tambah lemari
        Route::get('admin/rack-edit/{id}', [DashboardController::class, 'rackEdit']); //Route ke halaman edit rack
        Route::put('admin/rack-edit/{id}', [DashboardController::class, 'rackUpdate']); //Route ke halaman proses update cupboard

        //fitur-fitur menu kategori
        Route::get('admin/categories', [CategoryController::class, 'index']); //Route ke halaman kategori
        Route::get('admin/category-add', [CategoryController::class, 'add']); //Route ke halaman tambah kategori
        Route::post('admin/category-add', [CategoryController::class, 'store']); //Route ke halaman proses tambah kategori
        Route::get('admin/category-edit/{slug}', [CategoryController::class, 'edit']); //Route ke halaman edit kategori
        Route::put('admin/category-edit/{slug}', [CategoryController::class, 'update']); //Route ke halaman proses update kategori
        
        //fitur fitur menu anggota
        Route::get('admin/users', [UserController::class, 'index']); //Route ke halaman user
        Route::get('admin/registered-users', [UserController::class, 'registeredUser']); //Route ke halaman user yang baru regis
        Route::get('admin/user-detail/{slug}', [UserController::class, 'show']); //Route ke halaman detail user
        Route::get('admin/user-approve/{slug}', [UserController::class, 'approve']); //Route ke halaman detail user
        Route::get('admin/user-ban/{slug}', [UserController::class, 'delete']); //Route ke halaman ban user
        Route::delete('/admin/user-soft-delete/{slug}',[UserController::class, 'softdelete'])->name('user-soft-delete');//Route ke proses ban user
        Route::delete('/admin/user-destroy/{slug}',[UserController::class, 'destroy'])->name('user-destroy');//Route ke proses ban user
        Route::delete('/admin/user-cancel/{slug}',[UserController::class, 'cancel'])->name('user-cancel');//Route ke proses tolak user
        Route::get('admin/user-banned', [UserController::class, 'bannedUser']); //Route ke halaman user yang telah di ban 
        Route::get('admin/user-restore/{slug}', [UserController::class, 'restore']); //Route ke proses restore 
        
        // fitur fitur menu book-rent
        Route::get('admin/book-rent', [BookRentController::class, 'index']); //Route ke halaman book-rent
        Route::get('admin/book-rent/{id}', [BookRentController::class, 'approve']); //Route ke fungsi aprove
        Route::get('admin/book-rent-add', [BookRentController::class, 'order']); //Route ke halaman book-rent
        Route::post('admin/book-rent-add', [BookRentController::class, 'store']); //Route ke halaman store book-rent
        
        //fitur fitur menu transaction
        Route::get('admin/transaction', [TransactionController::class, 'index']); //Route ke halaman transaction
        Route::get('/export/transaction/all', [TransactionController::class, 'exportAll']); //Route Halaman Export Semua Data
        Route::get('/export/transaction/teachers', [TransactionController::class, 'exportTeachers']); //Route Halaman Export Data Guru
        Route::get('/export/transaction/student', [TransactionController::class, 'exportStudent']); //Route Halaman Export Data Siswa
        Route::get('/export/transaction/{work_id}', [TransactionController::class, 'exportByWorkId'])->name('transaction.exportByWorkId');

        //menu guest
        Route::get('admin/guest', [GuestController::class, 'index']); //Route ke halaman Tamu
        Route::get('admin/guest-teacher', [GuestController::class, 'teacher']); //Route ke halaman Tamu
        Route::get('admin/guest-student', [GuestController::class, 'student']); //Route ke halaman Tamu
        // Route::get('admin/guest-add', [GuestController::class, 'add']); //Route ke halaman guest
        // Route::post('admin/guest-add', [GuestController::class, 'store']); //Route ke halaman guest
        
        Route::get('/export/guest/teachers', [GuestController::class, 'exportTeachers']); //Route Halaman Export Data Guru
        Route::get('/export/guest/all', [GuestController::class, 'exportAll']); //Route Halaman Export Semua Data
        Route::get('/export/guest/student', [GuestController::class, 'exportStudent']); //Route Halaman Export Data Siswa
        Route::get('/export/guest/{work_id}', [GuestController::class, 'exportByWorkId'])->name('guest.exportByWorkId');
        Route::get('/export-pdf', [GuestController::class, 'exportPdf']); //Route Halaman Export Data Guru

        //menu profil
        Route::get('admin/profile-admin', [UserController::class, 'profile_admin']);//Reoute ke halaman profil
        Route::get('admin/profile-admin-edit', [UserController::class, 'profile_admin_edit']);//Reoute ke halaman edit profil 
        Route::put('profile-admin-update', [UserController::class, 'profile_admin_update'])->name('profile_admin_update');//Reoute ke halaman update profil

        //fitur fitur book return
        Route::get('admin/book-return', [BookRentController::class, 'returnBook']); //Route ke halaman book return
        Route::post('admin/book-return', [BookRentController::class, 'saveReturnBook']); //Route ke halaman rent log
    });
});