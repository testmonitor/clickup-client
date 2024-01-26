<?php

namespace TestMonitor\Clickup\Resources;

class Member extends Resource
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
    public $username;

    /**
     * Indicates this is a private space.
     *
     * @var bool
     */
    public $email;

    /**
     * The statuses available for this space.
     *
     * @var array<\TestMonitor\Clickup\Resources\Space>
     */
    public $avatarUrl;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->username = $attributes['username'];
        $this->email = $attributes['email'];
        $this->avatarUrl = $attributes['avatarUrl'] ?? [];
    }
}
