@extends('backend.layouts.master')
@section('title', 'Orders')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

@endsection
@section('breadcrumb-title', 'My Orders')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
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
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="orders"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Customer Name</th>
                                        <th>Created At </th>
                                        <th>Subtotal </th>
                                        <th style="max-width: 400px;" class="text-center">Status</th>
                                        <th class="text-center">Mark as Received</th>
                                        <th style="max-width: 400px;" class="text-center">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr id="order-record-{{ $order->id }}">
                                            <td>
                                                {{ $order->id }}
                                            </td>
                                            <td class="font-weight-bold">{{ $order->name }}</td>
                                            <td>
                                                {{ $order->created_at->format('M d, Y h:i A') }}
                                            </td>
                                            <td>
                                                LKR {{ $order->amount }}
                                            </td>
                                            <td style="max-width: 400px;" class="text-center">
                                                @if ($order->status == App\Utils\Enums::order['PENDING'])
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif ($order->status == App\Utils\Enums::order['APPROVED'])
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @can('orderDetails', $order)
                                                    @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                                        @if (!$order->received_at)
                                                            <a class="btn btn-sm btn-order btn-primary"
                                                                data-order="{{ $order->id }}"
                                                                id="order-{{ $order->id }}" href="javascript:void(0)">
                                                                Mark Received
                                                            </a>
                                                        @else
                                                            <span class="badge badge-secondary p-2">
                                                                Received on
                                                                {{ \Carbon\Carbon::parse($order->received_at)->format('M d, Y h:i A') }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        This order is not approved.
                                                    @endif
                                                @endcan
                                            </td>
                                            <td style="max-width: 400px;" class="text-center">
                                                @can('orderDetails', $order)
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ URL::signedRoute('service-provider.orderDetails', $order) }}"
                                                        data-bs-original-title="" title="View More Order Details">
                                                        <i class="fa fa-caret-square-o-right"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Customer Name</th>
                                        <th>Created At </th>
                                        <th>Subtotal </th>
                                        <th style="max-width: 400px;" class="text-center">Status</th>
                                        <th class="text-center">Mark as Received</th>
                                        <th style="max-width: 400px;" class="text-center">View Details</th>
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
    <script src="{{ asset('js/member/orders/order.js') }}"></script>
@endsection
