<?php

namespace TestMonitor\Clickup\Resources;

class Workspace extends Resource
{
    /**
     * The id of the workspace.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the workspace.
     *
     * @var string
     */
    public $name;

    /**
     * The color of the workspace.
     *
     * @var string
     */
    public $color;

    /**
     * The avatar of the workspace.
     *
     * @var string
     */
    public $avatar;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->color = $attributes['color'] ?? '';
        $this->avatar = $attributes['avatar'] ?? '';
    }
}
