<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function toggleRead($id){
        $user = Auth::user();
        
        // Verifica si ya existe la relación
        if ($user->books()->where('book_id', $id)->exists()) {
            // Actualiza el pivot existente
            $user->books()->updateExistingPivot($id, ['is_readed' => 1]);
        } else {
            // Crea nueva relación con el campo pivot
            $user->books()->attach($id, ['is_readed' => 1]);
        }

        return response()->json(['message' => 'Estado de lectura actualizado']);
    }
}
