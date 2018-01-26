<?php

namespace Deplink\Repository\App\Services\OAuth2;

use Deplink\Repository\App\Services\OAuth2\Exceptions\ProviderNotSupportedException;
use Phalcon\Di\Injectable;

/**
 * Give access to OAuth2 providers by their names.
 */
class Factory extends Injectable
{
    /**
     * @param string $providerName
     * @return Client
     * @throws ProviderNotSupportedException
     */
    public function make($providerName)
    {
        $providers = $this->config->path('auth.oauth2.providers');
        if (!isset($providers[$providerName])) {
            throw new ProviderNotSupportedException();
        }

        $providerClass = $providers[$providerName];
        $settings = (array) $this->config->path("auth.oauth2.config.$providerName", []);

        $provider = $this->getDI()->get($providerClass, [$settings]);
        $client = $this->getDI()->get(Client::class, [$providerName, $provider]);

        return $client;
    }
}
