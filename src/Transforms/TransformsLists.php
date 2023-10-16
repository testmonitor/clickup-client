<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\TaskList;

trait TransformsLists
{
    /**
     * @param array $lists
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\TaskList[]
     */
    protected function fromClickupLists($lists): array
    {
        Validator::isArray($lists);

        return array_map(function ($list) {
            return $this->fromClickupList($list);
        }, $lists);
    }

    /**
     * @param array $list
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\TaskList
     */
    protected function fromClickupList($list): TaskList
    {
        Validator::keysExists($list, ['id', 'name']);

        return new TaskList([
            'id' => $list['id'],
            'name' => $list['name'],
            'orderIndex' => $list['orderindex'],
            'content' => $list['content'] ?? '',
        ]);
    }
}
