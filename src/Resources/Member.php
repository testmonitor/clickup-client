<?php

namespace TestMonitor\Clickup\Resources;

class Member extends Resource
{
    /**
     * The id of the member.
     *
     * @var string
     */
    public $id;

    /**
     * The user name of the member.
     *
     * @var string
     */
    public $username;

    /**
     * The member's email address.
     *
     * @var string
     */
    public $email;

    /**
     * The member's avatar URL.
     *
     * @var string
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
        $this->avatarUrl = $attributes['avatarUrl'] ?? '';
    }
}
