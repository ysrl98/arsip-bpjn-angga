<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

// Route Dashboard yang baru (menggunakan Livewire)
Route::get('/dashboard', App\Livewire\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// --- MANAJEMEN USER (KHUSUS ADMIN) ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', App\Livewire\UserIndex::class)->name('users.index');
    Route::get('/users/tambah', App\Livewire\UserCreate::class)->name('users.create');
    Route::get('/users/{id}/edit', App\Livewire\UserEdit::class)->name('users.edit');
    Route::get('/activity-log', App\Livewire\ActivityLogIndex::class)->name('activity-log');
});

Route::get('/arsip/{kategori}', App\Livewire\ArchiveIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('arsip.index');
    Route::get('/arsip/{kategori}/tambah', App\Livewire\ArchiveCreate::class)->name('arsip.create');
    Route::get('/arsip/{kategori}/{id}/edit', App\Livewire\ArchiveEdit::class)->name('arsip.edit');

require __DIR__.'/auth.php';
