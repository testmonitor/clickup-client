<?php

namespace TestMonitor\Clickup\Exceptions;

class ValidationException extends Exception
{
    /**
     * The array of errors.
     *
     * @var array
     */
    protected $errors;

    /**
     * Create a new exception instance.
     *
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        parent::__construct('The given data failed to pass validation.');

        $this->errors = $errors;
    }

    /**
     * The array of errors.
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }
}
