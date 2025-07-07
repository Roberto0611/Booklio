@extends('layouts.app', ['hideNavbar' => true]) {{-- Oculta el navbar --}}

@section('content')
{{-- Contenedor principal para centrar el formulario en la página --}}
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 p-4 sm:p-6 lg:p-8">

    {{-- Botón de Regresar --}}
    <div class="w-full max-w-md mb-6">
        <a href="{{ route('landing') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out">
            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
            </svg>
            Regresar
        </a>
    </div>

    {{-- Tarjeta del formulario de registro --}}
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-2xl p-8 space-y-6 transform transition-all duration-300 hover:scale-[1.01]">
        <div class="text-center">
            {{-- Logo de Booklio --}}
            <img class="mx-auto h-20 w-auto mb-4" src="{{asset('images/logos/full-logo-svg.svg')}}" alt="Booklio Logo">
            <h1 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                Crear Cuenta
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Únete a la comunidad de Booklio
            </p>
        </div>

        <form class="space-y-6" action="{{ route('validad-registro') }}" method="POST">
    @csrf

    {{-- Campo de Nombre --}}
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de usuario</label>
        <input type="text" name="name" id="name"
               value="{{ old('name') }}"
               class="bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="Juan Pérez" required>
        @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Campo de Correo Electrónico --}}
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu correo electrónico</label>
        <input type="email" name="email" id="email"
               value="{{ old('email') }}"
               class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="nombre@ejemplo.com" required>
        @error('email')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Campo de Contraseña --}}
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu contraseña</label>
        <input type="password" name="password" id="password"
               class="bg-gray-50 border @error('password') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="••••••••" required>
        @error('password')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Campo de Confirmar Contraseña --}}
    <div>
        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="••••••••" required>
    </div>

    {{-- Botón de Registrarse --}}
    <button type="submit"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-200 ease-in-out transform hover:-translate-y-0.5">
        Registrarse
    </button>

    {{-- Enlace para Iniciar Sesión --}}
    <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
        ¿Ya tienes una cuenta?
        <a href="{{ route('login') }}" class="font-medium text-blue-700 hover:underline dark:text-blue-500">Iniciar Sesión</a>
    </p>
</form>
    </div>
</div>
@endsection
