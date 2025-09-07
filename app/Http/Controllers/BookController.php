<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
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

        # get the reviews for the book
        $reviews = Review::where('book_id', $id)->latest()->take(5)->get();

        return view('books.show',compact('book','reviews'));
    }

    public function markAsRead($id){
        $user = Auth::user();
        
        // Verifica si ya existe la relación
        if ($user->books()->where('book_id', $id)->exists()) {
            // Actualiza el pivot existente
            $user->books()->updateExistingPivot($id, ['is_readed' => 1,'read_at' => now()]);
        } else {
            // Crea nueva relación con el campo pivot
            $user->books()->attach($id, ['is_readed' => 1, 'read_at' => now()]);
        }

        return back()->with('alert', '¡Estado de lectura actualizado!');
    }

    public function markAsUnRead($id){
        $user = Auth::user();
        
        // Verifica si ya existe la relación
        if ($user->books()->where('book_id', $id)->exists()) {
            // Actualiza el pivot existente
            $user->books()->updateExistingPivot($id, ['is_readed' => 0]);
        } else {
            // Crea nueva relación con el campo pivot
            $user->books()->attach($id, ['is_readed' => 0]);
        }

        return back()->with('alert', '¡Estado de lectura actualizado!');
    }

    public function markAsFavorite($id){
        $user = Auth::user();

        // verifica si no hay mas de 5 libros favoritos
        $favoriteCount = $user->books()->wherePivot('is_favorite', 1)->count();
        if ($favoriteCount >= 5) {
            return back()->with('alert', '¡No puedes tener más de 5 libros favoritos! favor de desmarcar alguno.');
        }
        
        // Verifica si ya existe la relación
        if ($user->books()->where('book_id', $id)->exists()) {
            // Actualiza el pivot existente
            $user->books()->updateExistingPivot($id, ['is_favorite' => 1]);
        } else {
            // Crea nueva relación con el campo pivot
            $user->books()->attach($id, ['is_favorite' => 1]);
        }

        return back();
    }

    public function markAsUnFavorite($id){
        $user = Auth::user();
        
        // Verifica si ya existe la relación
        if ($user->books()->where('book_id', $id)->exists()) {
            // Actualiza el pivot existente
            $user->books()->updateExistingPivot($id, ['is_favorite' => 0]);
        } else {
            // Crea nueva relación con el campo pivot
            $user->books()->attach($id, ['is_favorite' => 0]);
        }

        return back()->with('alert', '¡Libro desmarcado como favorito!');
    }

    public function storeReview(Request $request, $id){
        $request->validate([
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        $book = Book::find($id);

    $review = new Review();
    $review->user_id = $user->id;
    $review->book_id = $book->id;
    // column name in the migration is 'review'
    $review->review = $request->review;
    $review->rating = $request->rating;

    $review->save();

        return back()->with('sucess', '¡Reseña enviada con éxito!');
    }

}
