<x-backend-layout>
    <x-slot name="styles">
       <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
    </x-slot>
    <x-slot name="breadcrumb_title">
       Edit Permission
    </x-slot>
    <x-slot name="breadcrumb_items">
       <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
       <li class="breadcrumb-item active"><a href="{{ route('admin.permission') }}">Manage Permissions</a></li>
       <li class="breadcrumb-item active">Edit permissions</li>
    </x-slot>
    <div>
       <div class="row">
          <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
             <livewire:admin.edit-permission :permission="$permission" />
          </div>
       </div>
    </div>
 </x-backend-layout>
 