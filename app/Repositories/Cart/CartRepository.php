<?php

namespace App\Repositories\Cart;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartRepository implements CartRepositoryInterface
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }
    public function get(): Collection
    {
        if (!$this->items->count()) {
            return Cart::with('product')->get(); //->cookie_id()
        }
        return $this->items;

        // $user = Auth::user();
        // if($user){
        //     return Cart::with('product')->cookie_id()->where('user_id' , $user)->get();
        // }
        // return Cart::where('user_id' , Auth::id())->get();
    }


    public function add(Product $product, $quantity = 1)
    {

        $item = Cart::where('product_id', $product->id)
            ->first(); //->cookie_id()
        if (!$item) {
            $cart = Cart::create([
                // 'cookie_id' => $this->getCookie_id(),
                'user_id'   => Auth::id(),
                'product_id' => $product->id,
                'quantity'  => $quantity,
            ]);
            return $this->get()->push($cart);
        }
        return $item->increment('quantity', $quantity ?? 1);
        //         $item = Cart::where('offer' , '>=' , 1)
        //         ->cookie_id()
        //         ->first();
        //         $carts = Cart::all();
        //         $Blouse = Product::where('item_type' , 'Blouse')->first();
        //         $T_shirt = Product::where('item_type' , 'T-shirt')->first();
        //         if($Blouse){$Blouse_cart = $carts->where('product_id' , $Blouse->id)->cookie_id()->first();}
        //         if($T_shirt){$T_shirt_cart = $carts->where('product_id' , $T_shirt->id)->cookie_id()->first() ;}
        //         $Jacket = Product::where('item_type' , 'Jacket')->first();
        //         $conditionsarray = [(($product->item_type == 'T-shirt' && $quantity >= 2) || ($product->item_type == 'Blouse' && $quantity >= 2))
        //         , $product->item_type == 'T-shirt' and !empty($Blouse_cart) 
        //         , $product->item_type == 'T-shirt' and !empty($T_shirt_cart)
        //         , $product->item_type == 'Blouse' and !empty($Blouse_cart)
        //         , $product->item_type == 'Blouse' and !empty($T_shirt_cart) 
        //  ];

        //         for($i=0 ; $i<count($conditionsarray) ; $i++){
        //             if($conditionsarray[$i]){
        //                 if(!$item || $item->user_id != Auth::id()){
        //                 Cart::create([
        //                 'cookie_id' => $this->getCookie_id(),
        //                 'user_id'   => Auth::id(),
        //                 'product_id'=> $Jacket->id,
        //                 'quantity'  => 1,
        //                 'offer'     => $Jacket->price - (0.5 * $Jacket->price),
        //             ]);
        //             break ;
        //             }

        //             else{
        //                 $item->increment('quantity' , $Jacket->quantity + 1);
        //                 break ;
        //             }
        //             }
        //         }
        //         $itemcart = Cart::where('product_id' , $product->id)
        //         ->cookie_id()
        //         ->first();
        //         if(!$itemcart || $itemcart->user_id != Auth::id() || $itemcart->product->item_type == 'Jacket'){
        //             return Cart::create([
        //                 'cookie_id' => $this->getCookie_id(),
        //                 'user_id'   => Auth::id(),
        //                 'product_id'=> $product->id,
        //                 'quantity'  => $quantity,
        //             ]);
        //         }
        //         return $itemcart->increment('quantity' , $quantity);
    }
    public function update($id, $quantity = 1)
    {
        $item = Cart::where('product_id', $id)->first();
            // ->cookie_id()
            $item->update([
                'quantity' => $quantity,
            ]);
        return $item;
    }

    public function delete($id)
    {
        $item = Cart::where('id', $id)
            ->first(); //->cookie_id()
        $item->destroy($id);
    }

    public function empty()
    {
        Cart::query()->delete();
        // return Cart::cookie_id()
        // ->destroy();
    }

    public function total(): float
    {
        return (float) $this->get()->sum(function ($item) {
            return ($item->quantity * $item->product->price);
        });
    }
    // return (float)Cart::where('user_id' , Auth::id())//cookie_id()->
    // ->join('products' , 'products.id' , 'carts.product_id')
    // ->selectRaw('SUM(products.price*carts.quantity) as total')
    // ->value('total');
    // public function subtotal()
    // {
    //     $subtotal = (float)Cart::cookie_id()
    //     ->where('user_id' , Auth::id())
    //     ->join('products' , 'products.id' , 'carts.product_id')
    //     ->selectRaw('SUM(products.price * carts.quantity) as total')
    //     ->value('total');
    //     return $subtotal ;
    // }
    // public function shipping()
    // {
    //     $shipping = (float)Cart::cookie_id()
    //     ->where('user_id' , Auth::id())
    //     ->join('products' , 'products.id' , 'carts.product_id')
    //     ->selectRaw('SUM(products.shipping * carts.quantity ) as total')
    //     ->value('total');
    //     return $shipping ;
    // }
}
