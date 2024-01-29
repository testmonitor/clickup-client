<?php

namespace TestMonitor\Clickup\Builders;

use Closure;

class TaskFilters
{
    /**
     * Assignee filter.
     *
     * @var array
     */
    protected array $assignees = [];

    /**
     * Include closed tasks.
     *
     * @var bool
     */
    protected bool $closed = false;

    /**
     * Status filter.
     *
     * @var array
     */
    protected array $statuses = [];

    /**
     * Include subtasks.
     *
     * @var bool
     */
    protected bool $subtasks = false;

    /**
     * Tag filter.
     *
     * @var array
     */
    protected array $tags = [];

    /**
     * Filter by assignee.
     *
     * @param array $assignees
     * @return \TestMonitor\Clickup\Builders\TaskFilters
     */
    public function assignees(array $assignees): self
    {
        $this->assignees = $assignees;

        return $this;
    }

    /**
     * Include closed tasks.
     *
     * @return \TestMonitor\Clickup\Builders\TaskFilters
     */
    public function includeClosed(): self
    {
        $this->closed = true;

        return $this;
    }

    /**
     * Include subtasks.
     *
     * @return \TestMonitor\Clickup\Builders\TaskFilters
     */
    public function includeSubtasks(): self
    {
        $this->subtasks = true;

        return $this;
    }

    /**
     * Filter by status.
     *
     * @param array $statuses
     * @return \TestMonitor\Clickup\Builders\TaskFilters
     */
    public function statuses(array $statuses): self
    {
        $this->statuses = $statuses;

        return $this;
    }

    /**
     * Filter by tag(s).
     *
     * @param array $tags
     * @return \TestMonitor\Clickup\Builders\TaskFilters
     */
    public function tags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Executes the callback when value is true.
     *
     * @param mixed $value
     * @param callable $callback
     * @return \TestMonitor\Clickup\Builders\TaskFilters
     */
    public function when(mixed $value, callable $callback): self
    {
        $value = $value instanceof Closure ? $value($this) : $value;

        if ($value) {
            return $callback($this, $value) ?? $this;
        }

        return $this;
    }

    /**
     * Generates the HTTP query parameters.
     *
     * @return array
     */
    public function getQuery(): array
    {
        return array_filter([
            'assignees' => $this->assignees,
            'include_closed' => $this->closed,
            'statuses' => $this->statuses,
            'subtasks' => $this->subtasks,
            'tags' => $this->tags,
        ]);
    }
}
