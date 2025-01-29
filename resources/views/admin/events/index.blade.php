<x-app-layout>
    <div class="container mt-3 mb-5 ">
        <div class="row">
            <div class="col-12">
                <div class="row py-2 d-flex justify-content-center">
                    
                    <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter text-center ">
                        <label class="text-font text-color fw-bold" for="event_region">Dove</label>
                        <select name="event_region" class="select-filter py-0">
                            <option class="" value="">Filtra regione</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter text-center ">
                        <label class="text-font text-color fw-bold" for="event_region">Quando</label>
                        <select name="event_region" class="select-filter py-0 py-0">
                            <option value="">Filtra data</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter text-center ">
                        <label class="text-font text-color fw-bold" for="event_region">In quale location</label>
                        <select name="event_region" class="select-filter py-0">
                            <option value="">Filtra location</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter  text-center ">
                        <label class="text-font text-color fw-bold" for="event_region">Come mi vesto</label>
                        <select name="event_region" class="select-filter py-0">
                            <option value="">Filtra dress code</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    
                    <div class="col-2 mx-1 little-section-bgcolor p-2 border-filter text-center ">
                        <label class="text-font text-color fw-bold" for="event_region">Quanto costa</label>
                        <select name="event_region" class="select-filter py-0">
                            <option value="">Filtra prezzo</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-1  ms-1 text-center d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn-search text-color fw-bold w-100 h-100">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {{-- ELENCO EVENTI --}}
    <div class="container d-flex">
        <div class="row width-index  py-2 me-1">
            <div class="col-12">
                <div class="row justify-content-center my-2">
                @foreach ($events as $event)
                        <div class="card-event col-6 px-3" >
                            <a href="{{ route('admin.events.index', ['event' => $event->id]) }}" class="text-decoration-none">
                            <img src="{{ asset('storage/' . $event->event_img) }}" class="card-img-event" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title mt-3">{{ $event->event_title }}</h5>
                                    <span class="text-region text-font text-color truncate-multiline mt-2">
                                        {{$event->event_region}}, {{$event->event_city}}, {{$event->event_address}} 
                                    </span>
                                    <span class="text-date text-font text-color truncate-multiline mt-1">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d-m-Y') }}
                                    </span>
                                    <h6 class="text-start my-2 text-price">
                                        @if ($event->event_price == 0)
                                            Gratis
                                        @else 
                                            {{$event->event_price}} &euro;
                                        @endif
                                    </h6>
                                    

                                </div>
                            </a>
                            
                            
                            {{-- <a href="{{route('admin.events.edit', ['event' => $event->id])}}">
                                <button class="btn btn-primary">
                                    modifica evento
                                </button>
                            </a> --}}
                        </div>
                        
                        @endforeach
                    </div>
                    
            </div>
        </div>
        

        {{-- DETTAGLI EVENTI --}}
        <div class="row width-show py-2 ms-1 ">
            <div class="col-12 ">
                @if ($selectedEvent)
                    <h1>Dettagli Evento</h1>
                    <h3>{{ $selectedEvent->event_title }}</h3>
                    <p>{{ $selectedEvent->event_description }}</p>
                    <p>Data: {{ $selectedEvent->event_date }}</p>
                    <p>Luogo: {{ $selectedEvent->event_address }}</p>
                    <div id="carouselExampleIndicators" class="carousel slide" >
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
                    </div>
                    
                    
                @else
                    <h1>Seleziona un evento per vedere i dettagli</h1>
                @endif
            </div>

            
        </div>
        
    </div>


</x-app-layout>
{{--  --}}

