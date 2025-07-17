<div class="row clearfix">

    <div class="col-lg-8 col-md-12 col-sm-12 left-column">
        <div class=" doctor-details-content">
            <div class="clinic-block-one">
                <div class="inner-box">

                    @foreach ($buyItems as $index => $item)
                        <figure class="image-box checkout-image mt-2"><img src="{{ $item['product_image'] }}"
                                alt="">
                        </figure>
                        <div class="content-box">
                            <ul class="name-box clearfix">
                                <li class="name">
                                    <h2>{{ $item['product_name'] }}</h2>
                                </li>

                            </ul>

                            @php
                                $variation = App\Models\ProductVariation::find($item['variation']);

                            @endphp
                            <span class="designation">{{ $variation->name }}</span>


                            <div class="lower-box clearfix">
                                <ul class="info clearfix">
                                    <li><span class="font-weight-bold">Qty :</span> {{ $item['quantity'] }}</li>
                                    <li><span class="font-weight-bold">Price :</span> LKR {{ $item['discount_price'] }}
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="appointment-information">
            <div class="title-box">
                <h3>Order Information</h3>
            </div>
            <div class="inner-box">

                <div class="information-form">
                    <h3>Your Information:</h3>
                    <form wire:submit.prevent="saveOrder">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label>Your name</label>
                                <input wire:model.lazy="order.name" type="text" name="name"
                                    placeholder="Enter your name">
                                @error('order.name')
                                    <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                                aria-hidden="true"></i>{{ $message }}</span></strong>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label>Your email</label>
                                <input wire:model.lazy="order.email" type="email" name="email"
                                    placeholder="Enter your email">
                                @error('order.email')
                                    <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                                aria-hidden="true"></i>{{ $message }}</span></strong>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label>Address</label>
                                <input wire:model.lazy="order.address" type="text" name="address"
                                    placeholder="Address">
                                @error('order.address')
                                    <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                                aria-hidden="true"></i>{{ $message }}</span></strong>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <label>Mobile number</label>
                                <div wire:ignore>
                                    <input wire:model.lazy="order.number" type="text" name="address"
                                        placeholder="Mobile number" id="phone">
                                </div>
                                @error('order.number')
                                    <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                                aria-hidden="true"></i>{{ $message }}</span></strong>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <label>District</label>
                                <select wire:model.lazy="order.district_id" class="form-control select-option">
                                    <option data-display="Select District">Select District</option>
                                    @foreach ($listForFields['district'] as $districts)
                                        <option value="{{ $districts['id'] }}">{{ $districts['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('order.district_id')
                                    <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                                aria-hidden="true"></i>{{ $message }}</span></strong>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <label>City</label>
                                <select wire:model.lazy="order.city_id" class="form-control select-option">
                                    <option data-display="Select City">Select City</option>
                                    @foreach ($listForFields['city'] as $cities)
                                        <option value="{{ $cities['id'] }}">{{ $cities['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('order.city_id')
                                    <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                                aria-hidden="true"></i>{{ $message }}</span></strong>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 form-group member-type">
                                <label>Select Payment Method</label>
                                <div class="row">
                                 
                                    <label class="col-md-6"><input wire:model.lazy="order.payment_method" type="radio"
                                            name="bank_receipt" value="bank_receipt"><span> Bank Receipt</span></label>
                                    <label class="col-md-6"><input wire:model.lazy="order.payment_method" type="radio"
                                            name="cod" value="cod"><span> Cash On Delivery</span></label>
                                </div>
                                @error('order.payment_method')
                                    <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                                aria-hidden="true"></i>{{ $message }}</span></strong>
                                @enderror
                            </div>
                            @if ($order->payment_method === 'bank_receipt')
                                <div class="div-with-border">
                                    <div class="col-md-12 mt-3 form-group">
                                        <label for="bankReceiptFile" class="form-label">Bank Receipt File</label>
                                        <div class="custom-file">
                                            <input wire:model="bankReceiptFile" type="file"
                                                accept="image/*,application/pdf" class="custom-file-input"
                                                id="bankReceiptFile">
                                            <label class="custom-file-label" for="bankReceiptFile">Choose file</label>
                                        </div>
                                        @error('bankReceiptFile')
                                            <strong><span class="text-danger mt-2"><i
                                                        class="fa fa-exclamation-circle mr-1"
                                                        aria-hidden="true"></i>{{ $message }}</span></strong>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3 form-group">
                                        <label for="bankReceiptDescription" class="form-label">Bank Receipt
                                            Description</label>
                                        <textarea wire:model="order.bank_receipt_description" id="bankReceiptDescription" class="form-control"
                                            rows="3" placeholder="Bank Receipt Description"></textarea>
                                        @error('order.bank_receipt_description')
                                            <strong><span class="text-danger mt-2"><i
                                                        class="fa fa-exclamation-circle mr-1"
                                                        aria-hidden="true"></i>{{ $message }}</span></strong>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <div class="btn-box">
                                    <button type="submit" class="theme-btn-one">Confirm and Pay<i
                                            class="icon-Arrow-Right"></i></button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 right-column">
        <div class="booking-information">
            <div class="title-box">
                <h3>Order Summary</h3>
            </div>
            <div class="inner-box">
                @foreach ($buyItems as $index => $item)
                    <div class="single-box">
                        <ul class="clearfix">
                            <li class="mb-3">
                                <div class="row">
                                    <span class="col-md-7 col-6">{{ $item['product_name'] }}</span>
                                    <span class="col-md-5 col-6 checkout-product-price">LKR
                                        {{ $item['discount_price'] }}</span>
                                </div>
                            </li>

                        </ul>
                    </div>
                @endforeach
                <div class="total-box mb-3">
                    <h5>Total<span>LKR {{ $subTotal }}</span></h5>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <script src="{{ asset('assets/backend/js/jquery-3.6/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/notify/bootstrap-notify.min.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <script>
            $.notify({
                icon: 'glyphicon glyphicon-alert',
                message: '{{ Session::get('success') }}'
            }, {
                type: 'success',
                allow_dismiss: true,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                delay: 50000000,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'Error',
                title: 'Error!',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
</div>
@push('scripts')
    <script src="{{ asset('assets/frontend/js/intlTelInput.min.js') }}"></script>
    <script>
        const input = document.querySelector("#phone");

        const iti = window.intlTelInput(input, {
            utilsScript: "{{ asset('assets/frontend/js/build/utils.js') }}",
            initialCountry: "LK",
            separateDialCode: true,
        });
        input.addEventListener('change', function() {
            @this.set('order.number', iti.getNumber());
        });
    </script>
@endpush
