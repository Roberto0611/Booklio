@extends('layouts.app', ['hideNavbar' => true]) {{-- Oculta el navbar --}}

@section('content')
{{-- Contenedor principal para centrar el formulario en la página --}}
<div
    class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 p-4 sm:p-6 lg:p-8">

    {{-- Botón de Regresar --}}
    <div class="w-full max-w-md mb-6">
        <a href="{{ route('landing') }}"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out">
            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 5H1m0 0 4 4M1 5l4-4" />
            </svg>
            Regresar
        </a>
    </div>

    {{-- Tarjeta del formulario de login --}}
    <div
        class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-2xl p-8 space-y-6 transform transition-all duration-300 hover:scale-[1.01]">
        <div class="text-center">
            {{-- Logo de Booklio --}}
            <img class="mx-auto h-17 w-auto mb-4" src="{{asset('images/logos/full-logo-svg.svg')}}" alt="Booklio Logo">
            <h1 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                Iniciar Sesión
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Bienvenido de nuevo a Booklio
            </p>
        </div>

        <form class="space-y-6" action="{{route('loginLogic')}}" method="POST">
            @csrf {{-- Token CSRF de Laravel --}}


            {{-- Mostrar errores --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Campo de Correo Electrónico --}}
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu correo
                    electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nombre@ejemplo.com" required>
            </div>

            {{-- Campo de Contraseña --}}
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu
                    contraseña</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
            </div>

            {{-- Botón de Iniciar Sesión --}}
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                Iniciar Sesión
            </button>

            {{-- Enlace para Crear una Cuenta --}}
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                ¿No tienes una cuenta? <a href="{{route('register')}}"
                    class="font-medium text-blue-700 hover:underline dark:text-blue-500">Crear una cuenta</a>
            </p>
        </form>
    </div>
</div>
@endsection