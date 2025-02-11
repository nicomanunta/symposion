<x-style-layout>
   <div class="container mb-5 ">
      <div class="row d-flex justify-content-center">
         <div class="col-11 ">
            <div>

            </div>
            <div class="p-3 mt-4 mb-3 position-relative ">
                  <h2 class="title-font title-color  text-start mb-1 title-show">{{ $event->event_title }}</h2>
                  <form id="favoriteForm" action="{{ route('favorites.toggle') }}" method="POST">
                     @csrf
                     <input type="hidden" name="event_id" value="{{ $event->id }}">
                     <div class="position-absolute position-button">
                        <button type="button" id="favoriteButton" class=" btn-star-show-event-profile button-font button-bgcolor">
                           @if (auth()->user()->favoriteEvents->contains($event->id))
                                 <i class="fa-solid fa-star star-piena"></i> <span>Rimuovi</span>
                           @else
                                 <i class="fa-regular fa-star star-vuota"></i> <span>Salva</span>
                           @endif
                        </button>
                        @if (Auth::check() && Auth::id() === $event->user_id)
                           <button class="button-bgcolor mx-3 btn-star-show-event-profile button-font">
                              <a class="text-decoration-none color-button-show" href="{{route('admin.events.edit', ['event' => $event->id])}}">
                                 Modifica evento
                              </a>
                           </button>
                           <button class="button-bgcolor btn-star-show-event-profile button-font">
                              <a class="text-decoration-none color-button-show" href="">
                                 Elimina
                              </a>
                           </button>
                        @endif
                     </div>
                  </form>
            </div>
            <div class="img-gallery-show pb-3 px-3  ">
                  <!--immagine principale -->
                  <div class="img-primary-show">
                     <img id="mainImage" src="{{ asset('storage/' . $event->event_img) }}" class="d-block" alt="Event Image">
                  </div>
      
                  <!-- immagini galleria -->
                  <div class="gallery-secondary-show ">
                     <div class="img-secondary-show mb-2 ">
                        <img src="{{ asset('storage/' . $event->event_img) }}" alt="Event Image" class="d-block "
                              onclick="changeMainImage(this)">
                     </div>
      
                     @foreach ($galleries as $gallery)
                        <div class="img-secondary-show mb-2 ">
                              <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="d-block "
                                 onclick="changeMainImage(this)">
                        </div>
                     @endforeach
                  </div>
            </div>
            <div class=" px-3 text-font text-color pt-2">
                  <h5 class="subtitle-font text-color  fw-bold text-price fs-3 mb-2">{{ $event->event_subtitle }}</h5>
                  <div class="d-flex justify-content-between text-font text-color">
                     <div >
                        <p class="fs-details">{{ $event->event_region }}, {{ $event->event_city }}, {{ $event->event_address }}</p>
                     </div>
                     <div class="me-3">    
                        <p class="fs-details">{{ \Carbon\Carbon::parse($event->event_date)->format('d-m-Y') }}</p>
                     </div>
                  </div>
                  
                  <p class="mb-2 fs-details">{{ $event->event_description }} Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus quia ab et libero fugiat pariatur, laboriosam provident recusandae voluptatum autem, dolor explicabo itaque dignissimos laborum voluptatem ipsam mollitia, soluta nesciunt.</p>

                  <div class="text-end me-3 fs-4 text-price mb-5">
                     @if ($event->event_price == 0)
                        <b>Gratis</b>
                     @else 
                        <b>{{ $event->event_price }} &euro;</b>
                     @endif
                  </div>

                  <div class=" d-flex justify-content-between mt-3 fs-details">
                     <div>
                        <span>Location: <b>{{$event->eventLocation->location_name}}</b></span>
                        <br>
                        <span>Dress code: <b>{{$event->eventDressCode->dress_code_name}}</b></span>
                     </div>
                     <div class="me-3 text-end">
                        <span>Orario inizio: <b>{{ \Carbon\Carbon::parse($event->event_start)->format('H:i') }}</b></span>
                        <br>
                        <span>Orario fine: <b>{{ \Carbon\Carbon::parse($event->event_end)->format('H:i') }}</b></span>
                     </div>
                  </div>
            </div>
            @if (Auth::check() && Auth::id() === $event->user_id)
               <div class="mt-5 ps-3">
                  <button class="button-bgcolor me-3 btn-star-show-event-profile button-font">
                     <a class="text-decoration-none color-button-show" href="{{route('admin.events.edit', ['event' => $event->id])}}">
                        Modifica evento
                     </a>
                  </button>
                  <button class="button-bgcolor btn-star-show-event-profile button-font">
                     <a class="text-decoration-none color-button-show" href="">
                        Elimina
                     </a>
                  </button>
               </div>
            @endif
         </div>
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
    </script>   
</x-style-layout>
