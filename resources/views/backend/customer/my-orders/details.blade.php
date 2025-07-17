@extends('backend.customer.layouts.master')

@section('title', 'My Order Deatails')
@section('styles')

@endsection
@section('link', 'My Order Deatails')

@section('content')
    <div class="content-container">
        <div class="outer-container">
            <section class="appointment-section bg-color-3 pt-0">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 left-column">
                            <div class=" doctor-details-content">
                                <div class="clinic-block-one">
                                    <div class="inner-box">

                                        @foreach ($order->orderItems as $index => $item)
                                            <figure class="image-box checkout-image mt-2"><img
                                                    src="{{ storage('uploads/admin/product-images/thumb/' . $item->product->productImages->first()->images) }}"
                                                    alt="">
                                            </figure>
                                            <div class="content-box">
                                                <ul class="name-box clearfix">
                                                    <li class="name">
                                                        <h2><a
                                                                href="{{ route('view.product', ['product' => $item->product]) }}">{{ $item->product->name }}</a>
                                                        </h2>
                                                    </li>

                                                </ul>
                                                <span class="designation">{{ $item->productVariation->name }}</span>


                                                <div class="lower-box clearfix">
                                                    <ul class="info clearfix">
                                                        <li><span class="font-weight-bold">Qty :</span> {{ $item->qty }}
                                                        </li>
                                                        <li><span class="font-weight-bold">Price :</span> LKR
                                                            {{ $item->price }}
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                        <div>
                                            <span>
                                                <h5><strong>Subtotal :</strong> LKR {{ $order->amount }}</h5>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="appointment-information">
                                <div class="title-box">
                                    <h3>Order Information</h3>
                                </div>
                                <div class="inner-box">
                                    <div class="inquiry-status">
                                        <label><strong>Order Status :</strong></label>
                                        @if ($order->payment_method == 'bank_receipt' || $order->payment_method == 'cod')
                                            @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                                <span class="badge badge-success p-1">Success</span>
                                            @elseif ($order->status == App\Enums\OrderStatusEnum::rejected->value)
                                                <span class="badge badge-danger p-1">Rejected</span>
                                            @else
                                                <span class="badge badge-info p-1">Pending</span>
                                            @endif
                                        @elseif ($order->payment_method == 'online')
                                            @if ($order->status == App\Enums\OrderStatusEnum::approved->value)
                                                <span class="badge badge-success">Success</span>
                                            @elseif ($order->status == App\Enums\OrderStatusEnum::rejected->value)
                                                <span class="badge badge-danger">Failed</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="inquiry-status">
                                        <label><strong>Order Places Date :</strong>
                                            {{ $order->created_at->format('M d, Y h:i A') }}</label>

                                    </div>

                                    <div class="information-form">
                                        <h3>My Information:</h3>

                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label>Name</label>
                                                <span><strong>{{ $order->name }}</strong></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label>Email</label>
                                                <span><strong>{{ $order->email }}</strong></span>

                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label>Address</label>
                                                <span><strong>{{ $order->address }}</strong></span>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                <label>Mobile number</label>
                                                <span><strong>{{ $order->number }}</strong></span>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                <label>District</label>
                                                <span><strong>{{ $order->district->name }}</strong></span>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                <label>City</label>
                                                <span><strong>{{ $order->city->name }}</strong></span>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="information-form">
                                        <h3>Payment Details:</h3>

                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label>Payment Type</label>
                                                @if ($order->payment_method == 'online')
                                                    <span><strong>Online Payment</strong></span>
                                                @elseif ($order->payment_method == 'bank_receipt')
                                                    <span><strong>Bank Receipt</strong></span>
                                                @elseif ($order->payment_method == 'cod')
                                                    <span><strong>Cash On Delivery</strong></span>
                                                @endif

                                            </div>
                                            @if ($order->payment_method == 'bank_receipt')
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                    <label>Bank Recipet</label>
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
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                    <label>Bank Recipet Description</label>
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
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
