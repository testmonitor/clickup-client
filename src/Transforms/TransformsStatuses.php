<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\Status;

trait TransformsStatuses
{
    /**
     * @param array $statuses
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Status[]
     */
    protected function fromClickupStatuses($statuses): array
    {
        Validator::isArray($statuses);

        return array_map(function ($status) {
            return $this->fromClickupStatus($status);
        }, $statuses);
    }

    /**
     * @param array $status
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Status
     */
    protected function fromClickupStatus($status): Status
    {
        Validator::keysExists($status, ['id', 'status']);

        return new Status([
            'id' => $status['id'],
            'name' => $status['status'],
            'type' => $status['type'],
            'orderIndex' => $status['orderindex'],
            'color' => $status['color'],
        ]);
    }
}
