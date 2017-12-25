<?php

namespace Deplink\Repository\Tests\Traits;

use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
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
    private $host = 'localhost:8000';

    /**
     * @var Process
     */
    protected $server;

    /**
     * @var Process
     */
    protected $browser;

    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;

    /**
     * @BeforeScenario
     * @param BeforeScenarioScope $event
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public function before(BeforeScenarioScope $event)
    {
        try {
            $this->startServer();
            $this->startBrowser();
            $this->startWebDriver();
        } catch (\Exception $e) {
            Assert::fail($e->getMessage());
        }
    }

    /**
     * @throws PHPUnit_Framework_AssertionFailedError
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    private function startServer()
    {
        $this->server = new Process("php -S {$this->host} tests/server.php");
        $this->server->start();
        Assert::assertTrue($this->server->isRunning());
    }

    /**
     * @throws PHPUnit_Framework_AssertionFailedError
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    private function startBrowser()
    {
        $chromeDriver = "tests/bin/chromedriver-linux";
        if ($this->onWindows()) {
            $chromeDriver = "tests\bin\chromedriver-win.exe";
        } else if ($this->onMac()) {
            $chromeDriver = "tests/bin/chromedriver-mac";
        }

        $this->browser = new Process($chromeDriver);
        $this->browser->start();
        Assert::assertTrue($this->browser->isRunning());
    }

    private function startWebDriver()
    {
        $this->webDriver = RemoteWebDriver::create('http://localhost:9515', DesiredCapabilities::chrome());
    }

    /**
     * Determine if Dusk is running on Windows.
     *
     * @return bool
     */
    protected function onWindows()
    {
        return PHP_OS === 'WINNT';
    }
    /**
     * Determine if Dusk is running on Mac.
     *
     * @return bool
     */
    protected function onMac()
    {
        return PHP_OS === 'Darwin';
    }

    /**
     * @AfterScenario
     * @param AfterScenarioScope $event
     */
    public function after(AfterScenarioScope $event)
    {
        $this->webDriver->close();
        $this->browser->stop();
        $this->server->stop();
    }
}
