<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Event;
use App\Models\User;
use App\Http\Controllers\Admin\EventController;
use App\Models\Gallery;




class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    
    public function usersProfile($userId)
    {
        $user = User::findOrFail($userId);
        $events = Event::with(['eventLocation', 'eventDressCode'])->where('user_id', $user->id)->get();
    
        $allGalleriesProfile = Gallery::whereIn('event_id', $events->pluck('id'))->get();

        $createdEventsCount = $user->events()->count();
        

       return view('profile.users', compact('user', 'createdEventsCount', 'events', 'allGalleriesProfile'));
    }

    public function show()
    {
        $user = auth()->user(); // Ottieni l'utente autenticato
        $events = Event::with(['eventLocation', 'eventDressCode'])->where('user_id', $user->id)->get();
        $allGalleriesProfile = Gallery::whereIn('event_id', $events->pluck('id'))->get();


        $createdEventsCount = $user->events()->count();
        $savedEventsCount = $user->favoriteEvents()->count();

        return view('profile.show', compact('user', 'createdEventsCount', 'savedEventsCount', 'events', 'allGalleriesProfile'));
    }

    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
