<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', function () {
    return view('books.index');
})->name('books.index');

Route::get('/books/{book}',function($id){
    $book = Book::find($id);

    return view('books.show',compact('book'));
})->name('books.show');