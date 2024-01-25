<?php

namespace TestMonitor\Clickup\Responses;

class PaginatedResponse
{
    /**
     * All of the items being paginated.
     *
     * @var array
     */
    protected array $items;

    /**
     * Indicates more records are available.
     *
     * @var int
     */
    protected bool $hasMore;

    /**
     * Create a new paginated response instance.
     *
     * @param array $items
     * @param int $hasMore
     */
    public function __construct(array $items, bool $hasMore = false)
    {
        $this->items = $items;
        $this->hasMore = $hasMore;
    }

    /**
     * Get the items being paginated.
     *
     * @return array
     */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * Determines if there are more pages available.
     *
     * @return bool
     */
    public function hasMore(): bool
    {
        return $this->hasMore;
    }

    /**
     * The number of available items per page.
     *
     * @return int
     */
    public function perPage(): int
    {
        return 100;
    }
}
