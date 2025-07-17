<x-backend-layout>
    @section('title', 'Member Service')
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
        Member's Service
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.getMembers') }}">Members</a></li>
        <li class="breadcrumb-item active">Member's Service</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Service</h5>

                    </div>
                    <div class="card-body">
                        <section class="" style="background-color: #ffffff;">
                            <div class="container py-3">
                                @foreach ($memberServices as $memberService)
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card mb-4">
                                                <div class="card-body text-center shadow-sm">
                                                    <img src="{{ asset('uploads/member/service/' . $memberService->image) }}"
                                                        alt="avatar" class="rounded-circle img-fluid" width="150x">
                                                    <h5 class="my-3">{{ $memberService->title }}</h5>
                                                    <p class="text-muted mb-4">{{ $memberService->category->name }}</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card mb-4">
                                                <div class="card-body shadow-sm">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-0">Title</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mb-0">{{ $memberService->title }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-0">Service Category name</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mb-0">
                                                                {{ $memberService->category->name }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-0">Service Sub Category name</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mb-0">
                                                                {{ $memberService->subcategory->name }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>


                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-0">District</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mb-0">
                                                                {{ $memberService->district->name }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-0">City</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mb-0">
                                                                {{ $memberService->city->name }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="mb-0">Description</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mb-0">
                                                                {{ $memberService->description }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row">
                                                        @if ($memberService->weeklyAvailabilities->isEmpty())
                                                            <a href="javascript:void(0)" class="text-danger"><b>
                                                                    <i class="fa fa-exclamation-circle mr-2"></i>Not
                                                                    Availability</a>
                                                        @else
                                                            <a
                                                                href="{{ route('admin.memberAvailability', ['service' => $memberService->id]) }}"><b>
                                                                    <i class="fa fa-eye mr-2"></i>View Availability</a>
                                                        @endif

                                                        <a class="btn btn-sm btn-primary mt-1" title="Edit"
                                                            href="{{  URL::signedRoute('service-provider.service.edit', ['service' => $memberService]) }}">
                                                            <i class="fa fa-pencil"> </i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

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
