<?php

namespace Deplink\Repository\App\Services\OAuth2;

use Deplink\Repository\App\Services\Injectable;
use Deplink\Repository\App\Services\OAuth2\Exceptions\ProviderNotSupportedException;
use League\OAuth2\Client\Provider\Github;
use Phalcon\Di\InjectionAwareInterface;

class Factory extends \Phalcon\Di\Injectable
{
    /**
     * @var array
     */
    protected $providers;

    public function __construct()
    {
        $this->providers = $this->getDI()
            ->get('config')
            ->path('security.oauth2.providers');
    }

    /**
     * @param string $providerName
     * @return Provider
     * @throws ProviderNotSupportedException
     */
    public function make($providerName)
    {
        if (!isset($this->providers[$providerName])) {
            throw new ProviderNotSupportedException();
        }

        $provider = $this->providers[$providerName];
        return $this->getDI()->get($provider);
    }
}
