<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/scss/main.scss', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="d-flex flex-column min-vh-100">
    <livewire:navbar />
    <main class="flex-fill">
        {{-- Blade pages --}}
        @yield('content')

        {{-- Livewire pages --}}
        {{ $slot ?? '' }}
    </main>
    <livewire:footer />

    @stack('scripts')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>