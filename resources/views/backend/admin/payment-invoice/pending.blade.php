<x-backend-layout>
    @section('title', 'Payment Invoice | Pending')
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatable-extension.css') }}">

    </x-slot>

    <x-slot name="breadcrumb_title">
        Payment Invoice
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Payment Invoice</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">

                        <div class="dt-ext table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap display"
                                id="invoices" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Inquiry ID</th>
                                        <th>Name</th>
                                        <th>Category Name</th>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Payment Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $key => $invoice)
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
                                                @else
                                                    Pending
                                                @endif
                                            </td>
                                            <td>LKR {{ $invoice->amount }}</td>
                                            <td style="max-width: 400px;" class="text-center">
                                                @if ($invoice->payment_type == 'bank_transfer')
                                                @if ($invoice->paid == App\Utils\Enums::invoicePaid['APPROVED'] && $invoice->rejected_at == null)
                                                    <span class="badge badge-success">Success</span>
                                                @elseif ($invoice->paid == App\Utils\Enums::invoicePaid['PENDING'] && $invoice->rejected_at != null)
                                                    <span class="badge badge-danger">Failed</span>
                                                @elseif ($invoice->paid == App\Utils\Enums::invoicePaid['PENDING'])
                                                    <span class="badge badge-info">Pending</span>
                                                @endif
                                            @elseif ($invoice->payment_type == 'online')
                                                @if ($invoice->paid == App\Utils\Enums::invoicePaid['APPROVED'] && $invoice->rejected_at == null)
                                                    <span class="badge badge-success">Success</span>
                                                @elseif ($invoice->paid ==  App\Utils\Enums::invoicePaid['PENDING'] && $invoice->rejected_at)
                                                    <span class="badge badge-danger">Failed</span>
                                                @endif
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.paymentDetail', $invoice) }}"><b>
                                                        <i class="fa fa-eye mr-2"></i>View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Inquiry ID</th>
                                        <th>Name</th>
                                        <th>Category Name</th>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Payment Details</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">

        <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
        <script src="{{ asset('js/admin/payment-invoice/payment-invoice.js') }}"></script>
    </x-slot>
</x-backend-layout>
