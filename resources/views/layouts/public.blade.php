<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Mindcare Club'))</title>
    <link rel="icon" href="{{ asset('img/cropped-MCC-Fav-32x32.png') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('header')
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        {{-- Navbar --}}
        @include('partials.navbar')

        {{-- Hero Section --}}
        @yield('hero')

        {{-- Main Content --}}
        <main class="container py-4 flex-grow-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.footer')
    </div>
</body>

</html>