<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Resources\Task;
use TestMonitor\Clickup\Transforms\TransformsTasks;

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
