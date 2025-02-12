<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informazioni Profilo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="form-group mb-3 row d-flex align-content-between">
            <!-- Name -->
            <div class="col-6">
                <label for="name" class="mb-1 label-form">Nome</label>
                <input class="form-control shadow-input" type="text" name="name" id="name" placeholder="Titolo" value="{{old('name', $user->name)}}" required>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Surname -->
            <div class="col-6">
                <label for="surname" class="mb-1 label-form">Cognome</label>
                <input class="form-control shadow-input" type="text" name="surname" id="surname" placeholder="Titolo" value="{{old('surname', $user->surname)}}" required>
                <x-input-error class="mt-2" :messages="$errors->get('surname')" />    
            </div>
        </div>
    

       

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
