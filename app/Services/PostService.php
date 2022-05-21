<?php

namespace App\Services;

use App\Events\Post\Publish;
use App\Models\Post;

class PostService
{
    /**
     * @param Post $post
     * @return void
     */
    public function publishPost(Post $post)
    {
        /**
         * Here we are dispatching event, but we can also dispatch the Job here if we have to only send the email
         */
        Publish::dispatch($post);
    }
}
