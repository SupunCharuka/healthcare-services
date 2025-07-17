@extends('backend.layouts.master')
@section('title', 'Reports | Payment Invoices')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/date-picker.css') }}">
@endsection
@section('breadcrumb-title', 'Payment Invoices')


@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Payment Invoices</li>
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
                                            <option value="{{ $serviceCategoryName->name }}">
                                                {{ $serviceCategoryName->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <table class="table table-striped table-bordered dt-responsive nowrap display" id="invoice"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Inquiry ID</th>
                                        <th>Name</th>
                                        <th>Service Category Name</th>
                                        <th>Payment Type</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentInvoices as $key => $invoice)
                                        <tr id="invoice-record-{{ $invoice->id }}">
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->inquiry_id }}</td>
                                            <td>{{ $invoice->inquiry->name }}</td>
                                            <td>{{ $invoice->inquiry->serviceCategory->name }}</td>
                                            <td>
                                                @if ($invoice->payment_type == 'online')
                                                    Online Payment
                                                @elseif($invoice->payment_type == 'bank_transfer')
                                                    Bank Transfer
                                                @endif
                                            </td>
                                            <td>{{ $invoice->created_at->format('m/d/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Inquiry ID</th>
                                        <th>Name</th>
                                        <th>Service Category Name</th>
                                        <th>Payment Type</th>
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
    <script src="{{ asset('js/admin/reports/invoice.js') }}"></script>

@endsection
