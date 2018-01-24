<?php

namespace Deplink\Repository\App\Services\OAuth2;

use Deplink\Repository\App\Services\Injectable;
use Deplink\Repository\App\Services\OAuth2\Exceptions\ProviderNotSupportedException;
use League\OAuth2\Client\Provider\Github;
use Phalcon\Config;
use Phalcon\Di\InjectionAwareInterface;

/**
 * Give access to OAuth2 providers by their names.
 */
class Factory extends \Phalcon\Di\Injectable
{
    /**
     * @var array
     */
    protected $providers;

    /**
     * @var Config
     */
    protected $config;

    public function __construct()
    {
        $this->providers = $this->getDI()
            ->get('config')
            ->path('auth.oauth2.providers');

        $this->config = $this->getDI()->get('config');
    }

    /**
     * @param string $providerName
     * @return Client
     * @throws ProviderNotSupportedException
     */
    public function make($providerName)
    {
        if (!isset($this->providers[$providerName])) {
            throw new ProviderNotSupportedException();
        }

        $providerClass = $this->providers[$providerName];
        $settings = $this->config->path("auth.oauth2.config.$providerName", []);

        $provider = $this->getDI()->get($providerClass, [$settings->toArray()]);
        $client = $this->getDI()->get(Client::class, [$providerName, $provider]);

        return $client;
    }
}
