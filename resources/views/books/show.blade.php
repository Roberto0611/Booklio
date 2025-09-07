@extends('layouts.app')

@section('content')
{{-- Contenedor principal con fondo para toda la página --}}
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8 flex flex-col items-center">

    {{-- Botón de Regresar --}}
    <div class="max-w-5xl w-full mb-6">
        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('books.catalog') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out">
            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
            </svg>
            Regresar
        </a>
    </div>

    {{--Checar si se retorno alguna alerta --}}
    @if (session('alert'))
        <div class="max-w-5xl w-full mb-6">
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-900 dark:text-red-200" role="alert">
                <span class="font-medium">Alerta!</span> {{ session('alert') }}
            </div>
        </div>
    @endif

     @if (session('sucess'))
        <div class="max-w-5xl w-full mb-6">
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-200" role="status">
                <span class="font-medium">reseña agregada con exito! </span> {{ session('alert') }}
            </div>
        </div>
    @endif

    {{-- Contenedor centrado para la tarjeta del libro --}}
    <div class="max-w-5xl w-full bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:scale-[1.01] mb-10"> {{-- Añadido mb-10 para espacio con la sección de reseñas --}}
        <div class="md:flex">
            {{-- Sección de la imagen de portada --}}
            <div class="md:flex-shrink-0 md:w-1/3 p-6 flex items-center justify-center">
                @if($book->cover_image)
                    <img class="w-full h-auto object-cover rounded-lg shadow-md max-h-[400px] md:max-h-full" src="{{ $book->cover_image }}" alt="Portada de {{ $book->title }}">
                @else
                    {{-- Placeholder si no hay imagen de portada --}}
                    <div class="w-full h-64 md:h-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-500 dark:text-gray-400 text-xl font-medium">
                        No hay imagen disponible
                    </div>
                @endif
            </div>
            {{-- Sección de los detalles del libro --}}
            <div class="p-8 md:w-2/3">
                {{-- Autor del libro --}}
                <div class="uppercase tracking-wide text-sm text-indigo-600 dark:text-indigo-400 font-semibold mb-2">
                    {{ $book->author }}
                </div>
                {{-- Título del libro --}}
                <h1 class="block mt-1 text-4xl leading-tight font-extrabold text-gray-900 dark:text-white mb-4">
                    {{ $book->title }}
                </h1>
                {{-- Descripción del libro --}}
                <p class="mt-4 text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
                    {{ $book->description }}
                </p>

                {{-- Detalles adicionales (fecha de publicación, fecha de adición) --}}
                <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <p class="text-gray-700 dark:text-gray-300 text-base mb-2">
                        <strong class="font-semibold text-gray-800 dark:text-gray-200">Publicado:</strong>
                        {{ $book->published_at ? \Carbon\Carbon::parse($book->published_at)->format('j F, Y') : 'No especificado' }}
                    </p>
                    {{-- <p class="text-gray-700 dark:text-gray-300 text-base">
                        <strong class="font-semibold text-gray-800 dark:text-gray-200">Añadido a la biblioteca:</strong>
                        {{ \Carbon\Carbon::parse($book->created_at)->format('j F, Y') }}
                    </p> --}}
                </div>

                @php
                    $isRead = auth()->user()->books()->where('book_id', $book->id)->wherePivot('is_readed', 1)->exists();
                @endphp

                {{-- Botones de acción (ejemplos de Flowbite) --}}
                <div class="mt-8 flex flex-wrap gap-4">

                    {{-- If the book is readed shows the mark as read button if not, show unread --}}
                    @if (!$isRead)
                        <a href="{{route('books.markAsRead',$book->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-200 ease-in-out transform hover:-translate-y-1">
                            Marcar como leido
                        </a>
                    @else
                        <a href="{{route('books.markAsUnRead',$book->id)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-200 ease-in-out transform hover:-translate-y-1">
                            Quitar de leidos
                        </a>
                    @endif

                    @php
                        if(auth()->check()){
                            $isFavorite = auth()->user()->books()->where('book_id', $book->id)->wherePivot('is_favorite', 1)->exists();
                        } else {
                            $isFavorite = false;
                        }
                    @endphp

                    <a href="{{ $isFavorite ? route('books.markAsUnFavorite', $book->id) : route('books.markAsFavorite', $book->id) }}"
                       class="inline-flex items-center justify-center py-3 px-4 text-base font-medium rounded-lg border focus:outline-none focus:ring-4 transition duration-200 ease-in-out transform hover:-translate-y-1
                           {{ $isFavorite
                               ? 'bg-red-500 border-red-500 hover:bg-red-600 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 text-white'
                               : 'bg-white border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-red-500 dark:hover:bg-gray-700 text-red-500'
                           }}">
                        @if($isFavorite)
                            {{-- Corazón lleno --}}
                            <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            Quitar de Favoritos
                        @else
                            {{-- Corazón delineado --}}
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            Añadir a Favoritos
                        @endif
                    </a>

                    <!-- Modal toggle -->

                    <!-- Comprobar si el usuario ya tiene una reseña escrita -->    
                        @if ($userReview == !null)
                            <button data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="py-3 px-6 text-base font-medium text-gray-900 focus:outline-none bg-yellow-400 rounded-lg border border-yellow-500 hover:bg-yellow-500 hover:text-white focus:z-10 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-700 dark:bg-yellow-500 dark:text-gray-900 dark:border-yellow-600 dark:hover:text-white dark:hover:bg-yellow-600 transition duration-200 ease-in-out transform hover:-translate-y-1" type="button">
                            Editar reseña
                            </button>
                        @else
                            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="py-3 px-6 text-base font-medium text-gray-900 focus:outline-none bg-yellow-400 rounded-lg border border-yellow-500 hover:bg-yellow-500 hover:text-white focus:z-10 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-700 dark:bg-yellow-500 dark:text-gray-900 dark:border-yellow-600 dark:hover:text-white dark:hover:bg-yellow-600 transition duration-200 ease-in-out transform hover:-translate-y-1" type="button">
                            Escribir reseña
                            </button>
                        @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <x-modalReview :book="$book" />
    <x-modalEditReview :book="$book" :review="$userReview" />

    {{-- Sección de Reseñas --}}
    <div class="max-w-5xl w-full bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
            Reseñas
        </h2>

        {{-- Contenedor para las reseñas --}}
        <div class="space-y-6">
            @if ($reviews->isEmpty())
                <p class="text-gray-600 dark:text-gray-400">
                    Aún no hay reseñas para este libro. ¡Sé el primero en escribir una!
                </p>
            @endif
            
            {{-- Reviews --}}
            
            @foreach ($reviews as $review)
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center mb-2">
                        <img class="w-8 h-8 rounded-full mr-3" src="{{ $review->user->photo }}" alt="User Avatar">
                        <p class="font-semibold text-gray-800 dark:text-gray-200 ml-2">{{ $review->user->name }}</p>

                        {{-- Stars (1..5) showing the review rating --}}
                        <div class="flex items-center ml-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 me-1 {{ $i <= ($review->rating ?? 0) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.166c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.37 2.448c-.784.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.642 9.393c-.783-.57-.38-1.81.588-1.81h4.166a1 1 0 00.95-.69L9.049 2.927z"/>
                                </svg>
                            @endfor
                        </div>

                        <span class="text-sm text-gray-500 dark:text-gray-400 ml-auto">{{ $review->created_at ? $review->created_at->format('j F, Y') : '' }}</span>
                    </div>

                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        {{ $review->review }}
                    </p>
                </div>
            @endforeach
            
        </div>
    </div>
</div>
@endsection