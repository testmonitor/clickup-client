<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Transforms\TransformsWorkspaces;

trait ManagesWorkspaces
{
    use TransformsWorkspaces;

    /**
     * Get a list of workspaces accessible to the authenticated user.
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Workspace[]
     */
    public function workspaces()
    {
        $response = $this->get("team");

        return $this->fromClickupWorkspaces($response['teams']);
    }
}
