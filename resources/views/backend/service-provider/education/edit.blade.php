<x-backend-layout>
    @section('title', 'Education')
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
    </x-slot>
    <x-slot name="breadcrumb_title">
        Edit My Education
    </x-slot>
    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
        @if (Auth::user()->getRoleNames()->first() == 'admin')
            <li class="breadcrumb-item active"><a
                    href="{{ route('admin.doctorEducation', $education->user_id) }}">{{ $education->user->name }}'s
                    Education</a></li>
        @else
            <li class="breadcrumb-item active"><a href="{{ route('service-provider.education', Auth::user()->id) }}">My
                    Education</a></li>
        @endif

        <li class="breadcrumb-item active">Edit My Education</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <livewire:member.education.edit :education="$education" />
            </div>
        </div>
    </div>
</x-backend-layout>
