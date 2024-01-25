<?php

namespace TestMonitor\Clickup\Resources;

class Task extends Resource
{
    /**
     * The id of the task.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the task.
     *
     * @var string
     */
    public $name;

    /**
     * The description of the task.
     *
     * @var string
     */
    public $description;

    /**
     * The status of the task.
     *
     * @var \TestMonitor\Clickup\Resources\Status
     */
    public $status;

    /**
     * The priority for the task.
     *
     * @var int
     */
    public $priority;

    /**
     * The due date of the task.
     *
     * @var string
     */
    public $dueDate;

    /**
     * The start date of the task.
     *
     * @var string
     */
    public $startDate;

    /**
     * The estimate of the task.
     *
     * @var string
     */
    public $timeEstimate;

    /**
     * The URL for the task.
     *
     * @var string
     */
    public $url;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'] ?? null;
        $this->name = $attributes['name'];
        $this->description = $attributes['description'] ?? '';
        $this->status = $attributes['status'] ?? null;
        $this->priority = $attributes['priority'] ?? 0;
        $this->dueDate = $attributes['dueDate'] ?? '';
        $this->startDate = $attributes['startDate'] ?? '';
        $this->timeEstimate = $attributes['timeEstimate'] ?? '';
        $this->url = $attributes['url'] ?? '';
    }
}
