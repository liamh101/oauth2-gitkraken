<?php
namespace Liamh\Oauth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;

class GitKraken extends AbstractProvider
{

    private const DOMAIN = 'https://app.gitkraken.com/';

    public const USER_READ_SCOPE = 'user:read';
    public const USER_WRITE_SCOPE = 'user:write';
    public const BOARD_READ_SCOPE = 'board:read';
    public const BOARD_WRITE_SCOPE = 'board:write';

    public function __construct(array $options = [], array $collaborators = [])
    {
        parent::__construct($options, $collaborators);
    }

    /**
     * Returns the base URL for authorizing a client.
     *
     * Eg. https://oauth.service.com/authorize
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return self::DOMAIN . 'oauth/authorize';
    }

    /**
     * Returns the base URL for requesting an access token.
     *
     * Eg. https://oauth.service.com/token
     *
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return self::DOMAIN . 'oauth/access_token';
    }

    /**
     * Returns the URL for requesting the resource owner's details.
     *
     * @param \League\OAuth2\Client\Token\AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(\League\OAuth2\Client\Token\AccessToken $token)
    {
        return self::DOMAIN . 'user';
    }

    /**
     * Returns the default scopes used by this provider.
     *
     * This should only be the scopes that are required to request the details
     * of the resource owner, rather than all the available scopes.
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return [self::USER_READ_SCOPE];
    }

    protected function getScopeSeparator()
    {
        return ' ';
    }

    /**
     * Checks a provider response for errors.
     *
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @param  array|string $data Parsed response data
     * @return void
     */
    protected function checkResponse(\Psr\Http\Message\ResponseInterface $response, $data)
    {

    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     *
     * @param  array $response
     * @param  \League\OAuth2\Client\Token\AccessToken $token
     * @return \League\OAuth2\Client\Provider\ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, \League\OAuth2\Client\Token\AccessToken $token)
    {
        return new GitKrakenResourceOwner($response);
    }
}