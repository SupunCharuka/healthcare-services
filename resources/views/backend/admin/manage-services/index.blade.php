@extends('backend.layouts.master')
@section('title', 'Manage Services')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
@endsection
@section('breadcrumb-title', 'Manage Services')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manage Services</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">

                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Manage Services</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="manageService">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Service Provider Name</th>
                                            <th>Service Name</th>
                                            <th>Service Category name</th>
                                            <th>Service Sub Category name</th>
                                            <th>Mobile Number</th>
                                            <th>Image</th>
                                            <th>Bank Details</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Service Provider Name</th>
                                            <th>Service Name</th>
                                            <th>Service Category name</th>
                                            <th>Service Sub Category name</th>
                                            <th>Mobile Number</th>
                                            <th>Image</th>
                                            <th>Bank Details</th>
                                            <th>Status</th>
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
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>
    <script src="{{ asset('js/admin/manage-services/manage-service.js') }}"></script>
@endsection
