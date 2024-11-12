<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Events\UpdateUser AS UpdateUserEvent;
use Illuminate\Support\Facades\Cache;

class UpdateUser
{
    protected $expirationTime = 7776000; //Three months in seconds

    public function handle(UpdateUserEvent $event): void
    {
        $user = User::retriveUserFill($event->userId);
        cache::forget($event->userId);
        cache::put($event->userId, $user, $seconds = $this->expirationTime);
    }
}