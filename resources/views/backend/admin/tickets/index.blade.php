@extends('backend.layouts.master')
@section('title', 'Support Tickets')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Support Tickets')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Support Tickets</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="tickets">
                                <thead>
                                    <tr>
                                        <th>Ticket Id</th>
                                        <th>User Name</th>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Ticket Id</th>
                                        <th>User Name</th>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Actions</th>
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
    <script src="{{ asset('js/admin/tickets/ticket.js') }}"></script>
@endsection
