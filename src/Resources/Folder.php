<?php

namespace TestMonitor\Clickup\Resources;

class Folder extends Resource
{
    /**
     * The id of the folder.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the folder.
     *
     * @var string
     */
    public $name;

    /**
     * The order index of the folder.
     *
     * @var int
     */
    public $orderindex;

    /**
     * Indicates this folder is hidden.
     *
     * @var bool
     */
    public $hidden;

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
        $this->hidden = (bool) $attributes['hidden'] ?? false;
    }
}
