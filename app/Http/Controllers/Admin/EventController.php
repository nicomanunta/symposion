<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\EventDressCode;
use App\Models\EventLocation;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $query = Event::with(['eventLocation', 'eventDressCode', 'user']);

        // FILTRI
            // recupera le regioni utilizzate
            $regions = Event::pluck('event_region')->unique()->sort();
            // recupera le locations utilizzate
            $locations = Event::with('eventLocation')->get()->pluck('eventLocation.location_name')->unique()->sort();
            // recupera le dress codes utilizzate
            $dress_codes = Event::with('eventDressCode')->get()->pluck('eventDressCode.dress_code_name')->unique()->sort();


            // filtro regione se presente
            if ($request->has('event_region') && $request->event_region != '') {
                $query->where('event_region', $request->event_region);
            }

            // filtro ordinare per data se presente
            if ($request->has('order_by_date') && in_array($request->order_by_date, ['asc', 'desc'])) {
                $query->orderBy('event_date', $request->order_by_date);
                // rimuovi filtro 'order_by_price' dalla query
                $request->merge(['order_by_price' => '']);
            }
            // filtro ordinare per prezzo se presente
            elseif ($request->has('order_by_price') && in_array($request->order_by_price, ['asc', 'desc'])) {
                $query->orderBy('event_price', $request->order_by_price);
                // rimuovi il filtro 'order_by_date' dalla query
                $request->merge(['order_by_date' => '']);
            }else {
                $query->orderBy('created_at', 'desc');
            }

            // filtro location se presente
            if ($request->has('event_location') && $request->event_location != '') {
                $query->whereHas('eventLocation', function ($q) use ($request) {
                    $q->where('location_name', $request->event_location);
                });
            }

            // filtro dress_code se presente
            if ($request->has('event_dress_code') && $request->event_dress_code != '') {
                $query->whereHas('eventDressCode', function ($q) use ($request) {
                    $q->where('dress_code_name', $request->event_dress_code);
                });
            }
            



        // eventi dopo aver applicato il filtro
        $events = $query->get();

        // immagini per tutti gli eventi
        $allGalleries = Gallery::whereIn('event_id', $events->pluck('id'))->get();

        // immagini dell'evento selezionato
        $selectedEvent = null;
        $selectedGalleries = collect(); 

        if ($request->has('event')) {
            $selectedEvent = Event::with(['eventLocation', 'eventDressCode', 'user'])->find($request->input('event'))->fresh();
            if ($selectedEvent) {
                $selectedGalleries = $selectedEvent->galleries;
            }
        }

        return view('admin.events.index', compact('events', 'allGalleries', 'selectedEvent', 'selectedGalleries', 'regions', 'locations', 'dress_codes'));
    }

    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = EventLocation::all();
        $dressCodes = EventDressCode::all();

        return view('admin.events.create', compact( 'locations', 'dressCodes'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        //dati inseriti nel form
        $form_data = $request->all();

        
        // salvataggio immagine primaria nella cartella 'event_img' all'interno di storage
        if ($request->hasFile('event_img')) {
            // e aggiorna il percorso nel form_data
            $form_data['event_img'] = $request->file('event_img')->store('event_img', 'public');
        }
        
        $event = new event();
        
        // assegno user_id dopo la creazione
        $event->user_id = auth()->user()->id;
        
        $event->fill($form_data);
        $event->save();  // Salvo le modifiche
        
        
        // salvataggio immagini galleria nella cartella gallery_img all'interni di storage
        if ($request->hasFile('galleries')) {
            foreach ($request->file('galleries') as $galleryImage) {
                // salva l'immagine 
                $galleryPath = $galleryImage->store('gallery_img', 'public');
                
                // associo ogni immagine della tabella galleries all'evento
                $event->galleries()->create([
                    'image_path' => $galleryPath,
                    'event_id' => $event->id,
                ]);
                
            }
        }
        return redirect()->route('admin.events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $galleries = $event->galleries;
        return view('admin.events.show',compact('event', 'galleries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $locations = EventLocation::all();
        $dressCodes = EventDressCode::all();
        return view('admin.events.edit', compact('event', 'locations', 'dressCodes'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //dati inseriti nel form
        $form_data = $request->all();

        
        // salvataggio immagine primaria nella cartella 'event_img' all'interno di storage
        if ($request->hasFile('event_img')) {
             // cancello l'immagine esistente se presente
            if ($event->event_img) {
                Storage::disk('public')->delete($event->event_img);
            }
            // e aggiorna il percorso nel form_data
            $form_data['event_img'] = $request->file('event_img')->store('event_img', 'public');
        }
        
        $event->update($form_data);  // aggiorno le modifiche
        
        
        // salvataggio immagini galleria nella cartella gallery_img all'interni di storage
        if ($request->hasFile('galleries')) {
            // cancello le immagini della galleria esistenti se necessario
            foreach ($event->galleries as $existingGallery) {
                Storage::disk('public')->delete($existingGallery->image_path);
                $existingGallery->delete(); // elimino il record dalla tabella galleries
            }
            foreach ($request->file('galleries') as $galleryImage) {
                // salva l'immagine 
                $galleryPath = $galleryImage->store('gallery_img', 'public');
                
                // associo ogni immagine della tabella galleries all'evento
                $event->galleries()->create([
                    'image_path' => $galleryPath,
                    'event_id' => $event->id,
                ]);
                
            }
        }
        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // elimino immagini collegate a questo evento
        $galleries = $event->galleries;
        foreach ($galleries as $gallery) {
            if ($gallery->image_path) {
                Storage::delete($gallery->image_path);
            }
            $gallery->delete(); 
        }

        // rimuovo evento dai preferiti
        $event->favoritedByUsers()->detach();

        // elimino l'evento
        $event->delete();
        
        return redirect()->route('admin.events.index');
    }
}
