<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Transforms\TransformsStatuses;

trait ManagesStatuses
{
    use TransformsStatuses;

    /**
     * Get a list of available statuses for the provided list.
     *
     * @param string $listId
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Status[]
     */
    public function statuses($listId)
    {
        $response = $this->get("list/{$listId}");

        return $this->fromClickupStatuses($response['statuses']);
    }
}
