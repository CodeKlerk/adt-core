<?php

namespace App\Listeners;

use App\Events\CreatePatientEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatePatientListener
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
     * @param  CreatePatientListener  $event
     * @return void
     */
    public function handle(CreatePatientEvent $event)
    {
        // 
    }
}
