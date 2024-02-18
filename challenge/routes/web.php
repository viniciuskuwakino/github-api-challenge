<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdminUserController::class, 'index'])->name('admin.show');
    Route::get('/admin/create', [AdminUserController::class, 'create'])->name('create.admin.user');
    Route::post('/admin/create', [AdminUserController::class, 'store'])->name('store.admin.user');
    Route::get('/admin/{id}', [AdminUserController::class, 'edit'])->name('edit.admin.user');
    Route::patch('/admin', [AdminUserController::class, 'update'])->name('update.admin.user');
    Route::delete('/admin/{id}', [AdminUserController::class, 'destroy'])->name('destroy.admin.user');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
