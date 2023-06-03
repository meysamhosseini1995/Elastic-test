<?php

namespace Tests\Feature;

use App\Enums\IndexModels;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Arr;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * Test All Threads List Should be Accessible
     */
    public function test_get_all_task_list_should_be_accessible()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->getJson(route('task.index'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_store_task_should_be_validate()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson(route('task.store'), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['index_name', 'keyword']);
    }


    public function test_store_new_task()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $index_name = Arr::random(IndexModels::cases());
        $keyword = fake()->text(20);
        $data = [
            "user_id" => $user->id,
            "index_name" => $index_name,
            "keyword" => $keyword,
        ];
        $response = $this->postJson(route('task.store'),$data);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue(Task::query()->where($data)->exists());
    }



    /*
     * Test Delete Thread
     */

    public function test_task_delete()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $task = Task::factory()->create();
        $response = $this->deleteJson(route('task.destroy', $task));

        $response->assertStatus(Response::HTTP_OK);
    }

}
