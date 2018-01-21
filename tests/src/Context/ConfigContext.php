<?php

namespace Deplink\Repository\Tests\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;

class ConfigContext implements Context
{
    const ENV_FILE = '.env';
    const ENV_BACKUP_FILE = '.env.backup';

    /**
     * @BeforeSuite
     */
    public static function prepare()
    {
        if(file_exists(self::ENV_FILE)) {
            rename(self::ENV_FILE, self::ENV_BACKUP_FILE);
        }
    }

    /**
     * @Given server has configuration:
     * @param PyStringNode $config
     * @throws \PHPUnit_Framework_Exception
     */
    public function serverHasConfiguration(PyStringNode $config)
    {
        file_put_contents(self::ENV_FILE, $config->getRaw());
        Assert::assertFileExists(self::ENV_FILE);
    }

    /**
     * @AfterSuite
     */
    public static function cleanup()
    {
        if(file_exists(self::ENV_BACKUP_FILE)) {
            rename(self::ENV_BACKUP_FILE, self::ENV_FILE);
        }
    }
}
