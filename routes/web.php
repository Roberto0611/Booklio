<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('landing');

// ------- Books routes ------- 

Route::get('/books', [BookController::class, 'index'])->name('books.index')->middleware('auth');

Route::get('/books/catalog', [BookController::class, 'catalog'])->name('books.catalog')->middleware('auth');

Route::get('/books/{book}',[BookController::class, 'show'])->name('books.show')->middleware('auth');

// -------  Profile routes ------- 

Route::get('/profile/details', [ProfileController::class, 'details'])->name('profile')->middleware('auth');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('editProfile')->middleware('auth');

Route::put('/profile/edit', [ProfileController::class,'update'])->name('editProfileLogic')->middleware('auth');
// ------- Log-in routes ------- 

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/register', [LoginController::class, 'indexRegister'])->name('register');

Route::post('/validar-registro', [LoginController::class,'register'])->name('validad-registro');

Route::get('/logout', [LoginController::class,'logOut'])->name('logout');

Route::Post('/loginLogic',[LoginController::class,'login'])->name('loginLogic');