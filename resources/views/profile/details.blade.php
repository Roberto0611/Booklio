@extends('layouts.app')

@section('content')
{{-- Contenedor principal de la página de perfil --}}
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- Sección del encabezado del perfil (Foto, Nombre, Bio, Botón Editar) --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8 lg:p-10 mb-8 flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
            {{-- Foto de Perfil --}}
            <div class="flex-shrink-0">
                <img class="w-32 h-32 sm:w-40 sm:h-40 rounded-full object-cover border-4 border-blue-500 dark:border-blue-400 shadow-lg"
                     src="{{Auth::user()->photo}}" 
                     alt="Foto de perfil de [Nombre de Usuario]">
            </div>

            {{-- Información del Usuario --}}
            <div class="flex-grow text-center md:text-left">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white mb-2">
                    {{Auth::user()->name}}
                </h1>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed max-w-2xl md:mx-0 mx-auto">
                    {{Auth::user()->bio}}
                </p>
                {{-- Botón de Editar Información --}}
                <div class="mt-6">
                    <a href="{{route('editProfile')}}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        Editar Perfil
                    </a>
                </div>
            </div>
        </div>

        {{-- Contenido principal: Libros Favoritos y Libros Recientes --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Columna principal para los libros --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Sección de Libros Favoritos --}}

                {{-- Comprobar si hay libros favoritos --}}
                @if ($favoriteBooks->isEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                            Libros Favoritos
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400">
                            No tienes libros favoritos aún. ¡Empieza a marcar algunos!
                        </p>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                            Libros Favoritos
                        </h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach ($favoriteBooks as $book)
                                <a href="{{ route('books.show', $book->id) }}" class="block transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <img class="w-full h-auto object-cover rounded-md shadow-md"
                                        src="{{ $book->cover_image }}" 
                                        alt="Portada de {{ $book->title }}">
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white mt-2 truncate">{{ $book->title }}</p>
                                </a>
                            @endforeach

                        </div>
                    </div>
                @endif

                

                {{-- Sección de Libros Recientes --}}
                
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                            Libros Recientes
                        </h2>
                        <a href="{{route('profile.recentBooks')}}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">Ver todos los recientes</a>
                    </div>
                    

                    {{-- Comprobar si hay libros recientes --}}
                    @if ($lastReadBooks->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">
                            No has leído ningún libro recientemente. ¡Empieza a leer!
                        </p>
                    @else
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach ($lastReadBooks as $book)
                            <a href="{{ route('books.show', $book->id) }}" class="block transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                <img class="w-full h-auto object-cover rounded-md shadow-md"
                                    src="{{ $book->cover_image }}" 
                                    alt="Portada de {{ $book->title }}">
                                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-2 truncate">{{ $book->title }}</p>
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            {{-- Columna lateral (vacía por ahora, para futuras funcionalidades como estadísticas o amigos) --}}
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                    Actividad Reciente
                </h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Aquí se podría mostrar un feed de actividad, estadísticas de lectura,
                    o una lista de amigos.
                </p>
                {{-- Placeholder para contenido futuro --}}
                <div class="mt-6 h-48 bg-gray-100 dark:bg-gray-700 rounded-md flex items-center justify-center text-gray-500 dark:text-gray-400">
                    Próximas funcionalidades
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
