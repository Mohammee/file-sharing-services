<?php

namespace App\Listeners;

use App\Models\Media;
use App\Models\Stream;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        try {
            DB::beginTransaction();
            $event->media->logs()->create([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            $event->media->increment('count', 1);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();

            Log::error('Database Error: ' . $e->getMessage());
        }
    }
}
