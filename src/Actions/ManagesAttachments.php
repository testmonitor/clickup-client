<?php

namespace TestMonitor\Clickup\Actions;

use TestMonitor\Clickup\Resources\Attachment;
use TestMonitor\Clickup\Transforms\TransformsAttachments;

trait ManagesAttachments
{
    use TransformsAttachments;

    /**
     * Add a new attachment.
     *
     * @param string $path
     * @param string $taskId
     *
     * @throws \TestMonitor\Clickup\Exceptions\InvalidDataException
     *
     * @return \TestMonitor\Clickup\Resources\Attachment
     */
    public function addAttachment(string $path, string $taskId): Attachment
    {
        $response = $this->post(
            "task/{$taskId}/attachment",
            [
                'multipart' => [
                    [
                        'name' => 'attachment',
                        'contents' => fopen($path, 'r' ),
                    ], [
                        'name' => 'filename',
                        'contents' => basename($path),
                    ], [
                        'name' => "title",
                        'contents' => basename($path),
                    ],
                ]
            ]
        );

        return $this->fromClickupAttachment($response);
    }
}
