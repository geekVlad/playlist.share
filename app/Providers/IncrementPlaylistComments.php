<?php

namespace App\Providers;

use App\Events\CommentsRowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementPlaylistComments
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
     * @param  CommentsRowCreated  $event
     * @return void
     */
    public function handle(CommentsRowCreated $event)
    {
        //
    }
}
