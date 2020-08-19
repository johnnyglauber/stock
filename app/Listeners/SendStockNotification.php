<?php

namespace App\Listeners;

use App\Events\LowStock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendStockNotification
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
     * @param LowStock $event
     * @return void
     */
    public function handle(LowStock $event)
    {
        $product = $event->product;
    }
}
