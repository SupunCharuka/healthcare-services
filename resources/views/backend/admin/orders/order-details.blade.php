@extends('backend.layouts.master')
@section('title', 'Orders')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Manage Members')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders') }}">Orders</a></li>
    <li class="breadcrumb-item active">Manage Orders</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div>
                            <div class="row clearfix">
                                <label class="col-lg-6 col-md-6 col-sm-12 form-group"><strong>Order Places Date :</strong>
                                    {{ $order->created_at->format('M d, Y h:i A') }}</label>
                                <label class="col-lg-6 col-md-6 col-sm-12 form-group"><strong>Subtotal :</strong> LKR
                                    {{ $order->amount }}</label>
                                <hr>
                                <h5><strong>Information :</strong></h5>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>Name : </label>
                                    <span><strong>{{ $order->name }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>Email : </label>
                                    <span><strong>{{ $order->email }}</strong></span>

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Address : </label>
                                    <span><strong>{{ $order->address }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>Mobile number : </label>
                                    <span><strong>{{ $order->number }}</strong></span>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>District : </label>
                                    <span><strong>{{ $order->district->name }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>City : </label>
                                    <span><strong>{{ $order->city->name }}</strong></span>
                                </div>
                                <hr>
                                <h5><strong>Payment Details :</strong></h5>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Payment Type : </label>
                                    @if ($order->payment_method == 'online')
                                        <span><strong>Online Payment</strong></span>
                                    @elseif ($order->payment_method == 'bank_receipt')
                                        <span><strong>Bank Receipt</strong></span>
                                    @elseif ($order->payment_method == 'cod')
                                        <span><strong>Cash On Delivery</strong></span>
                                    @endif
                                    @if ($order->payment_method == 'bank_receipt' || $order->payment_method == 'cod')
                                        @if ($order->status == App\Enums\OrderStatusEnum::pending->value)
                                            <span class="badge badge-info">Pending</span>
                                        @elseif ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    @elseif ($order->payment_method == 'online')
                                        @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                            <span class="badge badge-success">Success</span>
                                        @elseif ($order->status == App\Enums\OrderStatusEnum::rejected->value)
                                            <span class="badge badge-danger">Failed</span>
                                        @endif
                                    @endif

                                </div>
                                @if ($order->payment_method == 'bank_receipt')
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Bank Recipet : </label>
                                        <br>

                                        @php
                                            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                            $explodeImage = explode('.', $order->bank_receipt);
                                            $extension = end($explodeImage);
                                        @endphp
                                        @if (in_array($extension, $imageExtensions, true))
                                            <img class="img-thumbnail mt-2"
                                                src="{{ asset('uploads/customer/order/bank-receipt/' . $order->bank_receipt) }}"
                                                alt="">
                                        @else
                                            <b>
                                                <a href="{{ asset('uploads/customer/order/bank-receipt/' . $order->bank_receipt) }}"
                                                    target="blank">
                                                    <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                                        alt="" />
                                                </a>
                                            </b>
                                        @endif

                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <label>Bank Recipet Description : </label>
                                        <span><strong>{{ $order->bank_receipt_description }}</strong></span>
                                    </div>
                                @endif
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>Transaction Date & Time : </label>
                                    <span><strong>{{ $order->updated_at->format('d/m/Y') }}</strong></span>
                                    <span><strong>{{ $order->updated_at->format('h:ia') }}</strong></span>
                                </div>

                            </div>
                        </div>
                        <h5><strong>Order Details :</strong></h5>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="order-details"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Variations</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($order->orderItems ?? [] as $index => $item)
                                        <tr id="item-record-{{ $item->id }}">
                                            <td>
                                                <img src="{{ storage('uploads/admin/product-images/thumb/' . $item->product->productImages->first()->images) }}"
                                                    alt="Avatar" class="rounded-circle" style="width: 50px;" />
                                            </td>
                                            <td><a
                                                    href="{{ route('view.product', ['product' => $item->product]) }}">{{ $item->product->name }}</a>
                                            </td>
                                            <td>{{ $item->productVariation->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>
                                                <form action="{{ route('update.product.price', ['orderItem' => $item->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="price" value="{{ $item->price }}" class="form-control" style="width: 100px;">
                                                    <button type="submit" class="btn btn-sm btn-primary mt-2 text-white">Update</button>
                                                </form>
                                            </td>
                                           

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Variations</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                      
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mt-2">
                            @if ($order->payment_method == 'bank_receipt' || $order->payment_method == 'cod')
                                @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                    <span class="badge approve-btn p-2 f-14 m-1">
                                        <i class="fa fa-check fa-lg"></i>
                                        Approved
                                    </span>
                                    @if ($order->received_at == null)
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#dataTableModal"
                                            data-id={{ $order->id }}
                                            data-userid="{{ $order->user_id }}"data-original-title="Reject"
                                            class="reject p-2 badge badge-danger rounded-pill" style="width:120px">
                                            <i class="fa fa-ban fa-lg"></i><span class="f-14 m-1">Reject</span></a>
                                    @endif
                                @elseif ($order->status == App\Enums\OrderStatusEnum::rejected->value)
                                    <span class="badge reject-btn  p-2 f-14 m-2">
                                        <i class="fa fa-ban fa-lg"></i>Rejected
                                    </span>
                                    <a href="javascript:void(0)" data-id="{{ $order->id }}"
                                        data-userid="{{ $order->user_id }}" data-original-title="Approve"
                                        class="approve p-2 badge badge-success rounded-pill" style="width:120px">
                                        <i class="fa fa-check fa-lg"></i><span class="f-14 m-1">Approve</span></a>
                                @else
                                    <a href="javascript:void(0)" data-id="{{ $order->id }}"
                                        data-userid="{{ $order->user_id }}" data-original-title="Approve"
                                        class="approve p-2 badge badge-success rounded-pill" style="width:120px">
                                        <i class="fa fa-check fa-lg"></i><span class="f-14 m-1">Approve</span></a>


                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#dataTableModal"
                                        data-id={{ $order->id }}
                                        data-userid="{{ $order->user_id }}"data-original-title="Reject"
                                        class="reject p-2 badge badge-danger rounded-pill" style="width:120px">
                                        <i class="fa fa-ban fa-lg"></i><span class="f-14 m-1">Reject</span></a>
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
    <script src="{{ asset('js/admin/orders/order-details.js') }}"></script>
@endsection
