<?php

namespace App\Listeners;

use App\Events\CustomerCreated;
use App\Mail\NewCustomerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyAdmin implements ShouldQueue
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
    public function handle(CustomerCreated $event): void
    {
        Mail::to('admin@laravel.com')->send(new NewCustomerNotification($event->customer));
    }
}
