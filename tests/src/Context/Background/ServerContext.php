<?php

namespace Deplink\Repository\Tests\Context\Background;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use PHPUnit_Framework_AssertionFailedError;
use Symfony\Component\Process\Process;

class ServerContext implements Context
{
    /**
     * @var string
     */
    protected static $host = 'localhost:8001';

    /**
     * @var Process
     */
    protected static $server;

    /**
     * @BeforeSuite
     * @throws PHPUnit_Framework_AssertionFailedError
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    public static function start()
    {
        $host = self::$host;
        $prefix = self::onWindows() ? '' : 'exec';

        self::$server = new Process("$prefix php -S $host tests/server.php");
        self::$server->start();
    }

    /**
     * Determine if test is running on Windows.
     *
     * @return bool
     */
    protected static function onWindows()
    {
        return PHP_OS === 'WINNT';
    }

    /**
     * @AfterSuite
     */
    public static function stop()
    {
        self::$server->stop();
    }
}
