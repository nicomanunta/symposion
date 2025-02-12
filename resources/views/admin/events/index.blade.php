<x-app-layout>
    <div class="container mt-3 mb-4  filters-row ">
        <form action="{{ route('admin.events.index') }}" method="GET">
            <div class="row ">
                <div class="col-12">
                    <div class="row py-2 d-flex justify-content-center">
                        <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter text-center {{ request('event_region') ? 'filter-active' : '' }}">
                            <label class="text-font text-color fw-bold" for="event_region">Dove</label>
                            <select name="event_region" class="select-filter py-0" onchange="this.form.submit()">
                                <option class="" value="">Filtra regione</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region }}" {{ request('event_region') == $region ? 'selected' : '' }}>
                                        {{ $region }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter text-center {{ request('order_by_date') ? 'filter-active' : '' }}">
                            <label class="text-font text-color fw-bold" for="order_by_date">Quando</label>
                            <select name="order_by_date" class="select-filter py-0 py-0" onchange="this.form.submit()">
                                <option value="">Ordina per data</option>
                                <option value="asc" {{ request('order_by_date') == 'asc' ? 'selected' : '' }}>Dal più recente</option>
                                <option value="desc" {{ request('order_by_date') == 'desc' ? 'selected' : '' }}>Dal meno recente</option>    
                            </select>
                        </div>

                        <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter text-center {{ request('event_location') ? 'filter-active' : '' }}">
                            <label class="text-font text-color fw-bold" for="event_location">In quale location</label>
                            <select name="event_location" class="select-filter py-0" onchange="this.form.submit()">
                                <option value="">Filtra location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location }}" {{ request('event_location') == $location ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter  text-center {{ request('event_dress_code') ? 'filter-active' : '' }} ">
                            <label class="text-font text-color fw-bold" for="event_dress_code">Come mi vesto</label>
                            <select name="event_dress_code" class="select-filter py-0" onchange="this.form.submit()">
                                <option value="">Filtra dress code</option>
                                @foreach ($dress_codes as $dress_code)
                                    <option value="{{$dress_code}}" {{ request('event_dress_code') == $dress_code ? 'selected' : '' }}>{{$dress_code}}</option>
                                @endforeach 
                            </select>
                        </div>

                        <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter text-center {{ request('order_by_price') ? 'filter-active' : '' }}">
                            <label class="text-font text-color fw-bold" for="order_by_price">Quanto costa</label>
                            <select name="order_by_price" class="select-filter py-0" onchange="this.form.submit()">
                                <option value="">Ordina per prezzo</option>
                                <option value="asc" {{ request('order_by_price') == 'asc' ? 'selected' : '' }}>Dal meno caro</option>
                                <option value="desc" {{ request('order_by_price') == 'desc' ? 'selected' : '' }}>Dal più caro</option>    
                            </select>
                        </div>
                        {{--
                        
                        <div class="col-1  ms-1 text-center d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn-search button-bgcolor text-color fw-bold w-100 h-100">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div> --}}
                    </div>
                </div>   
            </div>
        </form>
    </div>

    <div class="container d-flex ">
        {{-- ELENCO EVENTI --}}
        <div class="row width-index  pt-1 me-3 ">
            <div class="col-12">
                <div class="row my-2">
                    

                    @foreach ($events as $event)
                        <div class="card-event col-6 px-3 mb-4">
                            <a href="{{ route('admin.events.index', ['event' => $event->id]) }}" class="text-decoration-none event-link">
                                
                                @php 
                                    $carouselId = "carousel-" . $event->id; 
                                    $galleriesForEvent = $allGalleries->where('event_id', $event->id)->values(); 
                                    
                                @endphp


                                <div id="{{ $carouselId }}" class="carousel slide" >
                                    <!-- indicatori -->
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        @foreach ($galleriesForEvent as $index => $gallery)
                                            <button type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide-to="{{ $index + 1 }}" aria-label="Slide {{ $index + 2 }}"></button>
                                        @endforeach
                                    </div>

                                    <div class="carousel-inner">
                                        <!-- immagine principale -->
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/' . $event->event_img) }}" class="d-block  card-img-event" alt="Event Image">
                                        </div>

                                        <!-- immagini della galleria -->
                                        @foreach ($galleriesForEvent as $gallery)
                                            <div class="carousel-item">
                                                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="d-block card-img-event">
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <!-- bottoni carosello -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                                        <span class="ms-2" aria-hidden="true"><i class="fa-solid fa-circle-chevron-left"></i></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                        <span class="me-2" aria-hidden="true"><i class="fa-solid fa-circle-chevron-right"></i></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>

                               
                                <div class="card-body">
                                    <h5 class="card-title title-font  mt-3">{{ $event->event_title }}</h5>
                                    <span class="text-region text-font text-color truncate-multiline mt-2">
                                        {{ $event->event_region }}, {{ $event->event_city }}, {{ $event->event_address }}
                                    </span>
                                    <span class="text-date text-font text-color truncate-multiline mt-1">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d-m-Y') }}
                                    </span>
                                    <h6 class="text-start my-2 text-price">
                                        @if ($event->event_price == 0)
                                            Gratis
                                        @else 
                                            {{ $event->event_price }} &euro;
                                        @endif
                                    </h6>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    

                </div>
                    
            </div>
       
        </div>

        {{-- DETTAGLI EVENTI --}}
        <div class="row width-show  ms-3 mb-4 ">
                                    
            @if ($selectedEvent)
                <div class="col-12  ">
                    <div class="p-3 pt-2 position-relative">
                        <h2 class="title-font title-color  text-start mb-1">{{ $selectedEvent->event_title }}</h2>
                        <form id="favoriteForm" action="{{ route('favorites.toggle') }}" method="POST">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $selectedEvent->id }}">
                            <button type="button" id="favoriteButton" class="position-absolute btn-star-show-event button-font button-bgcolor">
                                @if (auth()->user()->favoriteEvents->contains($selectedEvent->id))
                                    <i class="fa-solid fa-star star-piena"></i> <span>Rimuovi</span>
                                @else
                                    <i class="fa-regular fa-star star-vuota"></i> <span>Salva</span>
                                @endif
                            </button>
                        </form>
                    </div>
                    <div class="img-gallery pb-3 px-3  ">
                        <!--immagine principale -->
                        <div class="img-primary">
                            <img id="mainImage" src="{{ asset('storage/' . $selectedEvent->event_img) }}" class="d-block" alt="Event Image">
                        </div>
            
                        <!-- immagini galleria -->
                        <div class="gallery-secondary ">
                            <div class="img-secondary mb-2 ">
                                <img src="{{ asset('storage/' . $selectedEvent->event_img) }}" alt="Event Image" class="d-block "
                                    onclick="changeMainImage(this)">
                            </div>
            
                            @foreach ($selectedGalleries as $gallery)
                                <div class="img-secondary mb-2 ">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="d-block "
                                        onclick="changeMainImage(this)">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class=" px-3 text-font text-color">
                        <h5 class="subtitle-font text-color  fw-bold text-price fs-5">{{ $selectedEvent->event_subtitle }}</h5>
                        <div class="d-flex justify-content-between text-font text-color">
                            <div >
                                <p class="">{{ $selectedEvent->event_region }}, {{ $selectedEvent->event_city }}, {{ $selectedEvent->event_address }}</p>
                            </div>
                            <div class="me-3">    
                                <p class="">{{ \Carbon\Carbon::parse($selectedEvent->event_date)->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        
                        <p class="mb-2">{{ $selectedEvent->event_description }} Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus quia ab et libero fugiat pariatur, laboriosam provident recusandae voluptatum autem, dolor explicabo itaque dignissimos laborum voluptatem ipsam mollitia, soluta nesciunt.</p>

                        <div class="text-end me-3 fs-5 text-price mb-4">
                            @if ($selectedEvent->event_price == 0)
                                <b>Gratis</b>
                            @else 
                                <b>{{ $selectedEvent->event_price }} &euro;</b>
                            @endif
                        </div>

                        <div class=" d-flex justify-content-between ">
                            <div>
                                <span>Location: <b>{{$selectedEvent->eventLocation->location_name}}</b></span>
                                <br>
                                <span>Dress code: <b>{{$selectedEvent->eventDressCode->dress_code_name}}</b></span>
                            </div>
                            <div class="me-3 text-end">
                                <span>Orario inizio: <b>{{ \Carbon\Carbon::parse($selectedEvent->event_start)->format('H:i') }}</b></span>
                                <br>
                                <span>Orario fine: <b>{{ \Carbon\Carbon::parse($selectedEvent->event_end)->format('H:i') }}</b></span>
                            </div>
                        </div>
                        <div class="mt-5 text-font text-color ">
                            <h4 class=" fw-bold mb-3">Contatti</h4>
                            <div class="d-flex">
                                <div class="col-6">
                                    <a class="text-decoration-none" href="{{ auth()->user()->id == $selectedEvent->user->id ? route('profile.show') : route('profile.users', ['user' => $selectedEvent->user->id]) }}">
                                        @if ($selectedEvent->user->img)
                                            <img class=" profile-img-show text-center my-1" src="{{ asset('storage/' . $selectedEvent->user->img) }}" alt="Foto del creatore">   
                                        @else
                                            <img class="profile-img-show my-2" src="{{ URL::asset('/img/yellow-profile-img.png') }}" alt="Foto del creatore">
                                        @endif
                                        <span class="ms-2 text-color text-font"><b>{{ $selectedEvent->user->name }} {{ $selectedEvent->user->surname }}</b></span>
                                    </a>     
                                </div>
                                
                                <div class="col-6 ">
                                    <div class="my-1">Email: <b>{{$selectedEvent->user->email}}</b></div>
                                
                                    <div class="my-1">Telefono: <b>{{$selectedEvent->user->phone}}</b></div>
                                </div>

                            </div>
                  

                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">

                    <h1 class="text-center title-font title-color mt-5 mx-5">Seleziona un evento per vedere i dettagli</h1>
                </div>

            @endif
       

            
        </div>
        
    </div>

<script>
    function changeMainImage(image) {
        document.getElementById('mainImage').src = image.src;
    }


    document.getElementById('favoriteButton').addEventListener('click', function () {
        let formData = new FormData(document.getElementById('favoriteForm'));

        fetch("{{ route('favorites.toggle') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        }).then(response => response.json())
        .then(data => {
            let button = document.getElementById('favoriteButton');
            let icon = button.querySelector("i");
            let text = button.querySelector("span");

            if (data.status === 'added') {
                icon.classList.remove("fa-regular", "star-vuota");
                icon.classList.add("fa-solid", "star-piena");
                text.innerText = "Rimuovi";
            } else if (data.status === 'removed') {
                icon.classList.remove("fa-solid", "star-piena");
                icon.classList.add("fa-regular", "star-vuota");
                text.innerText = "Salva";
            }
        })
        .catch(error => console.error("Errore:", error));
        
    });
    document.addEventListener("DOMContentLoaded", function () {
        // se esiste un evento selezionato, abilita lo scroll nei dettagli
        if (document.querySelector('.width-show .col-12')) {
            document.querySelector('.width-show').classList.add('active');
        }
    });

   

</script>
</x-app-layout>
{{--<div id="carouselExampleIndicators" class="carousel slide" >
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" ></button>
                            @foreach ($galleries as $index => $gallery)
                                <button type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide-to="{{ $index + 1 }}" aria-label="Slide {{ $index + 2 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            <!-- Primo elemento attivo -->
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $selectedEvent->event_img) }}" class="d-block w-100" alt="Event Image">
                            </div>
                    
                            <!-- Aggiungi gli elementi della galleria -->
                            @foreach($galleries as $gallery)
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="d-block w-100">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                    </div>  --}}


