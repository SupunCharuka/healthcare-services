<x-backend-layout>
    @section('title', 'Service')
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/intlTelInput.css') }}">
    </x-slot>

    <x-slot name="breadcrumb_title">
        Manage Service
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Manage Service</li>
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <livewire:member.service.create />
                </div>
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Manage Service </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap"
                                    id="memberService" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>Phone No</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th style="max-width: 400px;" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $key => $service)
                                            <tr id="service-record-{{ $service->id }}">
                                                <td>{{ $service->id }}</td>
                                                <td>{{ $service->title }}</td>
                                                <td>{{ $service->category->name }}</td>
                                                <td>{{ $service->subcategory->name }}</td>
                                                <td>{{ $service->district->name }}</td>
                                                <td>{{ $service->city->name }}</td>
                                                <td>{{ $service->number }}</td>
                                                <td>{{ $service->description }}</td>
                                                <td><img class="img"
                                                        src="{{ asset('uploads/service-provider/service/' . $service->image) }}"
                                                        alt="" width="35"></td>
                                                <td>
                                                    @if ($service->status === 'approved')
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif ($service->status === 'rejected')
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @else
                                                        <span class="badge badge-info">Pending</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @can('update', $service)
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ URL::signedRoute('service-provider.service.edit', ['service' => $service]) }}">
                                                            <i class="fa fa-pencil"> </i>
                                                        </a>
                                                    @endcan
                                                    @can('delete', $service)
                                                        <a class="btn btn-sm delete-service btn-danger"
                                                            data-service="{{ $service->id }}"
                                                            id="service-{{ $service->id }}" href="javascript:void(0)">
                                                            <i class="fa fa-trash"> </i>
                                                        </a>
                                                    @endcan
                                                    @can('update', $service)
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('service-provider.bankDetails', ['service' => $service]) }}">
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>Phone No</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th style="max-width: 400px;" class="text-center">Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/member/services/service.js') }}"></script>

    </x-slot>
</x-backend-layout>
