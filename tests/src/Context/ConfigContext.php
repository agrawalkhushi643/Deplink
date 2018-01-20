<?php

namespace Deplink\Repository\Tests\Context;

use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;

class ConfigContext extends BaseContext
{
    /**
     * @Given server has configuration:
     * @param PyStringNode $config
     * @throws \PHPUnit_Framework_Exception
     */
    public function serverHasConfiguration(PyStringNode $config)
    {
        $configFile = __DIR__ . '/../../../.env.tests';
        file_put_contents($configFile, $config->getRaw());
        Assert::assertFileExists($configFile);
    }
}
