@extends('backend.layouts.master')
@section('title', 'Payment Details')
@section('styles')

@endsection
@section('breadcrumb-title', 'Payment Details')
@section('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Payment Detail</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Payment Details</h5>
                    </div>
                    <div class="card-body">



                        <div class="payment-info">
                            <span class="font-weight-bold">Type Of Payment:</span>
                            <span class="font-weight-boldcol-md-6 ">
                                @if ($invoice->payment_type == 'online')
                                    Online Payment
                                @elseif ($invoice->payment_type == 'bank_transfer')
                                    Bank Transfer
                                @endif
                            </span>
                        </div>

                        <div class="payment-info">
                            <span class="font-weight-bold">Transaction Date & Time :</span>
                            <span class="font-weight-boldcol-md-6 ">
                                <span><strong>{{ $invoice->updated_at->format('d/m/Y') }}</strong></span>
                                <span><strong>{{ $invoice->updated_at->format('h:ia') }}</strong></span>
                            </span>
                        </div>

                        @if ($invoice->payment_type == 'bank_transfer')

                            <div class="file-info">
                                <span class="font-weight-bold">View File:</span>
                                @if (Str::endsWith($invoice->document, ['.jpg', '.jpeg', '.png', '.gif']))
                                    <!-- Display image -->
                                    <img src="{{ asset('uploads/customer/bank-transfer/file/' . $invoice->document) }}"
                                        alt="Image" width="400">
                                @else
                                    <a href="{{ asset('uploads/customer/bank-transfer/file/' . $invoice->document) }}"
                                        target="_blank">
                                        <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png" alt="PDF" />
                                    </a>
                                @endif
                            </div>

                            <div class="comment-info">
                                <span class="font-weight-bold">Comment:</span>
                                <span class="font-weight-bold">{{ $invoice->comment }}</span>
                            </div>
                        @endif


                        <div class="action-buttons">
                            @if ($invoice->payment_type == 'bank_transfer')
                                @if ($invoice->paid == App\Utils\Enums::invoicePaid['APPROVED'] && $invoice->rejected_at == null)
                                    <span class="badge approve-btn p-2 f-14 m-1">
                                        <i class="fa fa-check fa-lg"></i>
                                        Approved
                                    </span>

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#dataTableModal"
                                        data-id="{{ $invoice->id }}" data-original-title="Reject"
                                        class="reject p-2 badge badge-danger rounded-pill" style="width:120px">
                                        <i class="fa fa-ban fa-lg"></i><span class="f-14 m-1">Reject</span></a>
                                @elseif ($invoice->rejected_at != null)
                                    <a href="javascript:void(0)" data-id="{{ $invoice->id }}" data-original-title="Approve"
                                        class="approve p-2 badge badge-success rounded-pill" style="width:120px">
                                        <i class="fa fa-check fa-lg"></i><span class="f-14 m-1">Approve</span></a>

                                    <span class="badge reject-btn  p-2 f-14 m-2">
                                        <i class="fa fa-ban fa-lg"></i>Rejected
                                    </span>
                                @elseif ($invoice->paid == App\Utils\Enums::invoicePaid['PENDING'])
                                    <a href="javascript:void(0)" data-id="{{ $invoice->id }}" data-original-title="Approve"
                                        class="approve p-2 badge badge-success rounded-pill" style="width:120px">
                                        <i class="fa fa-check fa-lg"></i><span class="f-14 m-1">Approve</span></a>

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#dataTableModal"
                                        data-id="{{ $invoice->id }}" data-original-title="Reject"
                                        class="reject p-2 badge badge-danger rounded-pill" style="width:120px">
                                        <i class="fa fa-ban fa-lg"></i><span class="f-14 m-1">Reject</span></a>
                                @endif
                            @elseif ($invoice->payment_type == 'online')
                                @if ($invoice->paid ==App\Utils\Enums::invoicePaid['APPROVED'] && $invoice->rejected_at == null)
                                    <span class="badge approve-btn p-2 f-14 m-1">
                                        <i class="fa fa-check fa-lg"></i>
                                        Approved
                                    </span>
                                @elseif ($invoice->paid ==  App\Utils\Enums::invoicePaid['PENDING'] && $invoice->rejected_at)
                                    <span class="badge reject-btn  p-2 f-14 m-2">
                                        <i class="fa fa-ban fa-lg"></i>Rejected
                                    </span>
                                @endif

                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/admin/payment-details/payment.js') }}"></script>
@endsection
