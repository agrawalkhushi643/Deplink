<?php

namespace Deplink\Repository\App\Services;

use Phalcon\DiInterface;

/**
 * Classes which requires an access to the DI containers must
 * implements the \Phalcon\Di\InjectionAwareInterface interface.
 *
 * Use this trait along with the InjectionAwareInterface interface
 * to provide default behavior for DI container. Use $this->getDI()
 * method to access DI container provided by the trait or access
 * directly via predefined properties (list below).
 *
 * @property \Phalcon\Mvc\Dispatcher|\Phalcon\Mvc\DispatcherInterface $dispatcher
 * @property \Phalcon\Mvc\Router|\Phalcon\Mvc\RouterInterface $router
 * @property \Phalcon\Mvc\Url|\Phalcon\Mvc\UrlInterface $url
 * @property \Phalcon\Http\Request|\Phalcon\Http\RequestInterface $request
 * @property \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface $response
 * @property \Phalcon\Http\Response\Cookies|\Phalcon\Http\Response\CookiesInterface $cookies
 * @property \Phalcon\Filter|\Phalcon\FilterInterface $filter
 * @property \Phalcon\Flash\Direct $flash
 * @property \Phalcon\Flash\Session $flashSession
 * @property \Phalcon\Session\Adapter\Files|\Phalcon\Session\Adapter|\Phalcon\Session\AdapterInterface $session
 * @property \Phalcon\Events\Manager|\Phalcon\Events\ManagerInterface $eventsManager
 * @property \Phalcon\Db\AdapterInterface $db
 * @property \Phalcon\Security $security
 * @property \Phalcon\Crypt|\Phalcon\CryptInterface $crypt
 * @property \Phalcon\Tag $tag
 * @property \Phalcon\Escaper|\Phalcon\EscaperInterface $escaper
 * @property \Phalcon\Annotations\Adapter\Memory|\Phalcon\Annotations\Adapter $annotations
 * @property \Phalcon\Mvc\Model\Manager|\Phalcon\Mvc\Model\ManagerInterface $modelsManager
 * @property \Phalcon\Mvc\Model\MetaData\Memory|\Phalcon\Mvc\Model\MetadataInterface $modelsMetadata
 * @property \Phalcon\Mvc\Model\Transaction\Manager|\Phalcon\Mvc\Model\Transaction\ManagerInterface $transactionManager
 * @property \Phalcon\Assets\Manager $assets
 * @property \Phalcon\Di|\Phalcon\DiInterface $di
 * @property \Phalcon\Session\Bag|\Phalcon\Session\BagInterface $persistent
 * @property \Phalcon\Mvc\View|\Phalcon\Mvc\ViewInterface $view
 * @property \Phalcon\Logger\Adapter $logger
 */
trait DefaultInjection
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * Sets the dependency injector
     *
     * @param DiInterface $di
     */
    public function setDI(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }

    /**
     * @param string $name Service name.
     * @return mixed
     */
    public function __get($name)
    {
        return $this->getDI()->get($name);
    }
}
