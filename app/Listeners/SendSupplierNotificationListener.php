<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendSupplierNotification;
use App\Notifications\productAddToCart;
class SendSupplierNotificationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendSupplierNotification $event)
    {
        $event->user->notify(new productAddToCart());
    }
}
