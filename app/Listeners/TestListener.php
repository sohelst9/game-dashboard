<?php

namespace App\Listeners;

use App\Events\TestEvent;

class TestListener
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
    public function handle(TestEvent $event): void
    {
        echo ('data: ' . json_encode($event->data) . ' and datas: ' . json_encode($event->datas));
    }
}
