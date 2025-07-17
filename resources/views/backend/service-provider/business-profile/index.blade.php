<x-backend-layout>
    <x-slot name="styles">
    </x-slot>
    <x-slot name="breadcrumb_title">
        Manage Business Profile
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
        @if (Auth::user()->getRoleNames()->first() == 'admin')
            <li class="breadcrumb-item active"><a
                    href="{{ route('admin.viewBusinessProfile', $business) }}">{{ $business->user->name }}'s
                    Business</a></li>
        @endif
        <li class="breadcrumb-item active">Business Profile</li>
    </x-slot>


    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <livewire:service-provider.business-profile.create :existingdata="$business" />
                </div>

            </div>

        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('assets/backend/js/canvasResize/binaryajax.js') }}"></script>
        <script src="{{ asset('assets/backend/js/canvasResize/exif.js') }}"></script>
        <script src="{{ asset('assets/backend/js/canvasResize/canvasResize.js') }}"></script>
    </x-slot>
</x-backend-layout>
