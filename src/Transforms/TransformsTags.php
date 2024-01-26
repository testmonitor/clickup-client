<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\Tag;

trait TransformsTags
{
    /**
     * @param array $tags
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     * @return \TestMonitor\Clickup\Resources\Tag[]
     *
     */
    protected function fromClickupTags($tags): array
    {
        Validator::isArray($tags);

        return array_map(function ($tag) {
            return $this->fromClickupTag($tag);
        }, $tags);
    }

    /**
     * @param array $tag
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     * @return \TestMonitor\Clickup\Resources\Tag
     *
     */
    protected function fromClickupTag($tag): Tag
    {
        Validator::keysExists($tag, ['name']);

        return new Tag([
            'name' => $tag['name'],
        ]);
    }
}
