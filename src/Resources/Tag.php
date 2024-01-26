<?php

namespace TestMonitor\Clickup\Resources;

class Tag extends Resource
{
    /**
     * The name of the tag.
     *
     * @var string
     */
    public $name;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->name = $attributes['name'];
    }
}
