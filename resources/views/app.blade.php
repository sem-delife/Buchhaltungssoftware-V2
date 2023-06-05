<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$page['component'] }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hubballi&display=swap" rel="stylesheet">
        @php
            $componentName = $page['component'];
            $cssFileName = lcfirst($componentName); 
            $cssPath = '/css/' . $cssFileName . '.css';
        @endphp
        <link rel="stylesheet" href="{{ asset($cssPath) }}">
        
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
        
        <script>
            function reloadPage() {
                location.reload();
            }
            
            Inertia.on('success', reloadPage);
        </script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
