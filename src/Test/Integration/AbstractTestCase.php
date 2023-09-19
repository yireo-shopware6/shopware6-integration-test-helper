<?php declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Test\Integration;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Shopware\Core\TestBootstrapper;
use Yireo\IntegrationTestHelper\Traits\AssertBundleIsInstalled;
use Yireo\IntegrationTestHelper\Traits\AssertEntityExtensionExists;
use Yireo\IntegrationTestHelper\Traits\AssertServiceExists;

abstract class AbstractTestCase extends TestCase
{
    use IntegrationTestBehaviour;
    use AssertBundleIsInstalled;
    use AssertServiceExists;
    use AssertEntityExtensionExists;

    abstract public function getPluginName(): string;

    public function getName(): string
    {
        return static::class;
    }
}
