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
        // Inizializza la query di base per gli eventi
        $query = Event::with(['eventLocation', 'eventDressCode', 'user'])->orderBy('events.created_at', 'desc');

        $regions = Event::pluck('event_region')->unique()->sort();

        // Aggiungi il filtro per regione se presente nella richiesta
        if ($request->has('event_region') && $request->event_region != '') {
            $query->where('event_region', $request->event_region);
        }

        // Recupera gli eventi dopo aver applicato il filtro
        $events = $query->get();

        // Recupera tutte le immagini per tutti gli eventi
        $allGalleries = Gallery::whereIn('event_id', $events->pluck('id'))->get();

        // Recupera solo le immagini dell'evento selezionato
        $selectedEvent = null;
        $selectedGalleries = collect(); 

        if ($request->has('event')) {
            $selectedEvent = Event::with(['eventLocation', 'eventDressCode', 'user'])->find($request->input('event'))->fresh();
            if ($selectedEvent) {
                $selectedGalleries = $selectedEvent->galleries;
            }
        }

        return view('admin.events.index', compact('events', 'allGalleries', 'selectedEvent', 'selectedGalleries', 'regions'));
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
