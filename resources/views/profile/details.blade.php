@extends('layouts.app')

@section('content')
{{-- Contenedor principal de la página de perfil --}}
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        {{-- Botón de Regresar --}}
        <div class="mb-6">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('books.catalog') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                Regresar
            </a>
        </div>

        {{-- Alerta de éxito al seguir a un usuario --}}
        @if (session('success'))
            <div class="mb-6">
                <div class="flex items-start p-4 text-sm text-green-800 bg-green-50 border border-green-200 rounded-lg dark:bg-gray-800 dark:text-green-400 dark:border-green-700" role="alert">
                    <svg class="flex-shrink-0 w-5 h-5 me-3 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-medium">Éxito:</span> {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        {{-- Sección del encabezado del perfil (Foto, Nombre, Bio, Botón Editar) --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8 lg:p-10 mb-8 flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
            {{-- Foto de Perfil --}}
            <div class="flex-shrink-0">
                <img class="w-32 h-32 sm:w-40 sm:h-40 rounded-full object-cover border-4 border-blue-500 dark:border-blue-400 shadow-lg"
                     src="{{ $user->photo }}" 
                     alt="Foto de perfil de {{ $user->name }}">
            </div>

            {{-- Información del Usuario --}}
            <div class="flex-grow text-center md:text-left">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white mb-2">
                    {{$user->name}}
                </h1>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed max-w-2xl md:mx-0 mx-auto">
                    {{ $user->bio }}
                </p>

                {{-- Botónes --}}
                <div class="mt-6">
                @if (Auth::id() === $user->id)
                    <a href="{{route('editProfile')}}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        Editar Perfil
                    </a>    
                @elseif ($isFollowing == false)
                    <a href="{{route('friends.follow',$user->id)}}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800 transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg" title="Seguir a {{ $user->name }}">
                        <svg class="w-5 h-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Seguir
                    </a>
                @else   
                    <a href="{{route('friends.unfollow',$user->id)}}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-900 transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg" title="Dejar de seguir a {{ $user->name }}">
                        <svg class="w-5 h-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Dejar de seguir
                    </a>                 
                @endif
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
