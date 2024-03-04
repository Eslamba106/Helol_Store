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
    
    protected $card ;

    public function __construct(CartRepositoryInterface $card)
    {
        $this->card = $card;
    }
    public function index()
    {
        // $items = $cart->get() ;
        // $items = $this->repo->get() ;
        return view('front.card' , ['card'=>$this->card]);
    }

public function show($id){}
    public function store(Request $request , CartRepositoryInterface $cart)
    {
        $request->validate([
            'product_id' => ['required' , 'integer' , 'exists:products,id'],
            'quantity'   => ['nullable' , 'integer' , 'min:1'],
        ]);
        $product = Product::findOrFail($request->product_id);
        $cart->add($product , $request->quantity ?? 1);
        return redirect()->route('cart.index')->with('success' , 'Product added! to cart!');

    }


    public function update(Request $request, CartRepositoryInterface $cart)
    {
        $request->validate([
            'product_id' => ['required' , 'integer' , 'exists:products,id'],
            'quantity'   => ['nullable' , 'integer' , 'min:1'],
        ]);
        $product = Product::findOrFail($request->product_id);

        $cart->update($product ,  $request->quantity);
        return back()->with('message' , 'successfully Updated!');


    }

    public function destroy(CartRepository $cart , $slug)
    {
        // dd($cart);
        $prod = Product::where('slug' , $slug)->first();
        $id = Cart::where('product_id' ,$prod->id )->first();
        // dd($id->id);
        $cart->delete($id->id   );
        return redirect()->back()->with('success' , 'successfully delete');

    }

    public function empty(){
        return $this->card->empty();
    }

    public function total()
    {
        return $this->card->total();
    }

}