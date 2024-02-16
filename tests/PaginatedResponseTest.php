<?php

namespace TestMonitor\Clickup\Tests;

use PHPUnit\Framework\TestCase;
use TestMonitor\Clickup\Responses\PaginatedResponse;

class PaginatedResponseTest extends TestCase
{
    /** @test */
    public function it_should_return_a_paginated_response()
    {
        // Given
        $response = new PaginatedResponse([0 => 'Foo', 1 => 'Bar'], true);

        // When
        $result = $response->items();

        // Then
        $this->assertCount(2, $result);
        $this->assertIsArray($result);
        $this->assertEquals('Foo', $result[0]);
    }

    /** @test */
    public function it_should_have_a_fixed_page_limit_of_100_items()
    {
        // Given
        $response = new PaginatedResponse([0 => 'Foo', 1 => 'Bar']);

        // When
        $result = $response->perPage();

        // Then
        $this->assertEquals(100, $result);
    }

    /** @test */
    public function it_should_be_able_to_determine_that_there_are_more_items()
    {
        // Given
        $response = new PaginatedResponse([0 => 'Foo', 1 => 'Bar'], true);

        // When
        $result = $response->hasMore();

        // Then
        $this->assertTrue($result);
    }
}
