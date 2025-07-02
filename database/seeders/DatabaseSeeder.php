<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create 10 random users
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Roberto',
            'email' => 'neweobgamer2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        
        // Seeder for books
        $book = new Book();
        $book->title = 'Hábitos atómicos';
        $book->author = 'James Clear';
        $book->description = 'Un método sencillo y comprobado para desarrollar buenos hábitos y eliminar los malos';  
        $book->cover_image = 'https://books.google.com.mx/books/publisher/content?id=TXiMDwAAQBAJ&pg=PP1&img=1&zoom=3&hl=en&bul=1&sig=ACfU3U11sIDDGnFgnIU4MkFkQ8VNYRTEPg&w=1280';
        
        $book->save();   
        
        $book = new Book();
        $book->title = 'Como ganar amigos e influir sobre las personas';
        $book->author = 'Dale Carnegie';
        $book->description = 'Un clásico de la autoayuda que enseña habilidades interpersonales y de comunicación para mejorar las relaciones personales y profesionales.';  
        $book->cover_image = 'https://m.media-amazon.com/images/I/71cKlOjAPKL.jpg';

        $book->save();

        $book = new Book();
        $book->title = 'Teoria king kong';
        $book->author = 'Virginie Despentes';
        $book->description = 'Teoría King Kong es uno de los grandes libros de referencia del feminismo y de la teoría de género, un incisivo ensayo en el que Despentes comparte su propia experiencia para hablarnos sin tapujos ni concesiones sobre la prostitución, la violación, la represión del deseo, la maternidad y la pornografía, y para contribuir al derrumbe de los cimientos patriarcales de la sociedad actual.';  
        $book->cover_image = 'https://m.media-amazon.com/images/I/81z86kKBTJL.jpg';

        $book->save();
    }
}
