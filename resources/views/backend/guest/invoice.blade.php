<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>healthcare.lk | Invoice </title>
    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link href="{{ asset('assets/backend/css/customer/invoice.css') }}" rel="stylesheet">
    @include('backend.customer.layouts.styles')

</head>

<body class="cnt-home" x-data="{ overflow_y: true }" :class="[!overflow_y ? 'overflow-hidden' : '']">

    <div class="boxed_wrapper">

        <!-- preloader -->
        <div class="preloader"></div>
        <!-- preloader -->

        <!-- Page Heading -->
        @include('backend.customer.layouts.header')

        <!--page-title-two-->
        <section class="page-title-two">

        </section>
        <!--page-title-two end-->

        <!-- patient-dashboard -->
        <section class="patient-dashboard bg-color-3">

            <div class="right-panel">
                <div class="content-container">
                    <div class="outer-container">
                        <div class="doctors-appointment">
                            <div class="doctors-list">

                                <section class="" style="background-color: #ffffff;">
                                    <div class="container py-3">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="border border-secondary rounded mb-2">
                                                    <div class="card-body">
                                                        <div class="thank-you-heading">
                                                            <h1 class="thank-you">
                                                                <div class="thank-you-icon pt-0">
                                                                    <img class="thank-you-img"
                                                                        src="{{ asset('img/logo3.png') }}"
                                                                        alt="" width="250">
                                                                </div>

                                                            </h1>
                                                        </div>
                                                        <div class="thank-you-secondary-container">
                                                            <div class="thank-you-secondary-heading"
                                                                data-spm="order_detail">
                                                                <div class="thank-you-order-number-container">
                                                                    <span>Invoice number is </span>
                                                                    <span
                                                                        class="thank-you-order-number">#{{ str_pad($invoice->id, 6, 0, STR_PAD_LEFT) }}</span>
                                                                </div>
                                                                <a id="automation-link-track-order"
                                                                    class="automation-link thank-you-track-order-link"></a>
                                                            </div>
                                                        </div>

                                                        <div class="payment-amount wrapper">
                                                            <div class="payment-amount container">
                                                                <div class="payment-amount title">Your Amount</div>
                                                                <div class="payment-amount amount">LKR
                                                                    {{ number_format($invoice->amount, 2) }}</div>
                                                            </div>
                                                        </div>

                                                        <div class="package-delivery mt-3">
                                                            <span>Issue Date :</span>
                                                            {{ $invoice->created_at->format('M d, Y') }}
                                                        </div>

                                                        <div class="payment-information wrapper">
                                                            <div class="payment-information box">
                                                                <div class="payment-information item">
                                                                    <span
                                                                        class="lazada lazada-icon payment-information icon">
                                                                        <i class="fas fa-envelope email-icon"></i>
                                                                    </span>
                                                                    <div class="payment-information content">
                                                                        <div class="payment-information text-content">
                                                                            <div class="payment-information text-line">
                                                                                <span>We’ve sent a confirmation email to
                                                                                </span>
                                                                                <span
                                                                                    class="payment-information strong-text">{{ $invoice->inquiry->email }}.</span>
                                                                                {{-- <span> with the order details.</span> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="package-delivery">
                                                            <div class="invoice-details">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <span>Inquiry ID :</span><span
                                                                            class="thank-you-order-number">#{{ str_pad($invoice->inquiry->id, 6, 0, STR_PAD_LEFT) }}</span>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <span>Date of issue of the enquire :</span>
                                                                        {{ $invoice->inquiry->created_at->format('M d, Y') }}
                                                                    </div>
                                                                    <div class="col-md-12 mt-1">
                                                                        <span>Type of Inquiry :</span>
                                                                        {{ $invoice->inquiry->serviceCategory->name }}
                                                                    </div>
                                                                    <div class="col-md-12 mt-1"> <span>Name :</span>
                                                                        {{ $invoice->inquiry->name }}
                                                                    </div>
                                                                    <div class="col-md-12 mt-1"> <span>Email :</span>
                                                                        {{ $invoice->inquiry->email }}
                                                                    </div>
                                                                    <div class="col-md-12 mt-1"> <span>Mobile Number
                                                                            :</span>
                                                                        {{ $invoice->inquiry->phone }}
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="package-delivery">
                                                            <div class="button-container row">
                                                                <div class="col-md-6">

                                                                    <a href="javascript:void(0)" id="onlinePayButton"
                                                                        data-id="{{ $invoice->id }}"
                                                                        class="pay-now online-pay mt-3 disabled {{ $invoice->paid == 1 ? 'disabled' : '' }}">
                                                                        <span>Online Paymnet</span>
                                                                        <svg width="34" height="34"
                                                                            viewBox="0 0 74 74" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <circle cx="37" cy="37"
                                                                                r="35.5" stroke="black"
                                                                                stroke-width="3"></circle>
                                                                            <path
                                                                                d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z"
                                                                                fill="black"></path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)"
                                                                        data-id="{{ $invoice->id }}"
                                                                        class="pay-now bank-transfer mt-3 {{ $invoice->paid == 1 ? 'disabled' : '' }}">
                                                                        <span>Bank Transfer</span>
                                                                        <svg width="34" height="34"
                                                                            viewBox="0 0 74 74" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <circle cx="37" cy="37"
                                                                                r="35.5" stroke="black"
                                                                                stroke-width="3"></circle>
                                                                            <path
                                                                                d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z"
                                                                                fill="black"></path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if ($invoice->payment_type == 'bank_transfer')
                                                            @if ($invoice->rejected_at)
                                                                <div class="package-delivery mt-3">
                                                                    <div class="invoice-details">
                                                                        <h4
                                                                            class="text-center text-danger font-weight-bold">
                                                                            Payment
                                                                            Failed!</h4>
                                                                    </div>
                                                                </div>
                                                            @elseif ($invoice->paid == App\Enums\OrderStatusEnum::approved->value && $invoice->rejected_at == null)
                                                                <div class="package-delivery mt-3">
                                                                    <div class="invoice-details">
                                                                        <h4
                                                                            class="text-center text-success font-weight-bold">
                                                                            Payment
                                                                            Successfully!</h4>
                                                                    </div>
                                                                </div>
                                                            @elseif ($invoice->paid == App\Enums\OrderStatusEnum::pending->value)
                                                                <div class="package-delivery mt-3">
                                                                    <div class="invoice-details">
                                                                        <h4
                                                                            class="text-center text-daek font-weight-bold">
                                                                            Your Payment
                                                                            Pending!</h4>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @elseif ($invoice->payment_type == 'online')
                                                            @if ($invoice->paid == App\Enums\OrderStatusEnum::approved->value)
                                                                <div class="package-delivery mt-3">
                                                                    <div class="invoice-details">
                                                                        <h4
                                                                            class="text-center text-success font-weight-bold">
                                                                            Payment
                                                                            Successfully!</h4>
                                                                    </div>
                                                                </div>
                                                            @elseif ($paymentResponse->status == App\Enums\OrderStatusEnum::rejected->value)
                                                                <div class="package-delivery mt-3">
                                                                    <div class="invoice-details">
                                                                        <h4
                                                                            class="text-center text-danger font-weight-bold">
                                                                            Payment
                                                                            Failed!</h4>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        @endif
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal" id="bankTransferModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Bank Transfer Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-text">Please upload your bank receipt:</p>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/*,application/pdf"
                                        name="receipt" id="receipt">
                                    <label class="custom-file-label" for="receipt">Choose file</label>
                                </div>
                                <div class="form-group mt-3">
                                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Comment"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary bank-transfer-confirm">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" id="onlinePayment" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Online Payment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <x-pay-here-checkout-form :payable="$payment"
                                    success-url="{{ route('customer.invoiceOnlinePayment.success') }}"
                                    cancelled-url="{{ route('customer.invoiceOnlinePayment.cancelled') }}"
                                    form-class="bg-white rounded w-full shadow-sm px-6 pt-2">
                                    <input type="hidden" name="items" value="{{ $invoice->inquiry->name }}">

                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                            <label class="col-lg-12 col-md-6 col-sm-12"><strong>Your name
                                                    :</strong></label>
                                            <input class="from-control col-lg-12 col-md-6 col-sm-12" type="text"
                                                name="first_name" value="{{ $invoice->inquiry->name }}" readonly>
                                        </div>
                                        <input type="hidden" name="last_name"
                                            value="{{ $invoice->inquiry->name }}">
                                        <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                            <label class="col-lg-12 col-md-6 col-sm-12"><strong>Your Email
                                                    :</strong></label>
                                            <input class="from-control col-lg-12 col-md-6 col-sm-12" type="text"
                                                name="email" value="{{ $invoice->inquiry->email }}" readonly>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                            <label class="col-lg-12 col-md-6 col-sm-12"><strong>Your Mobile
                                                    Number:</strong></label>
                                            <input class="from-control col-lg-12 col-md-6 col-sm-12" type="text"
                                                name="phone" value="{{ $invoice->inquiry->phone }}" readonly>
                                        </div>
                                        <input class="hidden" type="text" name="address" value="Colombo">
                                        <input class="hidden" type="text" name="city" value="Colombo">
                                        <input type="hidden" name="country" value="Sri Lanka">

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit"
                                                class="btn btn-primary online-payment-confirm">Confirm</button>
                                        </div>
                                </x-pay-here-checkout-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- patient-dashboard -->


        <!-- Page footer -->
        @include('backend.customer.layouts.footer')

        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fa fa-arrow-up"></span>
        </button>


    </div>
    @include('backend.customer.layouts.scripts')
    <script src="{{ asset('js/guest/invoice.js') }}"></script>
</body>

</html>
