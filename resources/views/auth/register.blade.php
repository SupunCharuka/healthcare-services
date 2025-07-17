 <x-frontend-layout>
    @section('title', 'My Account')
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/intlTelInput.css') }}">
    </x-slot>
    @section('content')

        <!-- registration-section -->
        <section class="registration-section bg-color-3 my-account-section">
            <div class="pattern">
                <div class="pattern-1" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-85.png') }}');"></div>
                <div class="pattern-2" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-86.png') }}');"></div>
            </div>
            <div class="auto-container">
            <livewire:auth.register-steps />
            </div>

        </section>
        <!-- registration-section end -->

    @endsection

    <x-slot name="scripts">
        <script src="{{ asset('assets/frontend/js/jquery.paroller.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/product-filter.js') }}"></script>
        {{-- <script src="{{ asset('js/auth/register-password.js') }}"></script> --}}
    </x-slot>
</x-frontend-layout>
