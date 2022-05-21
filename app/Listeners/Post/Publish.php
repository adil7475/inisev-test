<?php

namespace App\Listeners\Post;

use App\Jobs\SendEmailToSubscriber;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Publish
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->post->load('website');
        $event->post->load('website.users');

        if (!empty($event->post->website) && !empty($event->post->website->users)) {
            foreach ($event->post->website->users as $user) {
                //Add in queues
                SendEmailToSubscriber::dispatch($user, $event->post);
            }
        }
    }
}
