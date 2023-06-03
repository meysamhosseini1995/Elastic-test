<?php


namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskRepository extends Repository
{
    public array $selectableList = ['id','user_id','keyword'];


    /**
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return mixed
     */
    public function myTasks(array $columns = ['*'], array $relations = []): mixed
    {
        return $this->model->where('user_id',Auth::id())->with($relations)->get($this->getColumns($columns));
    }
}
