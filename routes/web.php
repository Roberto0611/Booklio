<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::get('/books/catalog', [BookController::class, 'catalog'])->name('books.catalog');

Route::get('/books/{book}',[BookController::class, 'show'])->name('books.show');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register', [LoginController::class, 'register'])->name('register');