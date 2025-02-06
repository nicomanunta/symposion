<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <!-- Includi Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased vh-100 general-bgcolor">
        <div class="col ">
            <header class=" ">
                @include('layouts.navigation')
            </header>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <main>
                        {{ $slot }}
                    </main>
                </div> 
                

            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // ripristina la posizione dello scroll se salvata
                if (sessionStorage.getItem("scrollPosition") !== null) {
                    window.scrollTo(0, sessionStorage.getItem("scrollPosition"));
                    sessionStorage.removeItem("scrollPosition"); // rimuovo per evitare problemi nei futuri reload
                }
        
                // salva la posizione dello scroll quando si clicca su un link
                document.querySelectorAll("a").forEach(function (link) {
                    link.addEventListener("click", function () {
                        sessionStorage.setItem("scrollPosition", window.scrollY);
                    });
                });
            });
        </script>
        
    </body>
</html>
