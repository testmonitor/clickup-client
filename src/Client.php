<?php

namespace TestMonitor\Clickup;

use Psr\Http\Message\ResponseInterface;
use TestMonitor\Clickup\Exceptions\Exception;
use League\OAuth2\Client\Provider\GenericProvider;
use TestMonitor\Clickup\Exceptions\NotFoundException;
use TestMonitor\Clickup\Exceptions\ValidationException;
use TestMonitor\Clickup\Exceptions\FailedActionException;
use TestMonitor\Clickup\Exceptions\TokenExpiredException;
use TestMonitor\Clickup\Exceptions\UnauthorizedException;

class Client
{
    use Actions\ManagesAttachments,
        Actions\ManagesFolders,
        Actions\ManagesLists,
        Actions\ManagesSpaces,
        Actions\ManagesWorkspaces,
        Actions\ManagesTasks;

    /**
     * @var \TestMonitor\Clickup\AccessToken
     */
    protected $token;

    /**
     * @var string
     */
    protected $baseUrl = 'https://api.clickup.com/api/v2/';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var \League\OAuth2\Client\Provider\GenericProvider
     */
    protected $provider;

    /**
     * Create a new client instance.
     *
     * @param array $credentials
     * @param \TestMonitor\Clickup\AccessToken $token
     * @param \League\OAuth2\Client\Provider\GenericProvider $provider
     */
    public function __construct(
        array $credentials,
        AccessToken $token = null,
        GenericProvider $provider = null
    ) {
        $this->token = $token;

        $this->provider = $provider ?? new GenericProvider([
            'clientId' => $credentials['clientId'],
            'clientSecret' => $credentials['clientSecret'],
            'redirectUri' => $credentials['redirectUrl'],
            'urlAuthorize' => $credentials['authorizeUrl'] ?? 'https://app.clickup.com/api',
            'urlAccessToken' => $credentials['accessTokenUrl'] ?? 'https://api.clickup.com/api/v2/oauth/token',
            'urlResourceOwnerDetails' => $credentials['urlResourceOwnerDetails'] ??
                'https://api.clickup.com/api/v2/user',
        ]);
    }

    /**
     * Create a new authorization URL for the given state.
     *
     * @param string $state
     * @return string
     */
    public function authorizationUrl($state)
    {
        return $this->provider->getAuthorizationUrl(['state' => $state]);
    }

    /**
     * Fetch the access and refresh token based on the authorization code.
     *
     * @param string $code
     * @return \TestMonitor\Clickup\AccessToken
     */
    public function fetchToken(string $code): AccessToken
    {
        $token = $this->provider->getAccessToken('authorization_code', [
            'code' => $code,
        ]);

        $this->token = AccessToken::fromClickup($token);

        return $this->token;
    }

    /**
     * Returns an Guzzle client instance.
     *
     * @throws \TestMonitor\Clickup\Exceptions\UnauthorizedException
     * @throws TokenExpiredException
     *
     * @return \GuzzleHttp\Client
     */
    protected function client()
    {
        if (empty($this->token)) {
            throw new UnauthorizedException();
        }

        return $this->client ?? new \GuzzleHttp\Client([
            'base_uri' => $this->baseUrl . '/',
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function setClient(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    /**
     * Make a GET request to Clickup servers and return the response.
     *
     * @param string $uri
     * @param array $payload
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TestMonitor\Clickup\Exceptions\FailedActionException
     * @throws \TestMonitor\Clickup\Exceptions\NotFoundException
     * @throws \TestMonitor\Clickup\Exceptions\TokenExpiredException
     * @throws \TestMonitor\Clickup\Exceptions\UnauthorizedException
     * @throws \TestMonitor\Clickup\Exceptions\ValidationException
     *
     * @return mixed
     */
    protected function get($uri, array $payload = [])
    {
        return $this->request('GET', $uri, $payload);
    }

    /**
     * Make a POST request to Clickup servers and return the response.
     *
     * @param string $uri
     * @param array $payload
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TestMonitor\Clickup\Exceptions\FailedActionException
     * @throws \TestMonitor\Clickup\Exceptions\NotFoundException
     * @throws \TestMonitor\Clickup\Exceptions\TokenExpiredException
     * @throws \TestMonitor\Clickup\Exceptions\UnauthorizedException
     * @throws \TestMonitor\Clickup\Exceptions\ValidationException
     *
     * @return mixed
     */
    protected function post($uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Make a PUT request to Forge servers and return the response.
     *
     * @param string $uri
     * @param array $payload
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TestMonitor\Clickup\Exceptions\FailedActionException
     * @throws \TestMonitor\Clickup\Exceptions\NotFoundException
     * @throws \TestMonitor\Clickup\Exceptions\TokenExpiredException
     * @throws \TestMonitor\Clickup\Exceptions\UnauthorizedException
     * @throws \TestMonitor\Clickup\Exceptions\ValidationException
     *
     * @return mixed
     */
    protected function patch($uri, array $payload = [])
    {
        return $this->request('PATCH', $uri, $payload);
    }

    /**
     * Make request to Clickup servers and return the response.
     *
     * @param string $verb
     * @param string $uri
     * @param array $payload
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TestMonitor\Clickup\Exceptions\FailedActionException
     * @throws \TestMonitor\Clickup\Exceptions\NotFoundException
     * @throws \TestMonitor\Clickup\Exceptions\TokenExpiredException
     * @throws \TestMonitor\Clickup\Exceptions\UnauthorizedException
     * @throws \TestMonitor\Clickup\Exceptions\ValidationException
     *
     * @return mixed
     */
    protected function request($verb, $uri, array $payload = [])
    {
        $response = $this->client()->request(
            $verb,
            $uri,
            $payload
        );

        if (! in_array($response->getStatusCode(), [200, 201, 203, 204, 206])) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * @param  \Psr\Http\Message\ResponseInterface $response
     *
     * @throws \TestMonitor\Clickup\Exceptions\ValidationException
     * @throws \TestMonitor\Clickup\Exceptions\NotFoundException
     * @throws \TestMonitor\Clickup\Exceptions\FailedActionException
     * @throws \Exception
     *
     * @return void
     */
    protected function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 422) {
            throw new ValidationException(json_decode((string) $response->getBody(), true));
        }

        if ($response->getStatusCode() == 404) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() == 401 || $response->getStatusCode() == 403) {
            throw new UnauthorizedException();
        }

        if ($response->getStatusCode() == 400) {
            throw new FailedActionException((string) $response->getBody());
        }

        throw new Exception((string) $response->getStatusCode());
    }
}
