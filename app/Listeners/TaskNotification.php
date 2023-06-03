<?php

namespace App\Listeners;

use App\Events\TaskWasFoundInSearchEngine;
use App\Notifications\TaskFoundNotices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class TaskNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskWasFoundInSearchEngine $event): void
    {
        $event->user->notify(new TaskFoundNotices("Task Found" ,$event->foundTaskIds));
    }
}
