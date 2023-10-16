<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Resources\Folder;
use TestMonitor\Clickup\Resources\Space;
use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\Workspace;

trait TransformsFolders
{
    /**
     * @param array $folders
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Folder[]
     */
    protected function fromClickupFolders($folders): array
    {
        Validator::isArray($folders);

        return array_map(function ($folder) {
            return $this->fromClickupFolder($folder);
        }, $folders);
    }

    /**
     * @param array $folder
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Folder
     */
    protected function fromClickupFolder($folder): Folder
    {
        Validator::keysExists($folder, ['id', 'name']);

        return new Folder([
            'id' => $folder['id'],
            'name' => $folder['name'],
            'orderIndex' => $folder['orderindex'],
            'hidden' => $folder['hidden'],
        ]);
    }
}
