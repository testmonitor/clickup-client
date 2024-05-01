<?php

namespace TestMonitor\Clickup\Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use TestMonitor\Clickup\Client;
use TestMonitor\Clickup\Resources\Attachment;

class AttachmentsTest extends TestCase
{
    protected $token;

    protected $attachment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->token = Mockery::mock('\TestMonitor\Clickup\AccessToken');
        $this->token->shouldReceive('expired')->andReturnFalse();

        $this->attachment = (object) ['id' => 1, 'url' => 'https://clickup/logo.png', 'title' => 'Attachment'];
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    /** @test */
    public function it_should_add_an_attachment_to_a_task()
    {
        // Given
        $clickup = new Client(['clientId' => 1, 'clientSecret' => 'secret', 'redirectUrl' => 'none'], $this->token);

        $clickup->setClient($service = Mockery::mock('GuzzleHttp\Client'));

        $service->shouldReceive('request')->andReturn($response = Mockery::mock('Psr\Http\Message\ResponseInterface'));
        $response->shouldReceive('getStatusCode')->andReturn(200);
        $response->shouldReceive('getBody')->andReturn(\GuzzleHttp\Psr7\Utils::streamFor(json_encode($this->attachment)));

        // When
        $attachment = $clickup->addAttachment(__DIR__ . '/files/logo.png', 1);

        // Then
        $this->assertInstanceOf(Attachment::class, $attachment);
        $this->assertEquals($this->attachment->id, $attachment->id);
    }
}
