<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreEventDressCodeRequest;
use App\Http\Requests\UpdateEventDressCodeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\EventDressCode;
use App\Models\EventLocation;
use App\Models\Favorite;
use App\Models\User;

class EventDressCodeController extends Controller
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
    public function store(StoreEventDressCodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventDressCode $eventDressCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventDressCode $eventDressCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventDressCodeRequest $request, EventDressCode $eventDressCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventDressCode $eventDressCode)
    {
        //
    }
}
