<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\friendshipController;
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

Route::get('/books/{book}/markAsread',[BookController::class, 'markAsRead'])->name('books.markAsRead')->middleware('auth');

Route::get('/books/{book}/unread',[BookController::class, 'markAsUnRead'])->name('books.markAsUnRead')->middleware('auth');

Route::get('/books/{book}/markAsFavorite',[BookController::class, 'markAsFavorite'])->name('books.markAsFavorite')->middleware('auth');

Route::get('/books/{book}/markAsUnFavorite',[BookController::class, 'markAsUnFavorite'])->name('books.markAsUnFavorite')->middleware('auth');

Route::post('/books/{book}/storeReview',[BookController::class, 'storeReview'])->name('books.reviews.store')->middleware('auth');

Route::post('/books/{book}/editReview',[BookController::class, 'editReview'])->name('books.reviews.edit')->middleware('auth');

Route::delete('/books/{book}/destroyReview',[BookController::class, 'destroyReview'])->name('books.reviews.destroy')->middleware('auth');

// -------  Profile routes ------- 

Route::get('/profile/details/{id}', [ProfileController::class, 'details'])->name('profile')->middleware('auth');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('editProfile')->middleware('auth');

Route::put('/profile/edit', [ProfileController::class,'update'])->name('editProfileLogic')->middleware('auth');

Route::get('/profile/recent-books/{id}', [ProfileController::class, 'recentBooks'])->name('profile.recentBooks')->middleware('auth');

// ------- Friends routes -------

Route::get('/friends/index', [friendshipController::class, 'index'])->name('friends.index')->middleware('auth');

Route::get('/friends/{id}/follow', [friendshipController::class, 'follow'])->name('friends.follow')->middleware('auth');

Route::get('/friends/{id}/unfollow', [friendshipController::class, 'unfollow'])->name('friends.unfollow')->middleware('auth');

Route::get('/friends/list/{id}/{tab}', [friendshipController::class, 'list'])->name('friends.list')->middleware('auth');
// ------- Log-in routes ------- 

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/register', [LoginController::class, 'indexRegister'])->name('register');

Route::post('/validar-registro', [LoginController::class,'register'])->name('validad-registro');

Route::get('/logout', [LoginController::class,'logOut'])->name('logout');

Route::Post('/loginLogic',[LoginController::class,'login'])->name('loginLogic');