<?php

namespace Deplink\Repository\Tests\Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
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

        self::$webDriver->get("{$this->getProtocol()}{$this->getHost()}/$url");
    }

    /**
     * @Then there should be link to page :url
     * @throws \PHPUnit_Framework_AssertionFailedError
     */
    public function thereShouldBeLinkTo($url)
    {
        $link = self::$webDriver->findElement(WebDriverBy::cssSelector("a[href='$url']"));
        Assert::assertTrue($link->isDisplayed());
    }

    /**
     * @Then there should not be link to page :url
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
     * @Given take screenshot named :name
     */
    public function takeScreenshotNamed($name)
    {
        self::$webDriver->takeScreenshot(__DIR__ . "/../../screenshots/$name.jpg");
    }

    /**
     * @Then I should be on page :url
     */
    public function iShouldBeOnPage($url)
    {
        $fullUrl = self::$webDriver->getCurrentURL();
        $urlComponents = parse_url($fullUrl);

        // Get path, query and fragment components
        // (omits the schema, host and port parts).
        $actual = $urlComponents['path'];

        // After the question mark (?)
        if(!empty($urlComponents['query'])) {
            $actual .= '?'. $urlComponents['query'];
        }

        // After the hashmark (#)
        if(!empty($urlComponents['fragment'])) {
            $actual .= '#'. $urlComponents['fragment'];
        }

        Assert::assertEquals($url, $actual);
    }

    /**
     * @Then I should see :code error page
     */
    public function iShouldSeeErrorPage($code)
    {
        throw new PendingException();
    }
}
