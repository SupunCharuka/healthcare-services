<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Info extends Component
{

    public Product $product;
    public $discount_price;
    public $prices;
    public $selectedVariation;
    public $quantity;

    public $product_id;



    public function mount($product)
    {
        $this->product = $product;
        $this->selectedVariation =  $product->productVariations->first()->id; //null
        $this->loadPrices();
        $this->prices = $product->productVariations?->first();
        // Calculate and set the discount price
        $this->discount_price = $this->calculateDiscountPrice($this->prices);
        $this->quantity = 1;
        $this->product_id = $product->id;
    }

    private function loadPrices()
    {
        if ($this->selectedVariation) {
            $variation = $this->product->productVariations->find($this->selectedVariation);
            $this->prices = $variation;
            $this->discount_price = $this->calculateDiscountPrice($variation);
        } else {
            $this->prices = null;
            $this->discount_price = null;
        }
    }

    private function calculateDiscountPrice($prices)
    {
        if ($prices && $prices->discount > 0) {
            $discountPercentage = $prices->discount;
            $discountAmount = ($discountPercentage / 100) * $prices->price;
            $discountedPrice = $prices->price - $discountAmount;
            return $discountedPrice;
        }

        return $prices ? $prices->price : null;
    }

    public function updatedSelectedVariation()
    {
        $this->loadPrices();
    }

    public function submitForm($action = null)
    {
        if ($this->selectedVariation && $this->quantity > 0) {



            if ($action === 'buy_now') {
                if (!(auth()->check())) {
                    return Redirect::to('/login')->with('error', 'Login First!');
                } else {
                    session()->forget('buy'); // Clear the existing 'buy' session data
                    $buyItems = [];

                    $productImages =  ProductImage::where('product_id', $this->product_id)->first();
                    $images =  storage('uploads/admin/product-images/thumb/' . $productImages->images);
                    $productNames = Product::find($this->product_id)->name;


                    $buyItems[] = [
                        'variation' => $this->selectedVariation,
                        'quantity' => $this->quantity,
                        'product_id' => $this->product_id,
                        'discount_price' => $this->discount_price *  $this->quantity,
                        'price' => $this->discount_price,
                        'product_image' => $images,
                        'product_name' => $productNames,
                        'max_quantity' =>  $this->prices->quantity,
                    ];

                    session(['buy' => $buyItems]);
                    $this->emit('buyNow');
                    return redirect()->route('checkout');
                }
            } elseif ($action === 'add_to_cart') {

                $cartItems = session('cart', []);

                // Check if the product already exists in the cart
                $existingItemIndex = $this->findCartItemIndex($cartItems, $this->product_id, $this->selectedVariation);

                if ($existingItemIndex !== -1) {

                    // Product already exists, show a message
                    session()->flash('error', 'Product already added to cart.');
                    return;
                } else {
                    session()->forget('buy');
                    $productImages =  ProductImage::where('product_id', $this->product_id)->first();
                    $images =  storage('uploads/admin/product-images/thumb/' . $productImages->images);
                    $productNames = Product::find($this->product_id)->name;


                    $cartItems[] = [
                        'variation' => $this->selectedVariation,
                        'quantity' => $this->quantity,
                        'product_id' => $this->product_id,
                        'discount_price' => $this->discount_price *  $this->quantity,
                        'price' => $this->discount_price,
                        'product_image' => $images,
                        'product_name' => $productNames,
                        'max_quantity' =>  $this->prices->quantity,
                    ];
                }
                session(['cart' => $cartItems]);
                $this->emit('cartUpdated');
                session()->flash('message', 'Item added to cart successfully.');
            }
        }
    }

    private function findCartItemIndex($cartItems, $productId, $variation)
    {
        foreach ($cartItems as $index => $item) {
            if ($item['product_id'] == $productId && $item['variation'] == $variation) {
                return $index;
            }
        }
        return -1;
    }

    public function render()
    {
        return view('livewire.frontend.product.info');
    }
}
