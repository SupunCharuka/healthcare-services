@extends('backend.layouts.master')
@section('title', 'Reports | Inquiries')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/date-picker.css') }}">
@endsection
@section('breadcrumb-title', 'Inquiries')


@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Inquiries</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">

                        <div class="table-responsive date-filter">
                            <div id="date-range-filter">
                                <label for="start-date" class="sr-only">Start Date:</label>
                                <input type="text" id="start-date" class="date-picker datepicker-here digits"
                                    placeholder="Start Date" data-language="en" autocomplete="off">
                                <label for="end-date" class="sr-only">End Date:</label>
                                <input type="text" id="end-date" class="date-picker datepicker-here digits"
                                    placeholder="End Date" data-language="en" autocomplete="off">
                                <button id="apply-filter" class="gradient-button">Apply Filter</button>

                                <div class="d-flex district">
                                    <label for="district-filter">Filter by Service Cat. Name:</label>
                                    <select id="district-filter">
                                        <option value="">All</option>
                                        @foreach ($serviceCategoryNames as $serviceCategoryName)
                                            <option value="{{ $serviceCategoryName->name }}">{{ $serviceCategoryName->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <table class="table table-striped table-bordered dt-responsive nowrap display" id="inquiries"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Type</th>
                                        <th>Service Category Name</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inquiries as $key => $inquiry)
                                        <tr id="inquiry-record-{{ $inquiry->id }}">
                                            <td>{{ $inquiry->id }}</td>
                                            <td>{{ $inquiry->name ?? 'Guest' }}</td>
                                            <td>{{ $inquiry->email }}</td>
                                            <td>{{ $inquiry->phone }}</td>
                                            <td>
                                                @if ($inquiry->user->hasRole('customer'))
                                                    @if ($inquiry->user->member_type === 'hotel')
                                                        Hotel
                                                    @else
                                                        Customer
                                                    @endif
                                                @elseif ($inquiry->user->hasRole('service-provider'))
                                                    Service Provider
                                                @else
                                                    Guest
                                                @endif
                                            </td>
                                            <td>{{ $inquiry->serviceCategory->name }}</td>
                                            <td>{{ $inquiry->created_at->format('m/d/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Type</th>
                                        <th>Service Category Name</th>
                                        <th>Created at</th>
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
    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('js/admin/reports/inquiries.js') }}"></script>

@endsection
