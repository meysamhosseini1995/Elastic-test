<?php

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessTasks;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProcessTasksTest extends TestCase
{
    public function testJobIsAddedToCorrectQueue()
    {
        $user = User::factory()->create();
        $job = new ProcessTasks($user);

        $this->assertEquals('taskProcessing', $job->queue);
    }

    public function testJobIsConstructedWithUser()
    {
        $user = User::factory()->create();
        $job = new ProcessTasks($user);

        $this->assertSame($user, $job->user);
    }


}
