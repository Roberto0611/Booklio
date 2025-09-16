@extends('layouts.app')

@section('content')
{{-- Contenedor principal con fondo para toda la página --}}
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        {{-- Barra de encabezado: regresar + título --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <a href="{{ route('profile', $id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700 transition">
                    ← Volver al perfil
                </a>
            </div>
            <div class="text-center flex-1">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-1">
                    Libros leídos
                </h1>
                <p class="text-gray-600 dark:text-gray-400">Aquí verás todos los libros que {{ $user->name }} ha marcado como leídos.</p>
            </div>
            <div class="w-24">&nbsp;</div>
        </div>

        {{-- Cuadrícula para mostrar los libros --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @foreach($recentBooks as $book)
                {{-- Tarjeta de cada libro --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-[1.03] hover:shadow-xl">
                    <a href="{{ route('books.show', $book->id) }}">

                        <div class="w-full flex items-center justify-center bg-white dark:bg-gray-800">
                            @if($book->cover_image)
                                {{-- object-contain para no recortar, w-full h-auto para que la imagen
                                     se ajuste al ancho y mantenga su proporción original. --}}
                                <img class="w-full h-auto object-contain" src="{{ $book->cover_image }}" alt="Portada de {{ $book->title }}">
                            @else
                                {{-- Placeholder si no hay imagen de portada (mantiene una altura fija para el placeholder) --}}
                                <div class="w-full h-64 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-lg font-medium">
                                    No hay imagen
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="p-5">
                        <a href="{{ route('books.show', $book->id) }}">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                {{ $book->title }}
                            </h3>
                        </a>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ $book->author }}
                        </p>
                        {{-- Fecha de lectura (desde pivot) --}}
                        @if(isset($book->pivot) && !empty($book->pivot->read_at))
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Leído: {{ \Carbon\Carbon::parse($book->pivot->read_at)->format('j F, Y') }}</p>
                        @endif
                        <div class="mt-4">
                            <a href="{{ route('books.show', $book->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Ver Detalles
                                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
