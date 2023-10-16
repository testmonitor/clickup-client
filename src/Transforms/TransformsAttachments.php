<?php

namespace TestMonitor\Clickup\Transforms;

use TestMonitor\Clickup\Validator;
use TestMonitor\Clickup\Resources\Attachment;

trait TransformsAttachments
{
    /**
     * @param array $attachment
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Attachment
     */
    protected function fromClickupAttachment(array $attachment): Attachment
    {
        Validator::keysExists($attachment, ['id', 'url']);

        return new Attachment([
            'id' => $attachment['id'],
            'title' => $attachment['title'],
            'url' => $attachment['url'],
        ]);
    }
}
