@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8">
	<div class="max-w-7xl mx-auto">
		{{-- Título y acción secundaria --}}
		<div class="flex items-center justify-between mb-8">
			<h1 class="text-4xl font-extrabold text-gray-900 dark:text-white">Buscar Amigos</h1>
		</div>

		{{-- Barra de búsqueda --}}
		<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8 mb-8">
			<form action="{{route('friends.search')}}" method="GET" onsubmit="" class="max-w-3xl mx-auto">
				<label for="friend-search" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 block">Buscar por nombre o usuario</label>
				<div class="relative">
					<div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
						<svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
					</div>
					<input type="search" id="friend-search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Busca amigos..." />
					<button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
				</div>
			</form>
		</div>

		{{-- Descubrir / sugerencias --}}
		<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8">
			<div class="flex items-center justify-between mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white">Descubre nuevos lectores</h2>
			</div>
			<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($recommendations as $user)
					<a href="{{route('profile', ['id' => $user->id])}}" class="group flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:shadow-lg transition-shadow">
						<img class="w-20 h-20 rounded-full object-cover ring-2 ring-blue-500/20 group-hover:ring-blue-500/40" src="{{ $user->photo }}" alt="Avatar de {{ $user->name }}">
						<span class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
						<span class="text-xs text-gray-500 dark:text-gray-400 text-center block" title="{{ $user->bio }}">{{ \Illuminate\Support\Str::words($user->bio, 12, '...') }}</span>
						<button class="mt-3 inline-flex items-center px-2.5 py-1 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-800">Seguir</button>
					</a>
				@endforeach
			</div>
		</div>

	</div>
</div>
@endsection