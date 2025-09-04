<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('12345678'),
            'bio' => 'Apasionado de la lectura y desarrollador en mis tiempos libres',
        ]);

        User::factory(3)->withLongBio()->create();
        
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

        $book = new Book();
        $book->title = 'Céntrate (Deep Work)';
        $book->author = 'Cal Newport';
        $book->description = 'El «Deep Work» es la capacidad de concentrarse sin distracciones en una tarea cognitivamente exigente. En un mundo altamente competitivo que además incentiva la hiperconexión y la multitarea, la atención se ha convertido en un activo extremadamente valioso. A partir de cuatro reglas prácticas, Carl Newport demuestra que reforzar nuestra capacidad de concentración y saber alejarse de las distracciones tecnológicas son los primeros pasos para lograr la felicidad y el éxito profesional.';  
        $book->cover_image = 'https://books.google.com.mx/books/publisher/content?id=g-FYEAAAQBAJ&pg=PP1&img=1&zoom=3&hl=en&bul=1&sig=ACfU3U0ggLpF1KQNqRcavErsOmC61ai2fA&w=1280';

        $book->save();

        $book = new Book();
        $book->title = 'Padre rico. Padre pobre';
        $book->author = 'Robert T. Kiyosaki';
        $book->description = 'Basado en el principio de que los bienes que generan ingreso siempre dan mejores resultados que los trabajos tradicionales, Robert Kiyosaki explica cómo pueden adquirirse dichos bienes para, eventualmente, olvidarse de trabajar.';  
        $book->cover_image = 'https://books.google.com.mx/books/content?id=NEz44me8a5MC&pg=PP1&img=1&zoom=3&hl=en&bul=1&sig=ACfU3U1I2JFUH-fhvpFt3gvX31oLqiUoYQ&w=1280';

        $book->save();

        $book = new Book();
        $book->title = 'El Principito';
        $book->author = 'Antoine de Saint-Exupéry ';
        $book->description = 'Desde un pequeño asteroide, muy lejos de este planeta que se debate por sobrevivir, destella la imagen de este dulce niño tratando de rescatar los mejores sentimientos humanos olvidados o relegados. Saint-Exupéry escribe este canto de amor y ternura inigualable dirigido a los adultos, aunque quizá sean los nños los que puedan entender su hermosisimo mensaje.';  
        $book->cover_image = 'https://books.google.com.mx/books/publisher/content?id=1N0KDgAAQBAJ&pg=PP1&img=1&zoom=3&hl=en&bul=1&sig=ACfU3U2w-adhIFYHqeuGrm48dGHYJu18CA&w=1280';

        $book->save();

    }
}
