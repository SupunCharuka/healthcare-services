<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;

class Cart extends Component
{

    public $cartCount;
    public $cartItems = [];
    public $cartTotal = 0; 

    protected $listeners = [
        'cartUpdated' => 'updateCartCount',
    ];

    public function mount()
    {
        
        // dd($this->cartItems);
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $this->cartItems = session('cart', []);
        // $cartItems = session('cart', []);
        $this->cartCount = count($this->cartItems);
        $this->cartTotal = $this->calculateCartTotal($this->cartItems);
    }

  
    private function calculateCartTotal($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $item) {

            
            $total += $item['discount_price'];
        }

        return $total;
    }

     public function removeItem($index)
    {
        $cartItems = session('cart', []);

        if (isset($cartItems[$index])) {
            unset($cartItems[$index]);
            session(['cart' => $cartItems]);
            $this->cartItems = $cartItems; // Update the cart items in the component
            $this->emit('cartUpdated');
        }
    }


    public function render()
    {
        return view('livewire.frontend.product.cart');
    }
}
