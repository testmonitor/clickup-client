<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Transforms\TransformsTags;

trait ManagesTags
{
    use TransformsTags;

    /**
     * Get a list of tags for the provided space.
     *
     * @param string $spaceId
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Tag[]
     */
    public function tags($spaceId)
    {
        $response = $this->get("space/{$spaceId}/tag");

        return $this->fromClickupTags($response['tags']);
    }
}
