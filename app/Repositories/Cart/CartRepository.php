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
    public function get() : Collection {
        return Cart::with('product')->where('cookie_id' , $this->getCookie_id())->get();
        // return Cart::where('user_id' , Auth::id())->get();
    }
    

    public function add(Product $product , $quantity=1){

        $item = Cart::where('product_id' , $product->id)
        ->where('cookie_id' , $this->getCookie_id())->first();
        if(!$item){

        
        return Cart::create([
            'cookie_id' => $this->getCookie_id(),
            'user_id'   => Auth::id(),
            'product_id'=> $product->id,
            'quantity'  => $quantity,
        ]);
    }
        return $item->increment('quantity' , $quantity ?? 1);
//         $item = Cart::where('offer' , '>=' , 1)
//         ->where('cookie_id' , $this->getCookie_id())
//         ->first();
//         $carts = Cart::all();
//         $Blouse = Product::where('item_type' , 'Blouse')->first();
//         $T_shirt = Product::where('item_type' , 'T-shirt')->first();
//         if($Blouse){$Blouse_cart = $carts->where('product_id' , $Blouse->id)->where('cookie_id' , $this->getCookie_id())->first();}
//         if($T_shirt){$T_shirt_cart = $carts->where('product_id' , $T_shirt->id)->where('cookie_id' , $this->getCookie_id())->first() ;}
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
//         ->where('cookie_id' , $this->getCookie_id())
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
    public function update(Product $product , $quantity = 1){
        $item = Cart::where('product_id' , $product->id)
        ->where('cookie_id' , $this->getCookie_id())
        ->updata([
            'quantity' => $quantity,
        ]);
        return $item ;
    }

    public function delete($id){
        $item = Cart::where('id' , $id)
        ->where('cookie_id' , $this->getCookie_id())->first();
        $item->delete();
    }

    public function empty(){
        return Cart::where('cookie_id' , $this->getCookie_id())
        ->destroy();
    }

    public function total() :float
    {
        return (float)Cart::where('cookie_id' , $this->getCookie_id())
        ->where('user_id' , Auth::id())
        ->join('products' , 'products.id' , 'carts.product_id')
        ->selectRaw('SUM(products.price*carts.quantity) as total')
        ->value('total');
    }
    // public function subtotal()
    // {
    //     $subtotal = (float)Cart::where('cookie_id' , $this->getCookie_id())
    //     ->where('user_id' , Auth::id())
    //     ->join('products' , 'products.id' , 'carts.product_id')
    //     ->selectRaw('SUM(products.price * carts.quantity) as total')
    //     ->value('total');
    //     return $subtotal ;
    // }
    // public function shipping()
    // {
    //     $shipping = (float)Cart::where('cookie_id' , $this->getCookie_id())
    //     ->where('user_id' , Auth::id())
    //     ->join('products' , 'products.id' , 'carts.product_id')
    //     ->selectRaw('SUM(products.shipping * carts.quantity ) as total')
    //     ->value('total');
    //     return $shipping ;
    // }
    protected function getCookie_id(){
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id){
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id' , $cookie_id , 30*24*60*60);
            // Cookie::queue('cart_id' , $cookie_id , Carbon::now()->addDays(30));
        }
        return $cookie_id ;
    }
}