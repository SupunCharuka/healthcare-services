<x-form-section submit="updateProfileInformation">

    <x-slot name="form">
        <div class="card-header bg-white mb-3 p-0">
            <h5 class="">Profile Information</h5>
            <p>Update your account\'s profile information and email address.</p>
        </div>
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4 profile-img">

                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                    x-on:change="photoName = $refs.photo.files[0].name; const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]); " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        referrerpolicy="no-referrer" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2 new-pro-img" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4 mt-3 mb-3">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email"
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="phone" value="{{ __('Mobile Number') }}" />
            <div wire:ignore>
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" />
        </div>
            <x-input-error for="phone" class="mt-2" />
        </div>
        
        @if (!Auth::user()->hasRole('admin'))
            @if (Auth::user()->member_type == 'doctor')
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="slmc_number" value="{{ __('SLMC Number') }}" />
                    <x-input id="slmc_number" type="text" class="mt-1 block w-full"
                        wire:model.defer="state.slmc_number" />
                    <x-input-error for="slmc_number" class="mt-2" />
                </div>
            @endif
        @endif


        <div class="col-span-6 sm:col-span-4 mt-3">
            <x-label for="gender" value="{{ __('Gender') }}" />
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input type="radio" wire:model="state.gender" value="male" class="form-radio h-4 w-4 text-indigo-600 border border-gray-300 focus:ring-indigo-500">
                    <span class="ml-2">Male</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" wire:model="state.gender" value="female" class="form-radio h-4 w-4 text-indigo-600 border border-gray-300 focus:ring-indigo-500">
                    <span class="ml-2">Female</span>
                </label>
            </div>
            <x-input-error for="gender" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3 text-success" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
@push('scripts')
    <script src="{{ asset('assets/frontend/js/intlTelInput.min.js') }}"></script>
    <script>
        const input = document.querySelector("#phone");

        const iti = window.intlTelInput(input, {
            utilsScript: "{{ asset('assets/frontend/js/build/utils.js') }}",
            initialCountry: "LK",
            separateDialCode: true,
        });
        input.addEventListener('change', function() {
            @this.set('state.phone', iti.getNumber());
        });
    </script>
@endpush