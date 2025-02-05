<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\EventDressCode;
use App\Models\EventLocation;
use App\Models\Favorite;
use App\Models\User;

class FavoriteController extends Controller
{

    public function toggleFavorite(Request $request)
    {
        $user = auth()->user(); // utente autenticato
        $eventId = $request->input('event_id'); // ID dell'evento

        
        // controllo se l'evento esiste
        $event = Event::find($eventId);
        if (!$event) {
            return response()->json(['error' => 'Evento non trovato'], 404);
        }
        
        // relazione favoriteEvents caricata
        $user->loadMissing('favoriteEvents');
        
        
        // controllo se l'evento è già nei preferiti
        if ($user->favoriteEvents->contains($event->id)) {
            $user->favoriteEvents()->detach($event->id);
            return response()->json(['status' => 'removed']);
        } else {
            $user->favoriteEvents()->attach($event->id, ['created_at' => now(), 'updated_at' => now()]); 
            return response()->json(['status' => 'added']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user(); 
        $favorites = $user->favoriteEvents()->orderBy('favorites.created_at', 'desc')->get();

        $eventId = $user->favoriteEvents;
        $allFavoriteGalleries = Gallery::whereIn('event_id', $eventId->pluck('id'))->get();

        $selectedEvent = null;
        $selectedGalleries = collect();

        // Se è stato selezionato un evento, lo recuperiamo
        if ($request->has('event')) {
            $selectedEvent = Event::with(['eventLocation', 'eventDressCode', 'galleries'])
                ->find($request->input('event'));

            if ($selectedEvent) {
                $selectedGalleries = $selectedEvent->galleries;
            }
        }

        return view('admin.favorites.index', compact('user', 'favorites', 'selectedEvent', 'selectedGalleries', 'allFavoriteGalleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
