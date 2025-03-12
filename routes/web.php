<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Landing page sebagai halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route untuk todo list (dilindungi auth middleware)
Route::middleware(['auth'])->group(function () {
    // Todos routes
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggleComplete'])->name('todos.toggle');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect /dashboard ke /todos setelah login
Route::get('/dashboard', function () {
    return redirect()->route('todos.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
