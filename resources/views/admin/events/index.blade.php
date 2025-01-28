<x-app-layout>
    <div class="container my-3">
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
    <div class="container  d-flex ">
        <div class="row width-index  py-2 me-1">
            <div class="col-12 ">
                @foreach ($events as $event)
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('admin.events.index', ['event' => $event->id]) }}" class="text-decoration-none">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->event_title }}</h5>
                            </div>
                        </a>
                            
                        <a href="{{route('admin.events.edit', ['event' => $event->id])}}">
                            <button class="btn btn-primary">
                                modifica evento
                            </button>
                        </a>
                        
                    </div>
                @endforeach
            </div>
        </div>
        

        {{-- DETTAGLI EVENTI --}}
        <div class="row width-show  py-2  ms-1">
            <div class="col-12 ">
                @if ($selectedEvent)
                    <h1>Dettagli Evento</h1>
                    <h3>{{ $selectedEvent->event_title }}</h3>
                    <p>{{ $selectedEvent->event_description }}</p>
                    <p>Data: {{ $selectedEvent->event_date }}</p>
                    <p>Luogo: {{ $selectedEvent->event_address }}</p>
                @else
                    <h1>Seleziona un evento per vedere i dettagli</h1>
                @endif
            </div>
        </div>
        
    </div>
    
</x-app-layout>

