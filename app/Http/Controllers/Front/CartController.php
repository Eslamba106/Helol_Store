<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;

class CartController extends Controller
{
    
    protected $cart ;

    public function __construct(CartRepositoryInterface $cart)
    {
        $this->cart = $cart;
    }
    public function index()
    {
        // $items = $cart->get() ;
        // $items = $this->repo->get() ;
        return view('front.cart' , ['cart'=>$this->cart]);
    }

public function show($id){}
    public function store(Request $request , CartRepositoryInterface $cart)
    {
        $request->validate([
            'product_id' => ['required' , 'integer' , 'exists:products,id'],
            'quantity'   => ['nullable' , 'integer' , 'min:1'],
        ]);
        $product = Product::findOrFail($request->product_id);
        // dd($product);
        $cart->add($product , $request->quantity ?? 1);
        return redirect()->route('cart.index')->with('success' , 'Product added! to cart!');

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity'   => ['required' , 'integer' , 'min:1'],
        ]);
        // $product = Product::findOrFail($request->id);

        $this->cart->update($id ,$request->quantity);
        return back()->with('message' , 'successfully Updated!');


    }

    public function destroy($id)
    {
        // dd($cart);
        // $product = Product::where('slug' , $slug)->first();
        // $cart_product = Cart::where('product_id' ,$product->id )->first();
        $this->cart->delete($id);
        return ['message' , 'successfully delete'];

    }

    public function empty(){
        return $this->cart->empty();
    }

    public function total()
    {
        return $this->cart->total();
    }
    // public function cartItemCount()
    // {
    //     dd(count(collect($this->cart)));
    // }

}