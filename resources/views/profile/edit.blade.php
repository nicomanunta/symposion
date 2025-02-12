<x-style-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" space-y-6">
            <div class="p-4  section-bgcolor">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 section-bgcolor">
                <div class="">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 section-bgcolor">
                <div class="">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-style-layout>
