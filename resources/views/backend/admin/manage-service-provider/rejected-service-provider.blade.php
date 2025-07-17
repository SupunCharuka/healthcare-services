@extends('backend.layouts.master')
@section('title', 'Rejected Service Providers')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

@endsection
@section('breadcrumb-title', 'Service Providers')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Rejected Service Providers</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="service-provider"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Profile Photo</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Created at</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($serviceProviders as $key => $serviceProvider)
                                        <tr id="serviceProvider-record-{{ $serviceProvider->id }}">
                                            <td>{{ $serviceProvider->id }}</td>
                                            <td>
                                                <img src="{{ $serviceProvider->user->profile_photo_url }}" alt="Avatar"
                                                    class="rounded-circle" style="width: 50px;" />
                                            </td>
                                            <td class="font-weight-bold">{{ $serviceProvider->user->name }}</td>
                                            <td class="font-weight-bold"><a href="tel:{{ $serviceProvider->user->phone }}">{{ $serviceProvider->user->phone }}</a></td>
                                            <td class="font-weight-bold">{{ $serviceProvider->created_at->format('M d, Y') }}</td>

                                            <td class="text-center">
                                                @if ($serviceProvider->status == App\Utils\Enums::memberRegister['PENDING'])
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif ($serviceProvider->status == App\Utils\Enums::memberRegister['APPROVED'])
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($serviceProvider->status == 1)
                                                    <span class="badge approve-btn p-2 f-14 m-1">
                                                        <i class="fa fa-check fa-lg"></i>
                                                        Approved
                                                    </span>

                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#dataTableModal" data-id={{ $serviceProvider->id }}
                                                        data-userid="{{ $serviceProvider->user_id }}"data-original-title="Reject"
                                                        class="reject p-2 badge badge-danger rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-ban fa-lg"></i><span
                                                            class="f-14 m-1">Reject</span></a>
                                                @elseif ($serviceProvider->status == 2)
                                                    <a href="javascript:void(0)" data-id="{{ $serviceProvider->id }}"
                                                        data-userid="{{ $serviceProvider->user_id }}"
                                                        data-original-title="Approve"
                                                        class="approve p-2 badge badge-success rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-check fa-lg"></i><span
                                                            class="f-14 m-1">Approve</span></a>

                                                    <span class="badge reject-btn  p-2 f-14 m-2">
                                                        <i class="fa fa-ban fa-lg"></i>Rejected
                                                    </span>
                                                @else
                                                    <a href="javascript:void(0)" data-id="{{ $serviceProvider->id }}"
                                                        data-userid="{{ $serviceProvider->user_id }}"
                                                        data-original-title="Approve"
                                                        class="approve p-2 badge badge-success rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-check fa-lg"></i><span
                                                            class="f-14 m-1">Approve</span></a>


                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#dataTableModal" data-id={{ $serviceProvider->id }}
                                                        data-userid="{{ $serviceProvider->user_id }}"data-original-title="Reject"
                                                        class="reject p-2 badge badge-danger rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-ban fa-lg"></i><span
                                                            class="f-14 m-1">Reject</span></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Profile Photo</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Created at</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/admin/manage-service-provider/service-provider.js') }}"></script>
@endsection
