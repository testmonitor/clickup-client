<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Transforms\TransformsSpaces;

trait ManagesSpaces
{
    use TransformsSpaces;

    /**
     * Get a list of available spaces for the provided workspace.
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Space[]
     */
    public function spaces($workspaceId)
    {
        $response = $this->get("team/{$workspaceId}/space");

        return $this->fromClickupSpaces($response['spaces']);
    }
}
