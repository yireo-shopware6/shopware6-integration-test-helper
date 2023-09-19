# YireoIntegrationTestHelper

**Shopware 6 plugin and library to help you build PHPUnit-based integration tests easier**

## Features
- Custom PHPUnit bootstrap
  - Support for various environment variables
- Various PHP traits
  - `assertBundleIsInstalled(string $bundleName)`
  - `assertServiceExists(string $serviceId)`
  - `assertEntityExtensionExists(string $entityExtensionClass)`
- PHP class `\Yireo\IntegrationTestHelper\Test\Integration\AbstractTestCase`
  - Includes all PHP traits already

## Installation
Install this plugin and activate it:
```bash
composer require yireo/shopware6-integration-test-helper --dev
bin/console plugin:refresh
bin/console plugin:install --activate YireoIntegrationTestHelper
```

## PHPUnit configuration
Next, configure your PHPUnit file to use the file `vendor/yireo/shopware6-integration-test-helper/src/test_bootstrap.php` as a bootstrap. Also configure the `DATABASE_URL` (pointing to a different database than your regular Shopware database).

An example PHPUnit file is here:
```xml
<?xml version="1.0" encoding="UTF-8"?>

<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.2/phpunit.xsd"
         bootstrap="vendor/yireo/shopware6-integration-test-helper/src/test_bootstrap.php"
         colors="true" cacheResult="false">
    <php>
        <ini name="error_reporting" value="E_ALL"/>
        <server name="KERNEL_CLASS" value="Shopware\Core\Kernel"/>
        <env name="FORCE_INSTALL" value="1"/>
        <env name="FORCE_INSTALL_PLUGINS" value="1"/>
        <env name="FORCE_INSTALL_ADDITIONAL_PLUGINS" value="YireoExample"/>
        <env name="APP_ENV" value="test"/>
        <env name="APP_DEBUG" value="1"/>
        <env name="APP_SECRET" value="s$cretf0rt3st"/>
        <env name="SHELL_VERBOSITY" value="-1"/>
        <env name="SYMFONY_DEPRECATIONS_HELPER" value="disabled" />
        <env name="LOCK_DSN" value="flock" />
        <env name="DATABASE_URL" value="mysql://root:root@mysql:3306/shopware6_test" />
    </php>
</phpunit>
```

Instead of using the PHPUnit file for this, you could also add the environment variables to a file `.env.test` instead.

- When `FORCE_INSTALL` is `1`, Shopware will do a reinstallation;
- When `FORCE_INSTALL_PLUGINS` is `1`, plugins will be refreshed, installed and activated;
- When `FORCE_INSTALL_ADDITIONAL_PLUGINS` contains a comma-separate list of plugins, each plugin will be installed and activated. Make sure to include at least your own plugin (in this example `YireoExample`);

## Usage of PHP parent class
```php
namespace Swag\Example\Test\Integration;

use Yireo\IntegrationTestHelper\Test\Integration\AbstractTestCase;

class BasicPluginTest extends AbstractTestCase
{
    public function testIfBundleIsRegistered()
    {
        $this->assertBundleIsInstalled();
    }
}
```

## Usage of PHP traits
```php
namespace Swag\Example\Test\Integration;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Yireo\IntegrationTestHelper\Traits\AssertBundleIsInstalled;

class BasicPluginTest extends TestCase
{
    use IntegrationTestBehaviour;
    use AssertBundleIsInstalled;
    
    public function getName(): string
    {
        return self::class; // Shopware 6.5 requires you to implement this method
    }
   
    public function testIfBundleIsRegistered()
    {
        $this->assertBundleIsInstalled();
    }
}
```