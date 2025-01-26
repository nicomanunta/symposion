<x-style-layout>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-9 my-5 px-4 py-2 section-bgcolor">
                <h1 class="mb-4 mt-2 text-center title-font title-color text-uppercase">Modifica il tuo evento</h1>
                {{-- FORM MODIFICA EVENTO --}}
                <form action="{{route('admin.events.update', ['event' => $event->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group my-3 row d-flex align-content-between">
                        {{-- event_title --}}
                        <div class="col-6">
                            <label for="event_title" class="mb-1">Titolo</label>
                            <input class="form-control" type="text" name="event_title" id="event_title" placeholder="Titolo" value="{{old('event_title', $event->event_title)}}" required>
                            @error('event_title')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        {{-- event_subtitle --}}
                        <div class="col-6">
                            <label for="event_subtitle" class="mb-1">Titolo</label>
                            <input class="form-control" type="text" name="event_subtitle" id="event_subtitle" placeholder="Titolo" value="{{old('event_subtitle', $event->event_subtitle)}}" required>
                            @error('event_subtitle')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex my-3 align-content-between">
                        {{-- location_id --}}
                        <div class="col-4">
                            <label class="mb-1" for="location_id">Location</label>
                            <select class="form-control" name="location_id" id="location_id">
                                <option value="">Seleziona il tipo di location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{old('location_id', $event->location_id) == $location->id ? 'selected' : ''}}>
                                        {{ $location->location_name }}  
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        {{-- dress_code_id --}}
                        <div class="col-4">
                            <label class="mb-1" for="dress_code_id">Dress code</label>
                            <select class="form-control" name="dress_code_id" id="dress_code_id">
                                <option value="">Seleziona il tipo di location</option>
                                @foreach ($dressCodes as $dressCode)
                                    <option value="{{ $dressCode->id }}" {{old('dress_code_id', $event->dress_code_id) == $dressCode->id ? 'selected' : ''}}>
                                        {{ $dressCode->dress_code_name }}  
                                    </option>
                                @endforeach
                            </select>
                            @error('dress_code_id')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        {{-- event_price --}}
                        <div class="col-4">
                            <label for="event_price" class="mb-1">Prezzo</label>
                            <div class="input-group">
                                <input type="number" class="form-control input-number" name="event_price" id="event_price" placeholder="Prezzo per accedere" value="{{old('event_price', $event->event_price)}}" step="0.01" min="0">
                                <span class="input-group-text">&euro;</span>
                            </div>
                            @error('event_price')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row d-flex align-content-between my-3">
                        {{-- event_img --}}
                        <div class="col-6">
                            <label class="mb-1" for="event_img">Immagine in primo piano</label>
                            <input class="form-control" type="file" name="event_img" id="event_img" accept="image/*" value="{{$event->event_img}}">
                            @error('event_img')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        {{-- galleries --}}
                        <div class="col-6">
                            <label class="mb-1" for="galleries">Immagini secondarie</label>
                            <input class="form-control" type="file" name="galleries[]" id="galleries"  accept="image/*"  multiple>
                            @error('galleries.*')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- event_description --}}
                    <div class="form-group my-3">
                        <label for="event_description" class="mb-1">Descrizione</label>
                        <textarea class="form-control" name="event_description" id="event_description" placeholder="Spiega di cosa si tratta, dai dei dettagli sull'evento">{{ old('event_description', $event->event_description)}}</textarea>
                        @error('event_description')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4 mb-3 row d-flex align-content-between">
                        <h2 class="title-font title-color text-uppercase text-center mb-3">Luogo, Data e Orari</h2>
                        {{-- event_region --}}
                        <div class="col-4">
                            <label class="mb-1" for="event_region">Regione</label>
                            <select class="form-control" name="event_region" id="event_region" required>
                                <option value="">Seleziona una Regione </option>
                                <option value="Abruzzo" {{old('region', $event->event_region) == 'Abruzzo' ? 'selected' : ''}}>Abruzzo</option>
                                <option value="Basilicata" {{old('region', $event->event_region) == 'Basilicata' ? 'selected' : ''}}>Basilicata</option>
                                <option value="Calabria" {{old('region', $event->event_region) == 'Calabria' ? 'selected' : ''}}>Calabria</option>
                                <option value="Campania" {{old('region', $event->event_region) == 'Campania' ? 'selected' : ''}}>Campania</option>
                                <option value="Emilia-Romagna" {{old('region', $event->event_region) == 'Emilia-Romagna' ? 'selected' : ''}}>Emilia-Romagna</option>
                                <option value="Friuli-Venezia Giulia" {{old('region', $event->event_region) == 'Friuli-Venezia Giulia' ? 'selected' : ''}}>Friuli-Venezia Giulia</option>
                                <option value="Lazio" {{old('region', $event->event_region) == 'Lazio' ? 'selected' : ''}}>Lazio</option>
                                <option value="Liguria" {{old('region', $event->event_region) == 'Liguria' ? 'selected' : ''}}>Liguria</option>
                                <option value="Lombardia" {{old('region', $event->event_region) == 'Lombardia' ? 'selected' : ''}}>Lombardia</option>
                                <option value="Marche" {{old('region', $event->event_region) == 'Marche' ? 'selected' : ''}}>Marche</option>
                                <option value="Molise" {{old('region', $event->event_region) == 'Molise' ? 'selected' : ''}}>Molise</option>
                                <option value="Piemonte" {{old('region', $event->event_region) == 'Piemonte' ? 'selected' : ''}}>Piemonte</option>
                                <option value="Puglia" {{old('region', $event->event_region) == 'Puglia' ? 'selected' : ''}}>Puglia</option>
                                <option value="Sardegna" {{old('region', $event->event_region) == 'Sardegna' ? 'selected' : ''}}>Sardegna</option>
                                <option value="Sicilia" {{old('region', $event->event_region) == 'Sicilia' ? 'selected' : ''}}>Sicilia</option>
                                <option value="Toscana" {{old('region', $event->event_region) == 'Toscana' ? 'selected' : ''}}>Toscana</option>
                                <option value="Trentino-Alto Adige" {{old('region', $event->event_region) == 'Trentino-Alto Adige' ? 'selected' : ''}}>Trentino-Alto Adige</option>
                                <option value="Umbria" {{old('region', $event->event_region) == 'Umbria' ? 'selected' : ''}}>Umbria</option>
                                <option value="Valle d'Aosta" {{old('region', $event->event_region) == 'Valle d\'Aosta' ? 'selected' : ''}}>Valle d'Aosta</option>
                                <option value="Veneto" {{old('region', $event->event_region) == 'Veneto' ? 'selected' : ''}}>Veneto</option>
                            </select>
                            @error('event_region')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        {{-- event_city --}}
                        <div class="col-4">
                            <label class="mb-1" for="event_city">Comune</label>
                            <input class="form-control" type="text" name="event_city" id="event_city" placeholder="Comune" value="{{old('event_city', $event->event_city)}}" required>
                            @error('event_city')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        {{-- event_address --}}
                        <div class="col-4">
                            <label class="mb-1" for="event_address">Indirizzo</label>
                            <input class="form-control" type="text" name="event_address" id="event_address" placeholder="es. Via Rossi 10" value="{{old('event_address', $event->event_address)}}" required>
                            @error('event_address')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group my-3 row d-flex align-content-between">
                        {{-- event_date --}}
                        <div class="col-8">
                            
                            <label class="mb-1" for="event_date">Data</label>
                            <input class="form-control" type="date" name="event_date" id="event_date" placeholder="Data" value="{{old('event_date', $event->event_date)}}" required>
                            @error('event_date')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        {{-- event_start --}}
                        <div class="col-2">
                            <label class="mb-1" for="event_start">Orario inizio </label>
                            <input class="form-control" type="time" name="event_start" id="event_start" placeholder="Inizio" value="{{old('event_start', $event->event_start)}}" required>
                            @error('event_start')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        {{-- event_end --}}
                        <div class="col-2">
                            <label class="mb-1" for="event_end">Orario fine</label>
                            <input class="form-control" type="time" name="event_end" id="event_end" placeholder="Fine" value="{{old('event_end', $event->event_end)}}" required>
                            @error('event_end')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end my-4 mx-3">
                        <button type="submit" class="btn btn-primary">Salva evento</button>
                    </div>


                </form>
                
            </div>
        </div>
    </div>

    
</x-style-layout>
