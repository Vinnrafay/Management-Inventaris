<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PinjemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
$products = Product::with('pinjams')->latest()->take(8)->get();
    return view('welcome', compact('products'));
})->name('welcome');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('products', ProductController::class);

Route::get('/form/create/{id}', [PinjemController::class, 'create'])->name('form.create');
Route::post('/form/store', [PinjemController::class, 'store'])->name('form.store');

Route::resource('minjem', PinjemController::class);
Route::post('/minjem/selesai/{id}', [PinjemController::class, 'selesai'])->name('minjem.selesai');



require __DIR__.'/auth.php';
