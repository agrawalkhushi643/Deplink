<?php

namespace Deplink\Repository\Tests\Context;

use Behat\Behat\Tester\Exception\PendingException;
use Deplink\Repository\Tests\Traits\Browser;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\Assert;

class BrowserContext extends BaseContext
{
    use Browser;

    /**
     * @When I visit page :url
     * @param string $url
     */
    public function iAmOnPage($url)
    {
        // Remove leading slashes
        while (isset($url[0]) && $url[0] === '/') {
            $url = substr($url, 1);
        }

        self::$webDriver->get("{$this->getHost()}/$url");
    }

    /**
     * @Then There should be link to page :url
     * @throws \PHPUnit_Framework_AssertionFailedError
     */
    public function thereShouldBeLinkTo($url)
    {
        $link = self::$webDriver->findElement(WebDriverBy::cssSelector("a[href='$url']"));
        Assert::assertTrue($link->isDisplayed());
    }

    /**
     * @Then There should not be link to page :url
     * @throws \PHPUnit_Framework_AssertionFailedError
     */
    public function thereShouldNotBeLinkToPage($url)
    {
        try {
            self::$webDriver->findElement(WebDriverBy::cssSelector("a[href='$url']"));
        } catch (NoSuchElementException $e) {
            return; // It's ok, element should not exists
        }

        Assert::fail("Element a[href='$url'] found on page, but should not exists.");
    }

    /**
     * @Given Take screenshot named :name
     */
    public function takeScreenshotNamed($name)
    {
        self::$webDriver->takeScreenshot(__DIR__ . "/../../screenshots/$name.jpg");
    }
}
