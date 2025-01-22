<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

    
        <!-- Name -->
        <div class="form-group mb-3">
            <x-input-label for="name" :value="__('Nome')" />
            <input class="form-control mt-1" type="text" name="name" id="name" placeholder="Nome" value="{{ old('name')}}" required>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />    
        </div>

        <!-- Surname -->
        <div class="form-group mb-3">
            <x-input-label for="surname" :value="__('Cognome')" />
            <input class="form-control mt-1" type="text" name="surname" id="surname" placeholder="Cognome" value="{{ old('surname')}}" required>
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />    
        </div>

        <!-- Email  -->
        <div class="form-group mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <input class="form-control mt-1" type="text" name="email" id="email" placeholder="Cognome" value="{{ old('email')}}" required>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />    
        </div>
        
        <!-- Phone -->
        <div class="form-group mb-3">
            <x-input-label for="phone" :value="__('Telefono')" />
            <input class="form-control mt-1" type="text" name="phone" id="phone" placeholder="Cognome" value="{{ old('phone')}}" >
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />    
        </div>

        <!-- Region -->
        <div class="form-group mb-3">
            <x-input-label for="region" :value="__('Regione')" />
            <select class="form-control mt-1" name="region" id="region">
                <option value="Abruzzo {{old('region') == 'Uomo' ? 'selected' : ''}}">Abruzzo</option>
                <option value="Basilicata">Basilicata</option>
                <option value="Calabria">Calabria</option>
                <option value="Campania">Campania</option>
                <option value="Emilia-Romagna">Emilia-Romagna</option>
                <option value="Friuli-Venezia Giulia">Friuli-Venezia Giulia</option>
                <option value="Lazio">Lazio</option>
                <option value="Liguria">Liguria</option>
                <option value="Lombardia">Lombardia</option>
                <option value="Marche">Marche</option>
                <option value="Molise">Molise</option>
                <option value="Piemonte">Piemonte</option>
                <option value="Puglia">Puglia</option>
                <option value="Sardegna">Sardegna</option>
                <option value="Sicilia">Sicilia</option>
                <option value="Toscana">Toscana</option>
                <option value="Trentino-Alto Adige">Trentino-Alto Adige</option>
                <option value="Umbria">Umbria</option>
                <option value="Valle d'Aosta">Valle d'Aosta</option>
                <option value="Veneto">Veneto</option>
            </select>
            <x-input-error :messages="$errors->get('region')" class="mt-2" />    
        </div>

        <!-- City -->
        <div class="form-group mb-3">
            <x-input-label for="city" :value="__('Città')" />
            <input class="form-control mt-1" type="text" name="city" id="city" placeholder="Cognome" value="{{ old('city')}}" >
            <x-input-error :messages="$errors->get('city')" class="mt-2" />    
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
