<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentPostedOnPostWatched;

class NotifyUsersPostWasCommented implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::thatHasCommentedOnPost($this->comment->commentable)
        ->get()
        ->filter(function (User $user) {
            return $user->id !== $this->comment->user_id;
        })->map(function (User $user) {
            Mail::to($user)->send(
                new CommentPostedOnPostWatched($this->comment, $user)
            );
        });
    }
}
