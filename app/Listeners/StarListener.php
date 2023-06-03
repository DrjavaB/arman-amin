<?php

namespace App\Listeners;

use App\Events\StarEvent;
use App\Http\Controllers\StarCountController;

class StarListener
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
    public function handle(StarEvent $event): void
    {
        (new StarCountController())->store($event->star);
    }
}
