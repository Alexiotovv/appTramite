<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Logout AS LogoutEvent;
use Illuminate\Support\Facades\Cache;

class Logout
{

    public function handle(LogoutEvent $event): void
    {
        cache::forget($event->userId);
    }
}