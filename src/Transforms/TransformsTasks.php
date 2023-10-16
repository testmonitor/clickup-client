<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\Task;

trait TransformsTasks
{
    use TransformsStatuses;

    /**
     * @param \TestMonitor\Clickup\Resources\Task $task
     * @return array
     */
    protected function toClickupTask(Task $task): array
    {
        return array_filter([
            'name' => $task->name,
            'markdown_description' => $task->description,
            'status' => $task->status?->name,
            'priority' => $task->priority,
            'dueDate' => $task->dueDate,
            'startDate' => $task->startDate,
            'timeEstimate' => $task->timeEstimate,
        ]);
    }

    /**
     * @param array $task
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Task
     */
    protected function fromClickupTask(array $task): Task
    {
        Validator::keysExists($task, ['id', 'name']);

        return new Task([
            'id' => $task['id'],
            'name' => $task['name'],
            'description' => $task['description'] ?? '',
            'status' => $this->fromClickupStatus($task['status']),
            'orderindex' => $task['orderindex'] ?? 0,
            'created' => $task['date_created'] ?? '',
            'updated' => $task['date_updated'] ?? '',
            'priority' => $task['priority'] ?? '',
            'dueDate' => $task['due_date'] ?? '',
            'startDate' => $task['start_date'] ?? '',
            'timeEstimate' => $task['time_estimate'] ?? '',
            'timeSpent' => $task['time_spent'] ?? '',
            'url' => $task['url'] ?? '',
        ]);
    }
}
