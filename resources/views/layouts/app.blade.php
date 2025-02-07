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
    <body class="font-sans antialiased height-min 0 general-bgcolor overflow-hidden">
        <div class="col ">
            <header class=" ">
                @include('layouts.navigation')
            </header>
        </div>
        <div class="container ">
            <div class="row ">
                <div class="col-12 ">
                    <main class="">
                        {{ $slot }}
                    </main>
                </div> 
                

            </div>
        </div>
        <script>
            function adjustHeight() {
            let navbar = document.querySelector('.navbar');
                let filtersRow = document.querySelector('.filters-row');
                let widthIndex = document.querySelector('.width-index');
                let widthShow = document.querySelector('.width-show');

                if (widthIndex && widthShow) {
                    let navbarHeight = navbar ? navbar.offsetHeight : 0;
                    let filtersHeight = filtersRow ? filtersRow.offsetHeight : 0;

                    // Calcolo dell'altezza disponibile
                    let availableHeight = window.innerHeight - navbarHeight - (filtersRow ? filtersHeight : 0) - 60;
                    
                    // Imposta l'altezza delle sezioni
                    widthIndex.style.height = availableHeight + "px";
                    widthShow.style.height = availableHeight + "px";
                }

                // Ripristino della posizione dello scroll
                setTimeout(() => {
                    restoreScrollPosition();  // Ripristina lo scroll di widthIndex
                }, 50);
            }

            function restoreScrollPosition() {
                const widthIndex = document.querySelector('.width-index');
                if (widthIndex && sessionStorage.getItem("widthIndex-scrollPosition") !== null) {
                    // Ripristina lo scroll della sezione widthIndex
                    widthIndex.scrollTop = sessionStorage.getItem("widthIndex-scrollPosition");
                    sessionStorage.removeItem("widthIndex-scrollPosition");
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                adjustHeight(); // Adattamento dell'altezza

                // Salva posizione scroll solo quando si clicca su un link di evento
                document.querySelectorAll("a.event-link").forEach(function (link) {
                    link.addEventListener("click", function () {
                        // Salva solo lo scroll della sezione widthIndex
                        const widthIndex = document.querySelector(".width-index");
                        if (widthIndex) {
                            console.log("Salvata posizione scroll: ", widthIndex.scrollTop);
                            sessionStorage.setItem("widthIndex-scrollPosition", widthIndex.scrollTop);
                        }
                    });
                });
            });

            window.addEventListener("resize", adjustHeight);







             // chiamata quando viene selezionato un evento
            function selectEvent(eventId) {
                document.querySelector('.width-show').classList.add('active');
                
            }


          
            

            

            
        </script>
        
    </body>
</html>
