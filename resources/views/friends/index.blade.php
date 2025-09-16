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
			<form action="#" method="GET" onsubmit="return false;" class="max-w-3xl mx-auto">
				<label for="friend-search" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 block">Buscar por nombre o usuario</label>
				<div class="relative">
					<div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
						<svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
					</div>
					<input type="search" id="friend-search" name="q" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Busca amigos..." />
					<button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
				</div>
			</form>
		</div>

		{{-- Resultados --}}
		<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 sm:p-8 mb-8">
			<div class="flex items-center justify-between mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white">Resultados</h2>
			</div>

			{{-- Grid de tarjetas (datos de ejemplo) --}}
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
				{{-- @for ($i = 1; $i <= 8; $i++)
					<div class="group bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
						<div class="p-6 flex items-center gap-4">
							<img class="w-16 h-16 rounded-full object-cover ring-2 ring-blue-500/20" src="https://i.pravatar.cc/150?img={{ $i }}" alt="Avatar de usuario {{ $i }}">
							<div class="min-w-0">
								<p class="text-lg font-semibold text-gray-900 dark:text-white truncate">Usuario {{ $i }}</p>
								<p class="text-sm text-gray-600 dark:text-gray-300 truncate">@usuario{{ $i }}</p>
								<div class="mt-2 flex items-center gap-3">
									<span class="inline-flex items-center text-xs text-gray-500 dark:text-gray-400">
										<svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"/></svg>
										{{ rand(5, 120) }} libros
									</span>
									<span class="inline-flex items-center text-xs text-gray-500 dark:text-gray-400">
										<svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2v-9a2 2 0 012-2h2m3-3h6a2 2 0 012 2v3H8V7a2 2 0 012-2z"/></svg>
										{{ rand(1, 50) }} reseñas
									</span>
								</div>
							</div>
						</div>
						<div class="px-6 pb-6 flex items-center justify-between">
							<a href="#" class="text-sm text-blue-600 hover:underline dark:text-blue-400">Ver perfil</a>
							<button type="button" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">Agregar</button>
						</div>
					</div>
				@endfor --}}
			</div>
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