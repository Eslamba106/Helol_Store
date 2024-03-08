<?php

namespace App\Listeners;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        foreach(Cart::get() as $item){
            // dd($item);
            Product::where('id' ,'=', $item->product_id)
            ->update([
                // 'quantity' => 2
                'quantity' => DB::raw("quantity - {$item->quantity}"),
            ]);
        }
    }
}
