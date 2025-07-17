@extends('backend.layouts.master')
@section('title', 'Orders')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

@endsection
@section('breadcrumb-title', 'Manage Orders')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Orders</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Manage Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="status-filter">
                                <label for="status">Filter by Status:</label>
                                <select id="statusFilter">
                                    <option value="all">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="success">Success</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="orders"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Payment Method</th>
                                        <th>Created At </th>
                                        <th>Subtotal </th>
                                        <th style="max-width: 400px;" class="text-center">Status</th>
                                        <th class="text-center">Mark as Received</th>
                                        <th style="max-width: 400px;" class="text-center">View Details</th>
                                        <th style="max-width: 400px;" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr id="order-record-{{ $order->id }}">
                                            <td>
                                                {{ $order->id }}
                                            </td>
                                            <td class="font-weight-bold">{{ $order->name }}</td>
                                            <td class="font-weight-bold">
                                                @if ($order->payment_method == 'online')
                                                    Online Payment
                                                @elseif ($order->payment_method == 'bank_receipt')
                                                    Bank Transfer
                                                @elseif ($order->payment_method == 'cod')
                                                    Cash On Delivery
                                                @endif
                                            </td>
                                            <td>
                                                {{ $order->created_at->format('M d, Y h:i A') }}
                                            </td>
                                            <td>
                                                LKR {{ $order->amount }}
                                            </td>
                                            <td style="max-width: 400px;" class="text-center">
                                                @if ($order->payment_method == 'bank_receipt' || $order->payment_method == 'cod')
                                                    @if ($order->status == App\Enums\OrderStatusEnum::pending->value)
                                                        <span class="badge badge-info">Pending</span>
                                                    @elseif ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                                        <span class="badge badge-success">Success</span>
                                                    @else
                                                        <span class="badge badge-danger">Failed</span>
                                                    @endif
                                                @elseif ($order->payment_method == 'online')
                                                    @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                                        <span class="badge badge-success">Success</span>
                                                    @elseif ($order->status == App\Enums\OrderStatusEnum::rejected->value)
                                                        <span class="badge badge-danger">Failed</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                                    @if (!$order->received_at)
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-order btn-primary"
                                                            data-order="{{ $order->id }}">
                                                            Mark Received
                                                        </a>
                                                    @else
                                                        <span class="badge badge-secondary p-2">
                                                            Received on
                                                            {{ \Carbon\Carbon::parse($order->received_at)->format('M d, Y h:i A') }}
                                                        </span>
                                                    @endif
                                                @else
                                                    <p>This order is not approved.</p>
                                                @endif
                                            </td>
                                            <td style="max-width: 400px;" class="text-center">
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('admin.orderDetails', $order->id) }}"
                                                    data-bs-original-title="" title="View More Order Details">
                                                    <i class="fa fa-caret-square-o-right"></i>
                                                </a>
                                            </td>
                                            <td style="max-width: 400px;" class="text-center">
                                                @if ($order->payment_method == 'bank_receipt' || $order->payment_method == 'cod')
                                                    @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                                        <span class="badge approve-btn p-2 f-14 m-1">
                                                            <i class="fa fa-check fa-lg"></i>
                                                            Approved
                                                        </span>
                                                        @if ($order->received_at == null)
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#dataTableModal"
                                                                data-id={{ $order->id }}
                                                                data-userid="{{ $order->user_id }}"data-original-title="Reject"
                                                                class="reject p-2 badge badge-danger rounded-pill"
                                                                style="width:120px">
                                                                <i class="fa fa-ban fa-lg"></i><span
                                                                    class="f-14 m-1">Reject</span></a>
                                                        @endif
                                                    @elseif ($order->status == App\Enums\OrderStatusEnum::rejected->value)
                                                        <span class="badge reject-btn  p-2 f-14 m-2">
                                                            <i class="fa fa-ban fa-lg"></i>Rejected
                                                        </span>
                                                        <a href="javascript:void(0)" data-id="{{ $order->id }}"
                                                            data-userid="{{ $order->user_id }}"
                                                            data-original-title="Approve"
                                                            class="approve p-2 badge badge-success rounded-pill"
                                                            style="width:120px">
                                                            <i class="fa fa-check fa-lg"></i><span
                                                                class="f-14 m-1">Approve</span></a>
                                                    @else
                                                        <a href="javascript:void(0)" data-id="{{ $order->id }}"
                                                            data-userid="{{ $order->user_id }}"
                                                            data-original-title="Approve"
                                                            class="approve p-2 badge badge-success rounded-pill"
                                                            style="width:120px">
                                                            <i class="fa fa-check fa-lg"></i><span
                                                                class="f-14 m-1">Approve</span></a>


                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#dataTableModal" data-id={{ $order->id }}
                                                            data-userid="{{ $order->user_id }}"data-original-title="Reject"
                                                            class="reject p-2 badge badge-danger rounded-pill"
                                                            style="width:120px">
                                                            <i class="fa fa-ban fa-lg"></i><span
                                                                class="f-14 m-1">Reject</span></a>
                                                    @endif
                                                @elseif ($order->payment_method == 'online')
                                                    @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                                        <span class="badge approve-btn p-2 f-14 m-1">
                                                            <i class="fa fa-check fa-lg"></i>
                                                            Success
                                                        </span>
                                                    @elseif ($order->status == App\Enums\OrderStatusEnum::rejected->value)
                                                        <span class="badge reject-btn  p-2 f-14 m-2">
                                                            <i class="fa fa-ban fa-lg"></i>Failed
                                                        </span>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Payment Method</th>
                                        <th>Created At </th>
                                        <th>Subtotal </th>
                                        <th style="max-width: 400px;" class="text-center">Status</th>
                                        <th class="text-center">Mark as Received</th>
                                        <th style="max-width: 400px;" class="text-center">View Details</th>
                                        <th style="max-width: 400px;" class="text-center">Actions</th>
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
    <script src="{{ asset('js/admin/orders/order.js') }}"></script>
@endsection
