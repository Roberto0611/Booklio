@extends('layouts.app')

@section('content')
    {{-- Contenedor principal para centrar el formulario --}}
    <div
        class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 p-4 sm:p-6 lg:p-8">

        {{-- Botón de Regresar --}}
        <div class="w-full max-w-2xl mb-6 text-left">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-200 ease-in-out">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
                Regresar al Perfil
            </a>
        </div>

        {{-- Tarjeta del formulario de edición de perfil --}}
        <div
            class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-lg shadow-2xl p-8 space-y-6 transform transition-all duration-300 hover:scale-[1.005]">
            <div class="text-center">
                <h1 class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white">
                    Editar Perfil
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Actualiza tu información personal
                </p>
            </div>

            {{-- Mostrar errores generales --}}
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" action="{{route('editProfileLogic')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Campo de Foto de Perfil --}}
                <div class="flex flex-col items-center">
                    <label for="profile_picture" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Foto
                        de Perfil</label>
                    <img class="w-32 h-32 rounded-full object-cover border-4 border-blue-500 dark:border-blue-400 shadow-lg mb-4"
                        id="current_profile_picture" src="https://placehold.co/128x128/2563EB/FFFFFF?text=Usuario"
                        alt="Foto de perfil actual">
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="profile_picture" type="file" name="profile_picture" accept="image/*">
                    @error('profile_picture')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG o GIF (MAX.
                        800x800px).</p>
                </div>

                {{-- Campo de Nombre de Usuario --}}
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de
                        Usuario</label>
                    <input type="text" name="username" id="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('username') border-red-500 @enderror"
                        placeholder="tu_usuario" value="{{ old('username', Auth::user()->name) }}" required>
                    @error('username')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campo de Biografía --}}
                <div>
                    <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biografía</label>
                    <textarea id="bio" name="bio" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('bio') border-red-500 @enderror"
                        placeholder="Cuéntanos sobre ti y tus gustos literarios...">{{ old('bio', Auth::user()->bio) }}</textarea>
                    @error('bio')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Botón de Guardar Cambios --}}
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                    Guardar Cambios
                </button>
            </form>
        </div>
        {{-- Script para previsualizar la imagen seleccionada (opcional) --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const profilePictureInput = document.getElementById('profile_picture');
                const currentProfilePicture = document.getElementById('current_profile_picture');

                if (profilePictureInput && currentProfilePicture) {
                    profilePictureInput.addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                currentProfilePicture.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            });
        </script>
@endsection