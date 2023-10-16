<?php

namespace TestMonitor\Clickup\Resources;

class Space extends Resource
{
    /**
     * The id of the space.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the space.
     *
     * @var string
     */
    public $name;

    /**
     * Indicates this is a private space.
     *
     * @var boolean
     */
    public $private;

    /**
     * The statuses available for this space.
     *
     * @var array<\TestMonitor\Clickup\Resources\Space>
     */
    public $statuses;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->private = $attributes['private'] ?? false;
        $this->statuses = $attributes['statuses'] ?? [];
    }
}
