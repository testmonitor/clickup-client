<?php

namespace TestMonitor\Clickup\Tests;

use PHPUnit\Framework\TestCase;
use TestMonitor\Clickup\Builders\TaskFilters;

class TaskFiltersTest extends TestCase
{
    /** @test */
    public function it_should_build_an_assignees_filter()
    {
        // Given
        $filter = new TaskFilters();

        // When
        $filter->assignees(['foo' => 'bar']);

        // Then
        $this->assertIsArray($filter->getQuery());
        $this->assertArrayHasKey('assignees', $filter->getQuery());
        $this->assertCount(1, $filter->getQuery());
        $this->assertEquals(['assignees' => ['foo' => 'bar']], $filter->getQuery());
    }

    /** @test */
    public function it_should_build_a_filter_that_includes_closed_tasks()
    {
        // Given
        $filter = new TaskFilters();

        // When
        $filter->includeClosed();

        // Then
        $this->assertIsArray($filter->getQuery());
        $this->assertArrayHasKey('include_closed', $filter->getQuery());
        $this->assertCount(1, $filter->getQuery());
        $this->assertEquals(['include_closed' => true], $filter->getQuery());
    }

    /** @test */
    public function it_should_build_a_filter_that_includes_subtasks_tasks()
    {
        // Given
        $filter = new TaskFilters();

        // When
        $filter->includeSubtasks();

        // Then
        $this->assertIsArray($filter->getQuery());
        $this->assertArrayHasKey('subtasks', $filter->getQuery());
        $this->assertCount(1, $filter->getQuery());
        $this->assertEquals(['subtasks' => true], $filter->getQuery());
    }

    /** @test */
    public function it_should_build_a_statuses_filter()
    {
        // Given
        $filter = new TaskFilters();

        // When
        $filter->statuses(['foo' => 'bar']);

        // Then
        $this->assertIsArray($filter->getQuery());
        $this->assertArrayHasKey('statuses', $filter->getQuery());
        $this->assertCount(1, $filter->getQuery());
        $this->assertEquals(['statuses' => ['foo' => 'bar']], $filter->getQuery());
    }

    /** @test */
    public function it_should_build_a_tags_filter()
    {
        // Given
        $filter = new TaskFilters();

        // When
        $filter->tags(['foo' => 'bar']);

        // Then
        $this->assertIsArray($filter->getQuery());
        $this->assertArrayHasKey('tags', $filter->getQuery());
        $this->assertCount(1, $filter->getQuery());
        $this->assertEquals(['tags' => ['foo' => 'bar']], $filter->getQuery());
    }

    /** @test */
    public function it_should_build_a_filter_using_conditions()
    {
        // Given
        $filter = new TaskFilters();

        // When
        $filter->when(true, fn (TaskFilters $filters) => $filters->assignees(['foo' => 'bar']))
            ->when(false, fn (TaskFilters $filters) => $filters->tags(['foo' => 'bar']));

        // Then
        $this->assertIsArray($filter->getQuery());
        $this->assertArrayHasKey('assignees', $filter->getQuery());
        $this->assertArrayNotHasKey('tags', $filter->getQuery());
        $this->assertCount(1, $filter->getQuery());
    }
}
