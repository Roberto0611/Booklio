@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        {{-- Botón de Regresar --}}
        <div class="mb-6">
            <a href="{{ route('profile', ['id' => $user->id]) }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                Regresar
            </a>
        </div>

        {{-- Encabezado de la lista (placeholders) --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    
                    @if ($tab == 'followers')
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">
                        Usuarios que siguen a {{ $user->name }}
                        </h1>
                    @elseif ($tab == 'following')
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">
                        Usuarios que {{ $user->name }} sigue
                        </h1>
                    @endif
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Explora usuarios relacionados con este perfil.
                    </p>
                </div>
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-sm font-semibold">
                    Total: {{ $list->count() }} 
                </div>
            </div>
        </div>

        {{-- Lista de usuarios (placeholders puros) --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @if ($list->isEmpty())
                    <div class="col-span-full">
                        <div class="text-center py-16">
                            <div class="mx-auto w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700/50 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Sin resultados</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Aún no hay usuarios en esta lista.</p>
                        </div>
                    </div>
                @endif

                @foreach ($list as $user)
                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="group block relative overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 transition duration-300 hover:shadow-lg">
                        <div class="p-4 flex items-center gap-4">
                            <div class="shrink-0">
                                <img class="w-20 h-20 rounded-full object-cover ring-2 ring-blue-500/20 group-hover:ring-blue-500/40" src="{{ $user->photo }}" alt="Avatar de {{ $user->name }}">
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-base font-semibold text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ \Illuminate\Support\Str::words($user->bio, 12, '...') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-4">
                {{$list->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
