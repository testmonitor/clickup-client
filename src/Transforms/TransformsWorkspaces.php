<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\Workspace;

trait TransformsWorkspaces
{
    /**
     * @param array $workspaces
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Workspace[]
     */
    protected function fromClickupWorkspaces($workspaces): array
    {
        Validator::isArray($workspaces);

        return array_map(function ($workspace) {
            return $this->fromClickupWorkspace($workspace);
        }, $workspaces);
    }

    /**
     * @param array $workspace
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Workspace
     */
    protected function fromClickupWorkspace($workspace): Workspace
    {
        Validator::keysExists($workspace, ['id', 'name']);

        return new Workspace([
            'id' => $workspace['id'],
            'name' => $workspace['name'],
            'color' => $workspace['color'],
            'avatar' => $workspace['avatar'],
        ]);
    }
}
