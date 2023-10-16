<?php

namespace TestMonitor\Clickup;

use TestMonitor\Clickup\Exceptions\InvalidDataException;

class Validator
{
    /**
     * @param mixed $subject
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return bool
     */
    public static function isInteger($subject)
    {
        if (! is_integer($subject)) {
            throw new InvalidDataException($subject);
        }

        return true;
    }

    /**
     * @param mixed $subject
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return bool
     */
    public static function isString($subject)
    {
        if (! is_string($subject)) {
            throw new InvalidDataException($subject);
        }

        return true;
    }

    /**
     * @param mixed $subject
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return bool
     */
    public static function isArray($subject)
    {
        if (! is_array($subject)) {
            throw new InvalidDataException($subject);
        }

        return true;
    }

    /**
     * @param mixed $haystack
     * @param mixed $needle
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return bool
     */
    public static function keyExists($haystack, $needle)
    {
        if (! array_key_exists($needle, $haystack)) {
            throw new InvalidDataException($haystack);
        }

        return true;
    }

    /**
     * @param mixed $haystack
     * @param array $needles
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return bool
     */
    public static function keysExists($haystack, array $needles)
    {
        foreach ($needles as $needle) {
            self::keyExists($haystack, $needle);
        }

        return true;
    }
}
