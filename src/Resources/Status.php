<?php

namespace TestMonitor\Clickup\Resources;

class Status extends Resource
{
    /**
     * The id of the status.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the status.
     *
     * @var string
     */
    public $name;

    /**
     * The type of the status.
     *
     * @var string
     */
    public $type;

    /**
     * The order index of the status.
     *
     * @var integer
     */
    public $orderIndex;

    /**
     * The color of the status.
     *
     * @var string
     */
    public $color;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->type = $attributes['type'];
        $this->orderIndex = $attributes['orderIndex'] ?? 0;
        $this->color = $attributes['color'] ?? '';
    }
}
