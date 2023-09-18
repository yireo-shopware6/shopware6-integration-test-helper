# YireoIntegrationTestHelper

**Shopware 6 plugin and library to help you build PHPUnit-based integration tests easier**

## Installation
```bash
composer require yireo/shopware6-integration-test-helper
```

## Features
- Various PHP traits
  - `assertBundleIsInstalled(string $bundleName)`
  - `assertServiceExists(string $serviceId)`
  - `assertEntityExtensionExists(string $entityExtensionClass)`
- PHP class `\Yireo\IntegrationTestHelper\Test\Integration\AbstractTestCase`
  - Includes all PHP traits already
  - Adds the calling plugin and `YireoIntegrationTestHelper` as active plugins
  - Adds `.env.test` flags: `FORCE_INSTALL` and `FORCE_INSTALL_PLUGINS`

## Usage of PHP parent class
```php
namespace Swag\Example\Test\Integration;

use Yireo\IntegrationTestHelper\Test\Integration\AbstractTestCase;

class BasicPluginTest extends AbstractTestCase
{
    public function getPluginName(): string
    {
        return 'SwagExample';
    }

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
        return self::class;
    }

    public function testIfBundleIsRegistered()
    {
        $this->assertBundleIsInstalled();
    }
}
```