<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreEventLocationRequest;
use App\Http\Requests\UpdateEventLocationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\EventDressCode;
use App\Models\EventLocation;
use App\Models\Favorite;
use App\Models\User;

class EventLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreEventLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventLocation $eventLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventLocation $eventLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventLocationRequest $request, EventLocation $eventLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventLocation $eventLocation)
    {
        //
    }
}
