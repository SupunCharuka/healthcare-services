@extends('backend.layouts.master')
@section('title', 'Inquiries for ' . $date)
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatable-extension.css') }}">
@endsection
@section('breadcrumb-title', 'Inquiries')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.commission') }}">Commissions</a></li>
    <li class="breadcrumb-item active">Inquiries</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>{{ $service->user->name }} - {{ $service->title }} - <span class="text-muted">{{ $date }}</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap display" id="inquiries">
                                <thead>
                                    <tr>
                                        <th>Inquiry ID</th>
                                        <th>Inquiry Name</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inquiries as $key => $inquiry)
                                        <tr id="inquiry-record-{{ $inquiry->id }}">
                                            <td>{{ $inquiry->id }}</td>
                                            <td>{{ $inquiry->name }}</td>
                                            <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                                            <td>{{ $inquiry->updated_at->format('M d, Y') }}</td>
                                            <td> LKR {{ number_format($inquiry->cost, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Inquiry ID</th>
                                        <th>Inquiry Name</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Cost</th>
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
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/admin/commissions/view-inquiry.js') }}"></script>
@endsection
