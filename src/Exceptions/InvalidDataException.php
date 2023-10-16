<?php

namespace TestMonitor\Clickup\Exceptions;

class InvalidDataException extends Exception
{
    /**
     * The given data.
     *
     * @var mixed
     */
    protected $data;

    /**
     * Create a new exception instance.
     *
     * @param mixed $data
     */
    public function __construct($data)
    {
        parent::__construct('The given data contains invalid data and cannot be decoded.');

        $this->data = $data;
    }

    /**
     * The given data.
     *
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }
}
