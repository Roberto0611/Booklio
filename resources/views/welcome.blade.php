@extends('layouts.app', ['hideNavbar' => true]) {{-- Oculta el navbar --}}

@section('content')
{{-- Sección Principal (Hero) --}}
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 flex flex-col items-center justify-center text-center p-4 sm:p-6 lg:p-8 relative overflow-hidden">
    {{-- Patrón de fondo sutil para interés visual --}}
    <div class="absolute inset-0 z-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239C92AC\' fill-opacity=\'.2\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zm0 30v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zm0-30V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    {{-- Contenido central de la landing page --}}
    <div class="relative z-10 max-w-5xl mx-auto bg-gray-800 bg-opacity-90 rounded-lg shadow-2xl p-8 sm:p-10 lg:p-12 transform transition-all duration-300 hover:scale-[1.01]">
        {{-- Título principal --}}
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
            Bienvenido a <span class="text-blue-500">Booklio</span>
        </h1>

        {{-- Descripción de la aplicación --}}
        <p class="text-lg sm:text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Tu espacio personal para descubrir, registrar y compartir tus aventuras literarias.
            Conecta con amigos y explora un mundo de libros.
        </p>

        {{-- Contenedor de botones de acción --}}
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            {{-- Botón para Iniciar Sesión --}}
            <a href="{{route('login')}}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                Iniciar Sesión
                <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h11m0 0-4-4m4 4-4 4m-4 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h2"/>
                </svg>
            </a>

            {{-- Botón para Crear Cuenta --}}
            <a href="{{route('register')}}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-blue-600 bg-white border border-blue-600 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                Crear Cuenta
                <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            </a>
        </div>
    </div>
</div>

{{-- Sección de Características --}}
<section class="py-20 bg-white dark:bg-gray-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-12 text-center">
            ¿Por qué usar Booklio?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Característica 1: Organiza tus Lecturas --}}
            <div class="bg-gray-100 dark:bg-gray-700 p-8 rounded-lg shadow-lg text-center transform transition-all duration-300 hover:scale-105">
                <div class="text-blue-500 mb-4">
                    {{-- Icono de libro/biblioteca --}}
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.202 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.798 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.798 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.202 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Organiza tus Lecturas</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Lleva un registro de los libros que has leído, los que estás leyendo y los que quieres leer.
                </p>
            </div>
            {{-- Característica 2: Conecta con Amigos --}}
            <div class="bg-gray-100 dark:bg-gray-700 p-8 rounded-lg shadow-lg text-center transform transition-all duration-300 hover:scale-105">
                <div class="text-blue-500 mb-4">
                    {{-- Icono de personas/comunidad --}}
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a3 3 0 015.356-1.857M17 20v-9a2 2 0 00-2-2H7a2 2 0 00-2 2v9m4-11h2m-2 0h2m-2 0v2m2-2v2m-2 0h2m-2 0v2m2-2v2"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Conecta con Amigos</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Descubre qué están leyendo tus amigos, comparte tus opiniones y recomendaciones.
                </p>
            </div>
            {{-- Característica 3: Explora Nuevos Títulos --}}
            <div class="bg-gray-100 dark:bg-gray-700 p-8 rounded-lg shadow-lg text-center transform transition-all duration-300 hover:scale-105">
                <div class="text-blue-500 mb-4">
                    {{-- Icono de búsqueda/descubrimiento --}}
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.592 1M12 8V5m0 0a2 2 0 110-4 2 2 0 010 4zm-7.586 14.586a2 2 0 01-2.828-2.828l.793-.793m12.004-.793a2 2 0 01-2.828 2.828l-.793-.793m-4.004-12.004a2 2 0 01-2.828-2.828l-.793-.793m12.004-.793a2 2 0 01-2.828 2.828l-.793-.793"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Explora Nuevos Títulos</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Accede a un vasto catálogo de libros y encuentra tu próxima gran lectura.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Sección de Llamada a la Acción (CTA) Final --}}
<section class="py-20 bg-gray-900 dark:bg-gray-900 text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-extrabold mb-6">
            ¡Comienza tu aventura literaria hoy mismo!
        </h2>
        <p class="text-lg text-gray-300 mb-8">
            Únete a la comunidad de amantes de los libros. Es gratis y fácil.
        </p>
        <a href="#" class="inline-flex items-center justify-center px-10 py-5 text-lg font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
            Registrarse ahora
            <svg class="w-5 h-5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
        </a>
    </div>
</section>

{{-- Pie de Página (Footer) --}}
<footer class="bg-gray-800 dark:bg-gray-900 py-8 text-center text-gray-400 text-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <p>&copy; {{ date('Y') }} Booklio. Todos los derechos reservados.</p>
        <div class="flex justify-center space-x-4 mt-4">
            <a href="#" class="hover:text-white transition-colors duration-200">Privacidad</a>
            <a href="#" class="hover:text-white transition-colors duration-200">Términos</a>
            <a href="#" class="hover:text-white transition-colors duration-200">Contacto</a>
        </div>
    </div>
</footer>
@endsection
