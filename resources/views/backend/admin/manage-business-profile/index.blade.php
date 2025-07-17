@extends('backend.layouts.master')
@section('title', 'Business Profile')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Manage Business Profile')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manage Business Profile</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="status-filter">
                                <label for="status">Filter by Status:</label>
                                <select id="statusFilter">
                                    <option value="all">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="business"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th class="text-center">View Details</th>
                                        <th style="max-width: 400px;" class="text-center">Status</th>
                                        <th style="max-width: 400px;" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businesses as $index => $business)
                                        <tr id="business-record-{{ $business->id }}">
                                            <td>{{ $business->id }}</td>
                                            <td>{{ $business->user->name ?? '' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.viewBusinessProfile', $business) }}"><b>
                                                        <i class="fa fa-book mr-2"></i>View Details</a>

                                            <td style="max-width: 400px;" class="text-center">
                                                @if ($business->status == App\Utils\Enums::businessProfile['PENDING'])
                                                    <span class="badge pending-btn p-2 f-14 m-1">
                                                        <i class="fa fa-check fa-lg"></i>Pending
                                                    </span>
                                                @elseif ($business->status == App\Utils\Enums::businessProfile['APPROVED'])
                                                    <span class="badge approve-btn p-2 f-14 m-1">
                                                        <i class="fa fa-check fa-lg"></i>
                                                        Approved
                                                    </span>
                                                @else
                                                    <span class="badge reject-btn  p-2 f-14 m-1">
                                                        <i class="fa fa-ban fa-lg"></i>Rejected
                                                    </span>
                                                @endif
                                            </td>
                                            <td style="max-width: 400px;" class="text-center">
                                                @if ($business->status == 1)
                                                    <span class="badge approve-btn p-2 f-14 m-1">
                                                        <i class="fa fa-check fa-lg"></i>
                                                        Approved
                                                    </span>

                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#dataTableModal" data-id={{ $business->id }}
                                                        data-original-title="Reject"
                                                        class="reject p-2 badge badge-danger rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-ban fa-lg"></i><span
                                                            class="f-14 m-1">Reject</span></a>
                                                @elseif ($business->status == 2)
                                                    <a href="javascript:void(0)" data-id="{{ $business->id }}"
                                                        data-original-title="Approve"
                                                        class="approve p-2 badge badge-success rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-check fa-lg"></i><span
                                                            class="f-14 m-1">Approve</span></a>

                                                    <span class="badge reject-btn  p-2 f-14 m-2">
                                                        <i class="fa fa-ban fa-lg"></i>Rejected
                                                    </span>
                                                @else
                                                    <a href="javascript:void(0)" data-id="{{ $business->id }}"
                                                        data-original-title="Approve"
                                                        class="approve p-2 badge badge-success rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-check fa-lg"></i><span
                                                            class="f-14 m-1">Approve</span></a>


                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#dataTableModal" data-id={{ $business->id }}
                                                        data-original-title="Reject"
                                                        class="reject p-2 badge badge-danger rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-ban fa-lg"></i><span
                                                            class="f-14 m-1">Reject</span></a>
                                                @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th class="text-center">View Details</th>
                                        <th style="max-width: 400px;" class="text-center">Status</th>
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
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/admin/manage-bisiness-profile/business-profile.js') }}"></script>
@endsection
