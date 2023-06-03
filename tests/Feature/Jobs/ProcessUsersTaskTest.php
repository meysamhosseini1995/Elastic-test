<?php

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessTasks;
use App\Jobs\ProcessUsersTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProcessUsersTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_processes_tasks_for_users_with_tasks()
    {
        Queue::fake();

        $userWithTask = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $userWithTask->id]);

        $userWithoutTask = User::factory()->create();

        $users = collect([$userWithTask, $userWithoutTask]);

        ProcessUsersTask::dispatch($users);

        Queue::assertPushedOn('UserTaskProcessing', ProcessUsersTask::class);
    }

    /** @test */
    public function it_does_not_process_tasks_for_users_without_tasks()
    {
        Queue::fake();

        $userWithoutTask = User::factory()->create();

        $users = collect([$userWithoutTask]);

        ProcessUsersTask::dispatch($users);

        Queue::assertPushedOn('UserTaskProcessing', ProcessUsersTask::class);
        Queue::assertNotPushed(ProcessTasks::class, function ($job) use ($userWithoutTask) {
            return $job->user->id === $userWithoutTask->id;
        });
    }
}
