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

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.events.index');
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
        return view('admin.events.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
