<?php

namespace Deplink\Repository\Tests\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;

class ConfigContext implements Context
{
    /**
     * @Given server has configuration:
     * @param PyStringNode $config
     * @throws \PHPUnit_Framework_Exception
     */
    public function serverHasConfiguration(PyStringNode $config)
    {
        $configFile = '.env.tests';
        file_put_contents($configFile, $config->getRaw());
        Assert::assertFileExists($configFile);
    }
    /**
     * @AfterSuite
     */
    public static function cleanup()
    {
        unlink('.env.tests');
    }
}
