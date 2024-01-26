<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Transforms\TransformsMembers;

trait ManagesMembers
{
    use TransformsMembers;

    /**
     * Get a list of available members for the provided list.
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Member[]
     */
    public function members($listId)
    {
        $response = $this->get("list/{$listId}/member");

        return $this->fromClickupMembers($response['members']);
    }
}
