<?php

namespace TestMonitor\Clickup\Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use TestMonitor\Clickup\Client;
use TestMonitor\Clickup\AccessToken;
use TestMonitor\Clickup\Exceptions\UnauthorizedException;

class OauthTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    /** @test */
    public function it_should_create_a_token()
    {
        // When
        $token = new AccessToken('12345');

        // Then
        $this->assertInstanceOf(AccessToken::class, $token);
        $this->assertIsArray($token->toArray());
    }

    /** @test */
    public function it_should_provide_an_authorization_url()
    {
        // Given
        $dispatcher = Mockery::mock('\League\OAuth2\Client\Provider\GenericProvider');
        $state = 'somestate';

        $dispatcher->shouldReceive('getAuthorizationUrl')->with(['state' => $state])->andReturn('https://clickup.authorization.url');

        $clickup = new Client(['clientId' => 1, 'clientSecret' => 'secret', 'redirectUrl' => 'none'], new AccessToken(), $dispatcher);

        // When
        $url = $clickup->authorizationUrl($state);

        // Then
        $this->assertEquals('https://clickup.authorization.url', $url);
    }

    /** @test */
    public function it_should_fetch_a_token()
    {
        // Given
        $dispatcher = Mockery::mock('\League\OAuth2\Client\Provider\GenericProvider');

        $newToken = new AccessToken('12345');

        $dispatcher->accessToken = $newToken->accessToken;

        $code = 'somecode';

        $dispatcher->shouldReceive('getAccessToken')->once()->andReturn(new \League\OAuth2\Client\Token\AccessToken([
            'access_token' => $newToken->accessToken,
        ]));

        $clickup = new Client(['clientId' => 1, 'clientSecret' => 'secret', 'redirectUrl' => 'none'], new AccessToken(), $dispatcher);

        // When
        $token = $clickup->fetchToken($code);

        // Then
        $this->assertInstanceOf(AccessToken::class, $token);
        $this->assertEquals($token->accessToken, $newToken->accessToken);
    }

    /** @test */
    public function it_should_not_provide_a_client_without_a_token()
    {
        // Given
        $clickup = new Client(['clientId' => 1, 'clientSecret' => 'secret', 'redirectUrl' => 'none']);

        $this->expectException(UnauthorizedException::class);

        // When
        $clickup->workspaces();
    }
}
