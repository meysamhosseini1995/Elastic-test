<?php

namespace App\Jobs;

use App\Events\TaskWasFoundInSearchEngine;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Service\SearchEngine\Facades\SearchEngine;

class ProcessTasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        $this->onQueue('taskProcessing');
    }



    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $taskIds = $this->handeUserTasks();
        TaskWasFoundInSearchEngine::dispatchIf(!empty($taskIds), $taskIds,$this->user);
    }

    public function handeUserTasks(): array
    {
        $taskIds = [];
        foreach ($this->user->tasks as $task) {
            if ($this->isFindItem($task)) {
                $taskIds[] = $task->id;
            }
        }
        return $taskIds;
    }

    public function isFindItem($task): bool
    {
        $find = SearchEngine::Search($this->makeQuery($task->index_name, $task->keyword));
        $res = json_decode(json_encode($find));
        return $res->hits->total->value > 0;
    }


    public function makeQuery($index, $text): array
    {
        return [
            'index' => $index,
            'body' => [
                'query' => [
                    'multi_match' => [
                        "query" => $text,
                        "type" => "best_fields",
                        "minimum_should_match" => 3,
                        "fuzziness" => "2"
//                    "operator" =>   "and",
                    ],
                ],
            ],
        ];
    }
}
