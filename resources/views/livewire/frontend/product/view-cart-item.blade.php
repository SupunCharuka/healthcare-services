<div class="doctors-list">
    @if (count($cartItems) > 0)
        <div class="table-outer">
            <table class="doctors-table">
                <thead class="table-header">
                    <tr>
                        <th class="text-center">Remove</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($cartItems as $index => $item)
                        <tr>
                            <td class="text-center">
                                <button class="btn btn-danger btn-xs delete" wire:click="removeItem({{ $index }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                            <td>
                                <div class="name-box">
                                    <figure class="image"><img src="{{ $item['product_image'] }}"alt="">
                                    </figure>
                                </div>
                            </td>
                            <td>
                                <p>{{ $item['product_name'] }}</p>
                            </td>
                            <td>
                                <p><input type="number" name="quantity" id="quantity" min="1"
                                        max="{{ $item['max_quantity'] }}"
                                        wire:model="cartItems.{{ $index }}.quantity"
                                        wire:change="updateCartItem({{ $index }})" />
                                </p>
                            </td>
                            <td>
                                <p>LKR {{ $item['discount_price'] }}</p>
                            </td>

                            @php
                                $subtotal += $item['discount_price'];
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5">
                            <div class="single-item mt-2">
                                <div class=" mb-3 pull-right">
                                    <div class="d-flex  mr-5">
                                        <h4 class="font-weight-bold">Subtotal : &nbsp; </h4> <strong>
                                            <h4 class=""> LKR {{ $subtotal }}</h4>
                                        </strong>
                                    </div>
                                    <button class="theme-btn-one pt-2 pb-2 mt-2" wire:click="checkout">Checkout</button>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>


        </div>
    @else
        <div class="cart-empty text-center mb-3">
            <div class="cart-empty-text">There are no items in this cart</div>
            <a href="{{ route('public.product') }}" type="button" class="cart-empty-button">CONTINUE
                SHOPPING</a>
        </div>
    @endif
</div>
