<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Transforms\TransformsLists;

trait ManagesLists
{
    use TransformsLists;

    /**
     * Get a list of lists within a space.
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\TaskList[]
     */
    public function lists($spaceId)
    {
        $response = $this->get("space/{$spaceId}/list");

        return $this->fromClickupLists($response['lists']);
    }

    /**
     * Get a list of lists within a folder.
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\TaskList[]
     */
    public function listsInFolder($folderId)
    {
        $response = $this->get("folder/{$folderId}/list");

        return $this->fromClickupLists($response['lists']);
    }
}
