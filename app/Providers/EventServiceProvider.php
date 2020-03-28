<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\CommentsRowCreated;
use App\Events\CommentsRowDeleted;
use App\Events\LikesRowCreated;
use App\Events\LikesRowDeleted;
use App\Listeners\DecrementPlaylistLikes;
use App\Listeners\IncrementPlaylistLikes;
use App\Listeners\DecrementPlaylistComments;
use App\Listeners\IncrementPlaylistComments;



class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentsRowCreated::class => [
            IncrementPlaylistComments::class,
        ],
        CommentsRowDeleted::class => [
            DecrementPlaylistComments::class,
        ],
        LikesRowCreated::class => [
            IncrementPlaylistLikes::class,
        ],
        LikesRowDeleted::class => [
            DecrementPlaylistLikes::class,
        ],



    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        
    }
}
