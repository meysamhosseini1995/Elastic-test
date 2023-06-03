<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUsersTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $users)
    {
        $this->onQueue('UserTaskProcessing');
    }



    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->users as $user){
            ProcessTasks::dispatchIf(!empty($user->tasks[0]),$user);
        }
    }
}
