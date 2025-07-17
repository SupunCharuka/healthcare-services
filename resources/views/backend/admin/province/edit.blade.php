<x-backend-layout>
    <x-slot name="styles">
       <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
    </x-slot>
    <x-slot name="breadcrumb_title">
       Edit Province Name
    </x-slot>
    <x-slot name="breadcrumb_items">
       <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
       <li class="breadcrumb-item active"><a href="{{ route('admin.province') }}">Manage Province | District & City</a></li>
       <li class="breadcrumb-item active">Edit Province Name</li>
    </x-slot>
    <div>
       <div class="row">
          <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
             <livewire:admin.province.edit :province="$province" />
          </div>
       </div>
    </div>
 </x-backend-layout>
