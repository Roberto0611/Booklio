@extends('layouts.app')

@section('content')
{{-- Contenedor principal con fondo para toda la página --}}
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8 flex flex-col items-center">

    {{-- Botón de Regresar --}}
    <div class="max-w-5xl w-full mb-6">
        <a href="{{ url()->previous() }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out">
            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
            </svg>
            Regresar
        </a>
    </div>

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
                    <p class="text-gray-700 dark:text-gray-300 text-base">
                        <strong class="font-semibold text-gray-800 dark:text-gray-200">Añadido a la biblioteca:</strong>
                        {{ \Carbon\Carbon::parse($book->created_at)->format('j F, Y') }}
                    </p>
                </div>

                {{-- Botones de acción (ejemplos de Flowbite) --}}
                <div class="mt-8 flex flex-wrap gap-4">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-6 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-200 ease-in-out transform hover:-translate-y-1">
                        Marcar como leído
                    </button>
                    <button type="button" class="py-3 px-6 text-base font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out transform hover:-translate-y-1">
                        Añadir a lista de deseos
                    </button>
                    <!-- Modal toggle -->
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="py-3 px-6 text-base font-medium text-gray-900 focus:outline-none bg-yellow-400 rounded-lg border border-yellow-500 hover:bg-yellow-500 hover:text-white focus:z-10 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-700 dark:bg-yellow-500 dark:text-gray-900 dark:border-yellow-600 dark:hover:text-white dark:hover:bg-yellow-600 transition duration-200 ease-in-out transform hover:-translate-y-1" type="button">
                    Escribir reseña
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <x-modalReview></x-modalReview>

    {{-- Sección de Reseñas --}}
    <div class="max-w-5xl w-full bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
            Reseñas
        </h2>

        {{-- Contenedor para las reseñas (vacío por ahora) --}}
        <div class="space-y-6">
            <p class="text-gray-600 dark:text-gray-400">
                Aún no hay reseñas para este libro. ¡Sé el primero en escribir una!
            </p>
            {{-- Aquí se mostrarán las reseñas dinámicamente en el futuro --}}
            {{-- Ejemplo de una reseña --}}
            
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                <div class="flex items-center mb-2">
                    <img class="w-8 h-8 rounded-full mr-3" src="https://placehold.co/32x32/cccccc/333333?text=U" alt="User Avatar">
                    <p class="font-semibold text-gray-800 dark:text-gray-200">Nombre de Usuario</p>
                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-auto">25 de Junio, 2025</span>
                </div>
                <p class="text-gray-700 dark:text-gray-300 text-sm">
                    ¡Este libro es increíble! Me ayudó a cambiar mis hábitos de una manera muy efectiva. Totalmente recomendado.
                </p>
            </div>
            
        </div>
    </div>
</div>
@endsection