@extends('backend.customer.layouts.master')

@section('title', 'My Orders')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('link', 'My Orders')

@section('content')
    <div class="content-container">
        <div class="outer-container">

            <div class="doctors-appointment">
                <div class="title-box inquiry">
                    <h3>My Orders</h3>
                </div>
                <div class="doctors-list">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped  dt-responsive nowrap dataTable no-footer" id="orders"
                                style="width:100%">
                                <thead class="table-header">
                                    <tr>
                                        <th>Id</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th class="text-center">Mark as Received</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($myOrders as $key => $myOrder)
                                        <tr id="myOrder-record-{{ $myOrder->id }}">
                                            <td>
                                                {{ $myOrder->id }}
                                            </td>
                                            <td>
                                                LKR {{ $myOrder->amount }}
                                            </td>
                                            <td>
                                                @if ($myOrder->payment_method == 'online')
                                                    Online Payment
                                                @elseif ($myOrder->payment_method == 'bank_receipt')
                                                    Bank Transfer
                                                @elseif ($myOrder->payment_method == 'cod')
                                                    Cash On Delivery
                                                @endif
                                            </td>
                                            <td>
                                                {{ $myOrder->created_at->format('M d, Y h:i A') }}
                                            </td>
                                            <td class="inquiry-status">
                                                @if ($myOrder->payment_method == 'bank_receipt' || $myOrder->payment_method == 'cod')
                                                    @if ($myOrder->status == App\Enums\OrderStatusEnum::approved->value)
                                                        <span class="badge badge-success p-2">Success</span>
                                                    @elseif ($myOrder->status == App\Enums\OrderStatusEnum::rejected->value)
                                                        <span class="badge badge-danger p-2">Cancelled</span>
                                                    @else
                                                        <span class="badge badge-info p-2">Pending</span>
                                                    @endif
                                                @elseif ($myOrder->payment_method == 'online')
                                                    @if ($myOrder->status == App\Enums\OrderStatusEnum::approved->value)
                                                        <span class="badge badge-success p-2">Success</span>
                                                    @elseif ($myOrder->status == App\Enums\OrderStatusEnum::rejected->value)
                                                        <span class="badge badge-danger p-2">Cancelled</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @can('orderDetails', $myOrder)
                                                    @if ($myOrder->status == App\Enums\OrderStatusEnum::approved->value)
                                                        @if (!$myOrder->received_at)
                                                            <a class="btn btn-sm btn-order btn-primary"
                                                                data-order="{{ $myOrder->id }}" id="order-{{ $myOrder->id }}"
                                                                href="javascript:void(0)">
                                                                Mark Received
                                                            </a>
                                                        @else
                                                            <span class="badge badge-secondary p-2">
                                                                Received on
                                                                {{ \Carbon\Carbon::parse($myOrder->received_at)->format('M d, Y h:i A') }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        This order is not approved.
                                                    @endif
                                                @endcan
                                            </td>
                                            <td class="inquiry-status">
                                                @can('orderDetails', $myOrder)
                                                    <a
                                                        href="{{ URL::signedRoute('customer.orderDetails', ['order' => $myOrder]) }}"><span
                                                            class="btn-pill btn btn-sm btn-outline-success"><i
                                                                class="fas fa-eye mr-2"></i>View</span></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
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
    <script src="{{ asset('js/customer/orders/order.js') }}"></script>

@endsection
