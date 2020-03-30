<?php

namespace App\Providers;

use App\Providers\FollowRowDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecrementPlaylistFollows
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
     * @param  FollowRowDeleted  $event
     * @return void
     */
    public function handle(FollowRowDeleted $event)
    {
        //
    }
}
