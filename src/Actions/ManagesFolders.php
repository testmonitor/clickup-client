<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Transforms\TransformsFolders;

trait ManagesFolders
{
    use TransformsFolders;

    /**
     * Get a list of folders within a space.
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Folder[]
     */
    public function folders($spaceId)
    {
        $response = $this->get("space/{$spaceId}/folder");

        return $this->fromClickupFolders($response['folders']);
    }
}
