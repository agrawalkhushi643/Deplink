<?php

namespace Deplink\Repository\App\Services;

use Phalcon\DiInterface;

/**
 * Classes which requires an access to the DI containers must
 * implements the \Phalcon\Di\InjectionAwareInterface interface.
 *
 * Use this trait along with the InjectionAwareInterface interface
 * to provide default behavior for DI container. Use $this->getDI()
 * method to access DI container provided by the trait.
 *
 * Alternatively you can extends the \Phalcon\Di\Injectable class.
 */
trait Injectable
{
    /**
     * @var DiInterface
     */
    private $di;

    /**
     * Sets the dependency injector.
     *
     * @param DiInterface $di
     */
    public function setDI(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * Returns the internal dependency injector.
     *
     * @return DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }
}
