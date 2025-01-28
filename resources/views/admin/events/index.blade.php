<x-app-layout>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <div class="row py-2 section-bgcolor d-flex justify-content-center">
                    <div class="col-2 p-2 border-filter-region text-center text-font text-color fw-bold">
                        <select name="event_region" class="select-filter">
                            <option value="">Regione</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-2 p-2  border-filter-location text-center text-font text-color fw-bold">
                        <select name="event_region" class="select-filter">
                            <option value="">Location</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-2 p-2 border-filter-dress-code  text-center text-font text-color fw-bold">
                        <select name="event_region" class="select-filter">
                            <option value="">Dress Code</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-2 p-2  border-filter-date text-center text-font text-color fw-bold">
                        <select name="event_region" class="select-filter">
                            <option value="">Data</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-2 p-2 border-filter-price text-center text-font text-color fw-bold">
                        <select name="event_region" class="select-filter">
                            <option value="">Prezzo</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="{{route('admin.events.create')}}">
                    <button class="btn btn-primary">
                        crea evento
                    </button>
                </a>
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
