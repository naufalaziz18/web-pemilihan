<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Voting Ketua OSIS
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Halaman Utama (Vote untuk semua orang)
|--------------------------------------------------------------------------
*/
// 🗳️ Semua orang bisa lihat dan memilih kandidat tanpa login
Route::get('/', [VoteController::class, 'showCandidates'])->name('vote');
Route::post('/vote', [VoteController::class, 'store'])
    ->name('vote.store')
    ->middleware('throttle:5,1'); // batasi 5 vote / menit per IP (opsional)
Route::get('/result', [VoteController::class, 'result'])->name('vote.result');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Untuk Admin)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Hanya bisa diakses setelah login & role admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/candidates', CandidateController::class);
    Route::get('/admin/results', [AdminController::class, 'results'])->name('admin.results');
});


Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidates.create');
Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store');
Route::get('/candidates/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidates.edit');

// Route export Excel (hanya untuk admin)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/vote/export', [VoteController::class, 'export'])->name('admin.vote.export');
});
