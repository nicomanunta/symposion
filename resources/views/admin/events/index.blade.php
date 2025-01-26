<x-app-layout>
    

    <div class="container d-flex ">
        <div class="row width-index border-1 me-0">
            <div class="col-12">
                <h1>ciaooo</h1>
                <a href="{{route('admin.events.create')}}">
                    <button class="btn btn-primary">
                        crea evento
                    </button>
                </a>
            </div>
            <div class="col-12">
                @foreach ($events as $event)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <h5 class="card-title">{{$event->event_title}}</h5>
                        <a href="{{route('admin.events.edit', ['event' => $event->id])}}">
                            <button class="btn btn-primary">
                                modifica evento
                            </button>
                        </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="row width-show border-1 ms-0">
            <div class="col-12">
                <h1>ciaooo</h1>
            </div>
        </div>
    </div>

    
</x-app-layout>
