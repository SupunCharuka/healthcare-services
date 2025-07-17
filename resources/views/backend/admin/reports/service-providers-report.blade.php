@extends('backend.layouts.master')
@section('title', 'Reports | Service Providers')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/date-picker.css') }}">
@endsection
@section('breadcrumb-title', ' Service Providers')


@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Service Providers</li>
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

                            </div>

                            <table class="table table-striped table-bordered dt-responsive nowrap display"
                                id="serviceProviders" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($serviceProviders as $key => $serviceProvider)
                                        <tr id="serviceProvider-record-{{ $serviceProvider->id }}">
                                            <td>{{ $serviceProvider->id }}</td>
                                            <td>{{ $serviceProvider->user->name }}</td>
                                            <td>{{ $serviceProvider->user->phone }}</td>
                                            <td>{{ $serviceProvider->user->email }}</td>
                                            <td>{{ $serviceProvider->created_at->format('m/d/Y')}}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
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
    <script src="{{ asset('js/admin/reports/service-provider.js') }}"></script>

@endsection
