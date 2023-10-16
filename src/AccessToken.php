<?php

namespace TestMonitor\Clickup;

use League\OAuth2\Client\Token\AccessToken as OAuth2AccessToken;

class AccessToken
{
    /**
     * @var string
     */
    public $accessToken;

    /**
     * Token constructor.
     *
     * @param string $accessToken
     */
    public function __construct(string $accessToken = '')
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param \League\OAuth2\Client\Token\AccessToken $token
     * @return \TestMonitor\Clickup\AccessToken
     */
    public static function fromClickup(OAuth2AccessToken $token)
    {
        return new self($token->getToken());
    }

    /**
     * Returns the token as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'access_token' => $this->accessToken,
        ];
    }
}
