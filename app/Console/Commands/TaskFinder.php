<?php

namespace App\Console\Commands;

use App\Jobs\ProcessUsersTask;
use App\Models\User;
use Illuminate\Console\Command;

class TaskFinder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:find';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command search task keyword in elastic engin and when find send alert';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::query()->has('tasks', '>', 0)->with('tasks')->get();
        ProcessUsersTask::dispatch($users);
        $this->info("Task Run");
    }
}
