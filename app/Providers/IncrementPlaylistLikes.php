<?php

namespace App\Providers;

use App\Events\LikesRowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementPlaylistLikes
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
     * @param  LikesRowCreated  $event
     * @return void
     */
    public function handle(LikesRowCreated $event)
    {
        //
    }
}
