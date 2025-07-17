@extends('backend.layouts.master')
@section('title', 'Manage Doctors')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

@endsection
@section('breadcrumb-title', 'Doctors')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manage Doctors</li>
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
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="doctorList"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Profile Photo</th>
                                        <th>Name</th>
                                        <th>SLMC Number</th>
                                        <th>Mobile Number</th>
                                        <th>Created at</th>
                                        <th>Education </th>
                                        <th>Work </th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $key => $member)
                                        <tr id="member-record-{{ $member->id }}">
                                            <td>{{ $member->id }}</td>
                                            <td>
                                                <img src="{{ $member->user->profile_photo_url }}" alt="Avatar"
                                                    class="rounded-circle" style="width: 50px;" />
                                            </td>
                                            <td class="font-weight-bold">{{ $member->user->name }}</td>
                                            <td class="font-weight-bold">{{ $member->user->slmc_number }}</td>
                                            <td class="font-weight-bold"><a href="tel:{{ $member->user->phone }}">{{ $member->user->phone }}</a></td>
                                            <td class="font-weight-bold">{{ $member->created_at->format('M d, Y') }}</td>
                                            <td>

                                                @if ($member->user->education->isEmpty())
                                                <a href="javascript:void(0)" class="text-danger"><b>
                                                    <i class="fa fa-exclamation-circle mr-2"></i>Not Details</a>
                                                @else
                                                <a href="{{ route('admin.doctorEducation', $member->user_id) }}" target="_blank"><b>
                                                    <i class="fa fa-book mr-2"></i>View Details</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($member->user->workDetails->isEmpty())
                                                <a href="javascript:void(0)" class="text-danger"><b>
                                                    <i class="fa fa-exclamation-circle mr-2"></i>Not Details</a>
                                                @else
                                                <a href="{{ route('admin.doctorWork', $member->user_id) }}" target="_blank"><b>
                                                    <i class="fa fa-briefcase mr-2"></i>View Details</a>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                @if ($member->status == App\Utils\Enums::memberRegister['PENDING'])
                                                    <span class="badge badge-info">Pending</span>

                                                @elseif ($member->status == App\Utils\Enums::memberRegister['APPROVED'])
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>

                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($member->status == 1)
                                                    <span class="badge approve-btn p-2 f-14 m-1">
                                                        <i class="fa fa-check fa-lg"></i>
                                                        Approved
                                                    </span>

                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#dataTableModal" data-id={{ $member->id }}
                                                        data-userid="{{ $member->user_id }}"data-original-title="Reject"
                                                        class="reject p-2 badge badge-danger rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-ban fa-lg"></i><span
                                                            class="f-14 m-1">Reject</span></a>
                                                @elseif ($member->status == 2)
                                                    <a href="javascript:void(0)" data-id="{{ $member->id }}"
                                                        data-userid="{{ $member->user_id }}" data-original-title="Approve"
                                                        class="approve p-2 badge badge-success rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-check fa-lg"></i><span
                                                            class="f-14 m-1">Approve</span></a>

                                                    <span class="badge reject-btn  p-2 f-14 m-2">
                                                        <i class="fa fa-ban fa-lg"></i>Rejected
                                                    </span>
                                                @else
                                                    <a href="javascript:void(0)" data-id="{{ $member->id }}"
                                                        data-userid="{{ $member->user_id }}" data-original-title="Approve"
                                                        class="approve p-2 badge badge-success rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-check fa-lg"></i><span
                                                            class="f-14 m-1">Approve</span></a>


                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#dataTableModal" data-id={{ $member->id }}
                                                        data-userid="{{ $member->user_id }}"data-original-title="Reject"
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
                                        <th>SLMC Number</th>
                                        <th>Mobile Number</th>
                                        <th>Created at</th>
                                        <th>Education </th>
                                        <th>Work </th>
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
    <script src="{{ asset('js/admin/doctors-list/doctor-list.js') }}"></script>
@endsection
