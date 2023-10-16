<?php

namespace TestMonitor\Clickup\Resources;

class TaskList extends Resource
{
    /**
     * The id of the list.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the list.
     *
     * @var string
     */
    public $name;

    /**
     * The order index of the list.
     *
     * @var int
     */
    public $orderindex;

    /**
     * The content of the list.
     *
     * @var string
     */
    public $content;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->orderindex = $attributes['orderindex'] ?? 0;
        $this->content = $attributes['content'] ?? '';
    }
}
