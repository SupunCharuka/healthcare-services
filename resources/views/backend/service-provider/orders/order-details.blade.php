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
    <li class="breadcrumb-item"><a href="{{ route('service-provider.orders') }}">Orders</a></li>
    <li class="breadcrumb-item active">Manage Orders</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>My Order Detail</h5>
                    </div>
                    <hr>
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
                                    @elseif ($order->payment_method == 'bank_receipt')
                                        <span><strong>Bank Receipt</strong></span>
                                    @elseif ($order->payment_method == 'cod')
                                        <span><strong>Cash On Delivery</strong></span>
                                    @endif
                                </div>
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
                                <hr>
                            </div>
                        </div>
                        <h5><strong>Order Details :</strong></h5>
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
                                    @foreach ($order->orderItems as $index => $item)
                                        @php
                                            $productImages = App\Models\ProductImage::where('product_id', $item->product_id)->get();
                                            
                                        @endphp
                                        <tr id="item-record-{{ $item->id }}">
                                            <td>
                                                <img src="{{ storage('uploads/admin/product-images/thumb/' . $productImages->first()->images) }}"
                                                    alt="Avatar" class="rounded-circle" style="width: 50px;" />
                                            </td>
                                            <td><a
                                                    href="{{ route('view.product', ['product' => $item->product]) }}">{{ $item->product->name }}</a>
                                            </td>
                                            <td>{{ $item->productVariation->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>LKR {{ $item->price }}</td>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/member/orders/order-details.js') }}"></script>
@endsection
