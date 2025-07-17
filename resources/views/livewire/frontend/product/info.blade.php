<div>
    @if (session()->has('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif

    <h1 class="name">{{ $product->name }}</h1>
    <!-- /.price-container -->
    <div class="price-container info-container m-t-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="price-box">

                    <span class="price"> LKR {{ $discount_price }} </span>
                    @if ($prices->discount > 0)
                        <span class="price-strike">LKR {{ $prices->price }}</span>
                        <span class="product-discount">-{{ $prices->discount }}%</span>
                    @endif

                </div>
            </div>
        </div><!-- /.row -->
    </div>

    <div class="stock-container info-container m-t-10">
        <div class="row">
            <div class="col-md-2 col-4">
                <div class="stock-box">
                    <span class="label">Availability:</span>
                </div>
            </div>
            <div class="col-md-10 col-8">
                <div class="stock-box">
                    @if ($prices->quantity > 0)
                        <span class="value-in-stock">In Stock</span>
                    @else
                        <span class="value-out-of-stock">Out of Stock</span>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="row no-gutters mt-3">
        <div class="variations-container">
            <label class="variation-label">Variations:</label>
            @foreach ($product->productVariations as $index => $variation)
                <div class="variation-options">
                    <label class="variation-option">
                        <input type="radio" wire:model="selectedVariation"value="{{ $variation->id }}"  {{ $index === 0 ? 'checked' : '' }}>
                        <span>{{ $variation->name }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- /.quantity-container -->
    <div class="quantity-container info-container">
        <form wire:submit.prevent="submitForm">
            <div class="row">

                <div class="col-md-2 col-sm-3 col-3">
                    <div class="float-left">
                        <span class="label">Qty :</span>
                    </div>
                </div>
                <div class="col-md-10 col-sm-9 col-9">
                    <div class="cart-quantity float-left">
                        <label class="quant-input">
                            <input type="number" name="quantity" id="quantity" wire:model="quantity" min="1"
                                max="{{ $prices->quantity }}" />
                            <input type="hidden" name="stock_id" value="{{ $selectedVariation }}" />
                            <input type="hidden" name="product_id" wire:model="product_id" />
                            <input type="hidden" name="discount_price" wire:model="discount_price" />


                        </label>
                    </div>
                </div>

                <div class="col-sm-12 product-btn-buy">
                    <button type="submit" wire:click="submitForm('buy_now')" class="btn btn-buy"
                        {{ $prices->quantity == 0 ? 'disabled' : '' }}>
                        BUY NOW
                    </button>
                    <button type="submit" wire:click="submitForm('add_to_cart')"
                        class="btn update_qty  btn-add-to-cart" {{ $prices->quantity == 0 ? 'disabled' : '' }}>
                        ADD TO CART
                    </button>

                </div>

            </div>
        </form>
    </div>
</div>
