<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Resources\Task;
use TestMonitor\Clickup\Builders\TaskFilters;
use TestMonitor\Clickup\Transforms\TransformsTasks;
use TestMonitor\Clickup\Responses\PaginatedResponse;

trait ManagesTasks
{
    use TransformsTasks;

    /**
     * Get a single task.
     *
     * @param string $id
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Task
     */
    public function task(string $id): Task
    {
        $response = $this->get("task/{$id}");

        return $this->fromClickupTask($response);
    }

    /**
     * Get a list of of tasks for a list.
     *
     * @param string $listId
     * @param \TestMonitor\Clickup\Builders\TaskFilters|null $query
     * @param int $page
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Responses\PaginatedResponse
     */
    public function tasks(string $listId, ?TaskFilters $query = null, $page = 0): PaginatedResponse
    {
        $response = $this->get("list/{$listId}/task", [
            'query' => [
                ...['page' => $page],
                ...$query instanceof TaskFilters ? $query->getQuery() : (new TaskFilters)->getQuery(),
            ],
        ]);

        return new PaginatedResponse(
            items: $this->fromClickupTasks($response['tasks']),
            hasMore: ! $response['last_page']
        );
    }

    /**
     * Create a new task.
     *
     * @param \TestMonitor\Clickup\Resources\Task $task
     * @param string $listId
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Task
     */
    public function createTask(Task $task, string $listId): Task
    {
        $response = $this->post(
            "list/{$listId}/task",
            [
                'json' => $this->toClickupTask($task),
            ]
        );

        return $this->fromClickupTask($response);
    }
}
