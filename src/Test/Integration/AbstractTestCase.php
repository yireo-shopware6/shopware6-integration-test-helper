<?php declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Test\Integration;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertBundleIsInstalled;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertEntityExtensionExists;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertServiceExists;

abstract class AbstractTestCase extends TestCase
{
    use IntegrationTestBehaviour;
    use AssertBundleIsInstalled;
    use AssertServiceExists;
    use AssertEntityExtensionExists;

    abstract public function getPluginName(): string;
}
