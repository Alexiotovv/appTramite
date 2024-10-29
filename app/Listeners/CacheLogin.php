<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use App\Events\Login;

class CacheLogin
{
    protected $expirationTime = 7776000; //Three months in seconds
 
    public function __construct(){}

    public function handle(Login $event): void
    {
        $userId = $event->user->userId;
        cache::put($userId, $event->user, $seconds = $this->expirationTime);
    }
}