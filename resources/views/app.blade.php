<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Динамическая смена названия страниц (название вкладки) -->
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        
        @routes <!-- ziggy, роуты -->
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="antialiased flex flex-col h-screen overflow-hidden">
        @inertia
    </body>
</html>
