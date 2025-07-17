<div class="select-field bg-color-3">

        <div class="content-box">
            <div class="form-inner clearfix">
                <div class="animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"><i class="fas fa-shopping-cart"></i></div>
                                <div class="basket-item-count"><span class="count" id="cart-count">
                                        {{ $cartCount }}
                                    </span></div>
                                <div class="total-price-basket">
                                 
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li id="cart-summery">
                                @if ($cartCount > 0)
                                    @foreach ($cartItems as $index => $item)
                                        <div class="cart-item product-summary">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="image">
                                                        <a href="#"><img src="{{ $item['product_image'] }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3 class="name text-truncate">
                                                        <a href="#">{{ $item['product_name'] }}</a>
                                                    </h3>
                                                    <div class="price text-nowrap">Rs: {{ $item['discount_price'] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 action">
                                                    <a href="#" wire:click="removeItem({{ $index }})"
                                                        class="remove_item">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                    @endforeach
                                @else
                                    <div class="cart-item product-summary">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="cart-empty text-center">
                                                    <div class="cart-empty-text">There are no items in this cart</div>
                                                    <a href="{{ route('public.product')}}" type="button" class="cart-empty-button">CONTINUE
                                                        SHOPPING</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                @endif

                                <!-- Cart total -->
                                <div class="clearfix cart-total">
                                    <div class="pull-right">
                                        <span class="text">Total:</span>
                                        <span class="price">Rs: {{ $cartTotal }}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('product.cart') }}"
                                        class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a>
                                    {{-- <a href="{{ route('product.checkout') }}"
                                        class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> --}}
                                </div>
                            </li>
                        </ul>

                    </div>
                    <!-- /.dropdown-cart -->
                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
            </div>
        </div>
    
</div>
