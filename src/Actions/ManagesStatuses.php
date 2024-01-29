<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Transforms\TransformsStatuses;

trait ManagesStatuses
{
    use TransformsStatuses;

    /**
     * Get a list of available statuses for the provided space.
     *
     * @param string $spaceId
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Status[]
     */
    public function statuses($spaceId)
    {
        $response = $this->get("space/{$spaceId}");

        return $this->fromClickupStatuses($response['statuses']);
    }
}
