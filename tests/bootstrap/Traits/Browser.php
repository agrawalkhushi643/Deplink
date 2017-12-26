<?php

namespace Deplink\Repository\Tests\Traits;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use PHPUnit\Framework\Assert;
use PHPUnit_Framework_AssertionFailedError;
use Symfony\Component\Process\Process;

trait Browser
{
    /**
     * @var string
     */
    private static $host = 'localhost:8000';

    /**
     * @var Process
     */
    protected static $server;

    /**
     * @var Process
     */
    protected static $browser;

    /**
     * @var RemoteWebDriver
     */
    protected static $webDriver;

    /**
     * @BeforeSuite
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function beforeSuite()
    {
        try {
            self::startServer();
            self::startBrowser();
            self::startWebDriver();
        } catch (\Exception $e) {
            Assert::fail($e->getMessage());
        }
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return self::$host;
    }

    /**
     * @throws PHPUnit_Framework_AssertionFailedError
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    private static function startServer()
    {
        $host = self::$host;

        self::$server = new Process("php -S $host tests/server.php");
        self::$server->start();

        Assert::assertTrue(self::$server->isRunning());
    }

    /**
     * @throws PHPUnit_Framework_AssertionFailedError
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    private static function startBrowser()
    {
        $chromeDriver = "tests/bin/chromedriver-linux";
        if (self::onWindows()) {
            $chromeDriver = "tests\bin\chromedriver-win.exe";
        } else if (self::onMac()) {
            $chromeDriver = "tests/bin/chromedriver-mac";
        }

        self::$browser = new Process($chromeDriver);
        self::$browser->start();

        Assert::assertTrue(self::$browser->isRunning());
    }

    private static function startWebDriver()
    {
        self::$webDriver = RemoteWebDriver::create('http://127.0.0.1:9515', DesiredCapabilities::chrome());
    }

    /**
     * Determine if Dusk is running on Windows.
     *
     * @return bool
     */
    protected static function onWindows()
    {
        return PHP_OS === 'WINNT';
    }
    /**
     * Determine if Dusk is running on Mac.
     *
     * @return bool
     */
    protected static function onMac()
    {
        return PHP_OS === 'Darwin';
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        self::$webDriver->manage()->deleteAllCookies();
    }

    /**
     * @AfterSuite
     */
    public static function afterSuite()
    {
        self::$webDriver->quit();
        self::$browser->stop();
        self::$server->stop();
    }
}
