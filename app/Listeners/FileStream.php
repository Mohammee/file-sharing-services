<?php

namespace App\Listeners;

use App\Models\Stream;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FileStream
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
    public function handle(object $event): void
    {
        $event->media->logs()->create([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
