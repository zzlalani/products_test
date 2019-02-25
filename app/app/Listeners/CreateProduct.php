<?php

namespace App\Listeners;

use App\Events\CreateProduct as CreateProductEvent;
use App\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProduct
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
     * @param  CreateProduct  $event
     * @return void
     */
    public function handle(CreateProductEvent $event)
    {
        if (isset($event->productInput)) {
            Product::create($event->productInput);
        }
    }
}
