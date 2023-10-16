<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Resources\Space;
use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\Workspace;

trait TransformsSpaces
{
    use TransformsStatuses;

    /**
     * @param array $spaces
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Space[]
     */
    protected function fromClickupSpaces($spaces): array
    {
        Validator::isArray($spaces);

        return array_map(function ($space) {
            return $this->fromClickupSpace($space);
        }, $spaces);
    }

    /**
     * @param array $space
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Space
     */
    protected function fromClickupSpace($space): Space
    {
        Validator::keysExists($space, ['id', 'name']);

        return new Space([
            'id' => $space['id'],
            'name' => $space['name'],
            'private' => $space['color'],
            'statuses' => $this->fromClickupStatuses($space['statuses']),
        ]);
    }
}
