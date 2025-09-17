@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        {{-- Botón de Regresar --}}
        <div class="mb-6">
            <a href="{{ route('friends.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                Regresar
            </a>
        </div>

        {{-- Búsqueda: encabezado y barra en una sola tarjeta --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8 mb-8">
            <div class="flex flex-col gap-5">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">Buscar usuarios</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Encuentra amigos por nombre o usuario.</p>
                </div>
                <form action="{{ route('friends.search') }}" method="GET" class="w-full">
                    <label for="friend-search" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 block">Buscar por nombre o usuario</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                        </div>
                        <input value="{{ request('search') }}" type="search" id="friend-search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Busca amigos..." />
                        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Resultados --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8">
            @php
                $resultCount = method_exists($list, 'total') ? $list->total() : $list->count();
            @endphp
            <div class="flex items-center justify-between gap-4 mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Resultados de búsqueda</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Para: <span class="font-medium text-gray-900 dark:text-gray-200">"{{ request('search') }}"</span></p>
                </div>
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-sm font-semibold">
                    {{ $resultCount }} resultados
                </div>
            </div>

            {{-- Lista de usuarios --}}
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
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Intenta con otro nombre o busca por usuario.</p>
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
            <div class="mt-6">
                {{ $list->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
