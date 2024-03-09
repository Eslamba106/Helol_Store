<?php

namespace App\Http\Controllers\Front;

use Throwable;
use App\Models\Order;
use App\Models\OrderItem;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use App\Repositories\Cart\CartRepositoryInterface;

class CheckoutController extends Controller
{
    public function create(CartRepositoryInterface $cart)
    {

        // $items = $cart->get();
        // $items =$items->groupBy('product.store_id');
        // dd($items->all());

        if($cart->get()->count() == 0){
            return redirect()->route('home');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(Request $request, CartRepositoryInterface $cart)
    {
        $request->validate([
            'addr.billing.first_name'=>['string' , 'required' , 'max:255'],
            'addr.billing.last_name'=>['string' , 'required' , 'max:255'],
            'addr.billing.email'=>['string' , 'required', 'max:255'],
            'addr.billing.phone_number'=>['string' , 'required', 'max:255'],
            'addr.billing.city'=>['string' , 'required', 'max:255'],

        ]);

        $items = $cart->get()->groupBy('product.store_id')->all();
        // $items->groupBy('product.store_id');

        DB::beginTransaction();
        try {

            foreach ($items as $store_id => $cart_item) {
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',

                ]);
                foreach ($cart_item as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }
        // $cart->empty();
            DB::commit();
            event(new OrderCreated($order));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('home');
    }
}
