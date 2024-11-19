<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;

class DeleteFile implements ShouldQueue
{
    use Queueable;

    public function __construct(private string $path){}

    public function handle(): void
    {
        File::delete($this->path);
    }
}