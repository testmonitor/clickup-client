<?php

namespace TestMonitor\Clickup\Tests;

use PHPUnit\Framework\TestCase;
use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Exceptions\InvalidDataException;

class ValidatorTest extends TestCase
{
    /** @test */
    public function it_should_validate_an_integer()
    {
        // When
        $result = Validator::isInteger(1);

        // Then
        $this->assertTrue($result);
    }

    /** @test */
    public function it_should_throw_an_exception_when_validating_an_integer_using_a_string()
    {
        // Given
        $this->expectException(InvalidDataException::class);

        // When
        Validator::isInteger('a string');
    }

    /** @test */
    public function it_should_validate_a_string()
    {
        // When
        $result = Validator::isString('a string');

        // Then
        $this->assertTrue($result);
    }

    /** @test */
    public function it_should_throw_an_exception_when_validating_a_string_using_a_integer()
    {
        // Given
        $this->expectException(InvalidDataException::class);

        // When
        Validator::isString(1);
    }

    /** @test */
    public function it_should_validate_an_array()
    {
        // When
        $result = Validator::isArray(['1', '2', '3']);

        // Then
        $this->assertTrue($result);
    }

    /** @test */
    public function it_should_throw_an_exception_when_validating_an_array_using_a_string()
    {
        // Given
        $this->expectException(InvalidDataException::class);

        // When
        Validator::isArray('a string');
    }

    /** @test */
    public function it_should_validate_an_array_having_a_specified_key()
    {
        // When
        $result = Validator::keyExists(['id' => 1, 'name' => 'name'], 'id');

        // Then
        $this->assertTrue($result);
    }

    /** @test */
    public function it_should_throw_an_exception_when_validating_an_array_without_the_requested_key()
    {
        // Given
        $this->expectException(InvalidDataException::class);

        // When
        Validator::keyExists(['id' => 1], 'name');
    }

    /** @test */
    public function it_should_validate_an_array_having_a_multiple_keys()
    {
        // When
        $result = Validator::keysExists(['id' => 1, 'name' => 'name'], ['id', 'name']);

        // Then
        $this->assertTrue($result);
    }

    /** @test */
    public function it_should_throw_an_exception_when_validating_an_array_without_all_of_the_requested_keys()
    {
        // Given
        $this->expectException(InvalidDataException::class);

        // When
        Validator::keysExists(['id' => 1], ['name', 'description']);
    }

    /** @test */
    public function it_should_throw_an_exception_when_validating_an_array_without_any_of_the_requested_keys()
    {
        // Given
        $this->expectException(InvalidDataException::class);

        // When
        Validator::keysExists(['id' => 1], ['id', 'description']);
    }
}
