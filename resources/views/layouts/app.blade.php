<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="Booklio Icon" href="{{asset('images/logos/book-Icon.svg')}}">
    <title>Booklio</title>
    @vite('resources/css/app.css')
  </head>
<body>

    <header>
        {{-- nav bar --}}
         <x-navbar/>
    </header>

    @yield('content')

    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html> 