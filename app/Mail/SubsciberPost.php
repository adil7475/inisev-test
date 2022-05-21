<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubsciberPost extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;
    /**
     * @var Post
     */
    protected $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user-post-subscription-email')
            ->with(['user' => $this->user, 'post' => $this->post]);
    }
}
