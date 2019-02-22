<?php

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class GitKrakenResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /** @var array */
    private $response;

    /**
     * GitKrakenResourceOwner constructor.
     * @param array $response
     */
    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    /**
     * Returns the identifier of the authorized resource owner.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->getValueByKey($this->response, 'id');
    }

    public function getUsername(): string
    {
        return $this->getValueByKey($this->response, 'username');
    }

    public function getName(): string
    {
        return $this->getValueByKey($this->response, 'name');
    }

    public function getEmail(): string
    {
        return $this->getValueByKey($this->response, 'email');
    }

    public function toArray(): array
    {
        return $this->response;
    }
}