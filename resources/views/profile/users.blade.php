<x-style-layout>
    <div class="container">
        <div class="row mt-5">
            <div class="col-4 d-flex justify-content-center ">
                @if ($user->img != null)
                    <img class="ms-2 profile-img text-center" src="{{ asset('storage/' . $user->img) }}" alt="Foto del dipendente">   
                @else
                    <img class="profile-img" src="{{URL::asset('/img/yellow-profile-img.png')}}" alt="">
                @endif
                
            </div>
            <div class="col-5  d-flex align-content-center flex-wrap">
                <h1 class="title-font title-color">{{$user->name}} {{$user->surname}}</h1>
                <div class="w-100 mt-3 text-font text-color ms-2">
                    <span class="pe-3 fs-4 ">Creati: <b>{{$createdEventsCount}}</b></span>
                   
                </div>
               
            </div>
            
        </div>
        <div class="row mt-5 ">
            <div class="col-4 text-font text-color ps-5">
                <span class="pe-3 fs-5 mb-1 d-block">Email: <b>{{$user->email}}</b></span>
                <span class="pe-3 fs-5  mb-1 d-block">Telefono: <b>{{$user->phone}}</b></span>
                <span class="pe-3 fs-5  mb-1 d-block">Regione: <b>{{$user->region}}</b></span>
                <span class="pe-3 fs-5 ">Città: <b>{{$user->city}}</b></span>
            </div>
            <div class="col-8">
                <div class="row m-0">
                    @foreach ($events as $event)
                        <div class=" col-4 ps-0 pe-4 mb-4">
                            <a href="{{ route('admin.events.show', ['event' => $event->id]) }}" class="text-decoration-none">
                                
                                @php 
                                    $profileCarouselId = "carousel-" . $event->id; 
                                    $galleriesForEvent = $allGalleriesProfile->where('event_id', $event->id)->values(); 
                                    
                                @endphp


                                <div id="{{ $profileCarouselId }}" class="carousel slide" >
                                    <!-- indicatori -->
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#{{ $profileCarouselId }}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        @foreach ($galleriesForEvent as $index => $gallery)
                                            <button type="button" data-bs-target="#{{ $profileCarouselId }}" data-bs-slide-to="{{ $index + 1 }}" aria-label="Slide {{ $index + 2 }}"></button>
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
                                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $profileCarouselId }}" data-bs-slide="prev" >
                                        <span class="ms-2" aria-hidden="true"><i class="fa-solid fa-circle-chevron-left"></i></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $profileCarouselId }}" data-bs-slide="next" >
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
    </div>

    <script>
        function changeMainImage(image) {
            document.getElementById('mainImage').src = image.src;
        }
        
    </script>
        
</x-style-layout>
