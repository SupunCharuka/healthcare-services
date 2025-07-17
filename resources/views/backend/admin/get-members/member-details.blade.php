<x-backend-layout>
    @section('title', 'Profile Details')
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

    </x-slot>

    <x-slot name="breadcrumb_title">
        Member's Profile
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.getMembers') }}">Members</a></li>
        <li class="breadcrumb-item active">Profile Details</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">
                        <section class="" style="background-color: #ffffff;">
                            <div class="container py-3">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="card-body text-center shadow-sm">
                                                <img src="{{ $memberDetails->profile_photo_url }}" alt="avatar"
                                                    class="rounded-circle img-fluid" style="width: 150px;">
                                                <h5 class="my-3">{{ $memberDetails->name }}</h5>
                                                <p class="text-muted mb-4">{{ $memberDetails->email }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-body shadow-sm">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Full Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $memberDetails->name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $memberDetails->email }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Phone Number</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $memberDetails->phone }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                @if ($memberDetails->slmc_number)
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">SLMC Number</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p class="text-muted mb-0">
                                                                {{ $memberDetails->slmc_number }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a class="btn btn-sm btn-primary mt-1" title="Edit"
                                                            href="{{ route('admin.manage-user.edit', ['user' => $memberDetails]) }}">
                                                            <i class="fa fa-pencil"> </i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
    </x-slot>
</x-backend-layout>
