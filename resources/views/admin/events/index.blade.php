<x-app-layout>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <h1 class="text-uppercase text-center title-font title-color">Visualizza salva e crea eventi</h1>
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
    <div class="container d-flex ">
        <div class="row width-index section-bgcolor py-2 me-1">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <select name="event_region" class="form-control select-todolist">
                            <option value="">Tutte le Etichette</option>
                            @foreach ($events as $event)
                                <option value="{{$event->event_region}}" {{ request('event_region') == $event->event_region ? 'selected' : '' }}>{{$event->event_region}}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
            </div>
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
        
        <div class="row width-show section-bgcolor py-2  ms-1">
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
