<x-backend-layout>
    <x-slot name="styles">
       <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
    </x-slot>
    <x-slot name="breadcrumb_title">
       Edit District Name
    </x-slot>
    <x-slot name="breadcrumb_items">
       <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
       <li class="breadcrumb-item active"><a href="{{ route('admin.province.districts') }}">Districts</a></li>
       <li class="breadcrumb-item active">Edit District Name</li>
    </x-slot>
    <div>
       <div class="row">
          <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
             <livewire:admin.district.edit :district="$district" />
          </div>
       </div>
    </div>
 </x-backend-layout>
