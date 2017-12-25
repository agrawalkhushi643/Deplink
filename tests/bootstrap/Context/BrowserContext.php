<?php

namespace Deplink\Repository\Tests\Context;

use Behat\Behat\Tester\Exception\PendingException;
use Deplink\Repository\Tests\Traits\Browser;
use Facebook\WebDriver\WebDriverBy;
use Webmozart\Assert\Assert;

class BrowserContext extends BaseContext
{
    use Browser;

    /**
     * @Given I am on page :url
     * @param string $url
     */
    public function iAmOnPage($url)
    {
        // Remove leading slashes
        while(isset($url[0]) && $url[0] === '/') {
            $url = substr($url, 1);
        }

        $this->webDriver->get("{$this->host}/$url");
    }

    /**
     * @Then There should be link to page :url
     */
    public function thereShouldBeLinkTo($url)
    {
        $link = $this->webDriver->findElement(WebDriverBy::cssSelector("a[href='$url']"));
        Assert::true($link->isDisplayed());
    }
}
