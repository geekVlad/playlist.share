<?php

namespace App\Providers;

use App\Providers\FollowRowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementPlaylistFollows
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
     * @param  FollowRowCreated  $event
     * @return void
     */
    public function handle(FollowRowCreated $event)
    {
        //
    }
}
