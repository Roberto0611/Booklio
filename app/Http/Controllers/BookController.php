<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{   
    public function index(){
        return view('books.index');
    }

    public function catalog(){
        $books = Book::all();

        return view('books.catalog',compact('books'));
    }

    public function show($id){
        $book = Book::find($id);

        return view('books.show',compact('book'));
    }
}
