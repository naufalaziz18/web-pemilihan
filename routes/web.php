<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Voting Ketua OSIS
|--------------------------------------------------------------------------
*/

// 🔹 Halaman utama redirect ke login
Route::get('/', fn() => redirect('/login'));

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Khusus untuk admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Kelola kandidat
    Route::resource('/candidates', CandidateController::class);

    // Lihat hasil voting
    Route::get('/admin/results', [AdminController::class, 'results'])->name('admin.results');
});

/*
|--------------------------------------------------------------------------
| User Routes (Khusus untuk siswa/user biasa)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/vote', [VoteController::class, 'showCandidates'])->name('vote');
    Route::post('/vote/{id}', [VoteController::class, 'submit'])->name('vote.submit');
    Route::get('/result', [VoteController::class, 'result'])->name('vote.result');
});
