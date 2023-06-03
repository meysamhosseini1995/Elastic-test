<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\DeleteTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->middleware(["auth:sanctum"]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response_ok($this->taskRepository->myTasks());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskRepository->create($request->validated());
        return response_ok($task,status_code:  Response::HTTP_CREATED);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->taskRepository->deleteById($id);
        return response_ok(message: "The selected item was successfully deleted");
    }
}
