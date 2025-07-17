@extends('backend.customer.layouts.master')

@section('title', 'Support Ticket')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection

@section('content')
    <div class="content-container">
        <div class="outer-container">


            <div class="doctors-appointment">
                <div class="title-box inquiry">
                    <h3>Support Ticket </h3>
                    <div>
                    <a class="btn btn-success mt-2" href="{{ route('customer.supportTicket.create') }}">
                        Add Ticket
                    </a>
                </div>
               
                </div>
                <div class="doctors-list">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-striped  dt-responsive nowrap dataTable no-footer" id="tickets"  style="width:100%">
                                <thead class="table-header">
                                    <tr>
                                        <th>Ticket Id</th>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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
    <script src="{{ asset('js/customer/support-ticket/support-ticket.js') }}"></script>

@endsection
