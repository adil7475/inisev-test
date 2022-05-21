<?php

namespace App\Jobs;

use App\Mail\SubsciberPost;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailToSubscriber implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Website
     */
    protected $user;

    /**
     * @var Post
     */
    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)
            ->send(new SubsciberPost($this->user, $this->post));
    }
}
