<?php

namespace App\Listeners;

use App\Events\EmployeeCreated;
use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmployeeToTrackTikApi
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
    public function handle(EmployeeCreated $event): void
    {
        //
    }
}
