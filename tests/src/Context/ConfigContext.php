<?php

namespace Deplink\Repository\Tests\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;

/**
 * Handles the .env configuration file.
 *
 * Context overwrites the user defined .env file
 * and restore it at the end of the testing process.
 */
class ConfigContext implements Context
{
    const ENV_FILE = '.env';
    const ENV_BACKUP_FILE = '.env.backup';

    /**
     * Make copy of the original configuration.
     *
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
     * Restore the user defined .env file
     * (which was overwritten for testing).
     *
     * @AfterSuite
     */
    public static function cleanup()
    {
        if(file_exists(self::ENV_BACKUP_FILE)) {
            rename(self::ENV_BACKUP_FILE, self::ENV_FILE);
        }
    }
}
