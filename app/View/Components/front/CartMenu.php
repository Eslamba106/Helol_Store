<?php

namespace App\View\Components\front;

use Closure;
use App\Facades\Cart;
use App\Repositories\Cart\CartRepository;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CartMenu extends Component
{
    /**
     * Create a new component instance.
     */

     public $items ;
     public $total ;

    public function __construct(CartRepository $cart)
    {
        $this->items = $cart->get();
        $this->total = $cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.cart-menu');
    }
}
