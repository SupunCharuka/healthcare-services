<x-customer-layout>
    @section('title', 'Profile')
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/intlTelInput.css') }}">
    </x-slot>
    @if (Session::has('message'))
        <script src="{{ asset('assets/backend/js/jquery-3.6/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/notify/bootstrap-notify.min.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <script>
            $.notify({

                icon: 'glyphicon glyphicon-alert',
                title: '<strong class="text-center">Oops!</strong>',
                message: '{{ Session::get('message') }}'
            }, {

                type: 'danger',
                allow_dismiss: true,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                delay: 5000,
                animate: {
                    enter: 'animated bounceIn',
                    exit: 'animated bounceOut'
                }
            });
        </script>
    @endif
    <div>
        <div class="max-w-7xl mx-auto py-0 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                {{-- <x-section-border /> --}}
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                {{-- <x-section-border /> --}}
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                {{-- <x-section-border /> --}}
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <div class="mt-10 sm:mt-0">
                <livewire:profile.deactivate />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                {{-- <x-section-border /> --}}

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
    <x-slot name="scripts">
    </x-slot>
</x-customer-layout>
