<x-app-layout>
    <div class="container d-flex">
       
        {{-- ELENCO EVENTI --}}
        <div class="row width-index border-1 me-0">
            <div class="col-12">
                <h1 class="title-color">I tuoi eventi preferiti</h1>
            </div>
            <div class="col-12">
                @forelse ($favorites as $favorite)
                    <div class="card mb-3" style="width: 18rem;">
                        <img src="{{ asset('storage/' . $favorite->event_img) }}" class="card-img-top" alt="{{ $favorite->event_title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->event_title }}</h5>
                            <a href="{{ route('admin.favorites.index', ['event' => $favorite->id]) }}" class="btn button-bgcolor">Vedi dettagli</a>
                        </div>
                    </div>
                @empty
                    <p class="text-color">Non hai ancora eventi tra i preferiti.</p>
                @endforelse
            </div>
        </div>

       {{-- DETTAGLI EVENTI --}}
        <div class="row width-show border-1 ms-0">
            @if ($selectedEvent)
                <div class="col-12">
                    <h1 class="title-color">{{ $selectedEvent->event_title }}</h1>
                    <p class="text-color">{{ $selectedEvent->description }}</p>
                    <img src="{{ asset('storage/' . $selectedEvent->event_img) }}" alt="{{ $selectedEvent->event_title }}" class="img-fluid">
                    <p class="text-color">Data evento: {{ $selectedEvent->event_date }}</p>
                    <p class="text-color">Luogo: {{ $selectedEvent->location }}</p>
                    <p class="text-color">Creato da: {{ $selectedEvent->user->name }}</p>
                </div>
        @else
            <div class="col-12">
                <h2 class="subtitle-color">Seleziona un evento per visualizzarne i dettagli.</h2>
            </div>
        @endif
    </div>
</div>
</x-app-layout>

