<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validazione dei dati del form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone'=> ['nullable', 'string', 'max:15'],
            'region' => ['required', 'string', 'max:50'],
            'city' => ['required', 'string', 'max:50'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Assicurati che il nome del campo sia corretto
        ]);
    
        
        $userImgPath = null;
        if ($request->hasFile('img')) {
            $userImgPath = $request->file('img')->store('user_img', 'public');
            
        }
       

        // Crea l'utente nel database
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'region' => $request->region,
            'city' => $request->city,
            'password' => Hash::make($request->password),
            'img' => $userImgPath, // Salva il percorso dell'immagine (non solo 'img' come nel tuo codice)
        ]);
    
        // Esegui l'evento di registrazione
        event(new Registered($user));
    
        // Logga l'utente appena creato
        Auth::login($user);
    
        // Reindirizza alla pagina successiva
        return redirect(route('admin.events.index', absolute: false));
    }
    
}
