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
        $user = auth()->user(); // Recupera l'utente autenticato
        $eventId = $request->input('event_id'); // Prendi l'ID dell'evento

        // Controlla se l'evento esiste
        $event = Event::find($eventId);
        if (!$event) {
            return response()->json(['error' => 'Evento non trovato'], 404);
        }

        // Assicurati che la relazione favoriteEvents sia caricata
        $user->loadMissing('favoriteEvents');

        // Controlla se l'evento è già nei preferiti
        if ($user->favoriteEvents->contains($event->id)) {
            $user->favoriteEvents()->detach($event->id); // Rimuove dai preferiti
            return response()->json(['status' => 'removed']);
        } else {
            $user->favoriteEvents()->attach($event->id); // Aggiunge ai preferiti
            return response()->json(['status' => 'added']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user(); 
        $favorites = $user->favoriteEvents; 

        $selectedEvent = null;

        if ($request->has('event')) {
            $selectedEvent = Event::find($request->input('event'));
        }

        return view('admin.favorites.index', compact('user', 'favorites', 'selectedEvent'));
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
