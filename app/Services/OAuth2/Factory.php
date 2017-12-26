<?php

namespace Deplink\Repository\App\Services\OAuth2;

use Deplink\Repository\App\Services\OAuth2\Exceptions\ProviderNotSupportedException;
use League\OAuth2\Client\Provider\Github;
use Phalcon\DiInterface;

class Factory
{
    const PROVIDERS = [
        'github' => Github::class,
    ];

    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * Factory constructor.
     *
     * @param DiInterface $di
     */
    public function __construct(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * @param string $providerName
     * @return Provider
     * @throws ProviderNotSupportedException
     */
    public function make($providerName)
    {
        if(!isset(self::PROVIDERS[$providerName])) {
            throw new ProviderNotSupportedException();
        }

        $provider = self::PROVIDERS[$providerName];
        return new $provider($this->di);
    }
}
