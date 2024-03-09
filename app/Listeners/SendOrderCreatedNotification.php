<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreatedNotification;

class SendOrderCreatedNotification
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
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        // dd($order->store_id);
        $user = User::where('store_id',$order->store_id)->first();
        // dd($user->store_id);
        $user->notify(new OrderCreatedNotification($order));
        // $users = User::where('store_id',$order->store_id)->get();
        // Notification::send($users , new OrderCreatedNotification($order));


    }
}
