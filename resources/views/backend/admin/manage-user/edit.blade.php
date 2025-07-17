<x-backend-layout>
    @section('title', 'Manage User')
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">

    </x-slot>
    <x-slot name="breadcrumb_title">
        Edit User
    </x-slot>
    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        @can('users.add-new')
            <li class="breadcrumb-item active"><a href="{{ route('admin.manage-user') }}">Manage User</a></li>
        @endcan
        @if (Auth::user()->getRoleNames()->first() == 'admin')
            <li class="breadcrumb-item active"><a href="{{ route('admin.memberDetails', $user) }}">Profile Details</a></li>
        @endif
        <li class="breadcrumb-item active">Edit USer</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <livewire:admin.edit-user :user="$user" />
            </div>
        </div>
    </div>
</x-backend-layout>
