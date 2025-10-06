<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route aplikasi kamu didefinisikan di sini.
| Route default diarahkan ke welcome, dan route lain
| membutuhkan autentikasi (auth middleware).
|
*/

// halaman utama diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});


// dashboard (hanya untuk user login & verified)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// route untuk profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// semua route utang & cicilan (hanya untuk user login)
Route::middleware(['auth'])->group(function () {
    Route::resource('debts', DebtController::class);

    // tambah utang baru ke akun tertentu
    Route::post('debts/{debt}/add-debt', [DebtController::class, 'addDebt'])->name('debts.addDebt');

    // tambah cicilan
    Route::post('debts/{debt}/payments', [PaymentController::class, 'store'])->name('payments.store');
});

// route auth bawaan Breeze
require __DIR__ . '/auth.php';
