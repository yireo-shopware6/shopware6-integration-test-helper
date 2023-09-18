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

    protected function setUp(): void
    {
        $testBootstrapper = (new TestBootstrapper())
            ->addActivePlugins('YireoIntegrationTestHelper', $this->getPluginName())
            ->addCallingPlugin()
        ;

        if (isset($_ENV['FORCE_INSTALL']) && (bool)$_ENV['FORCE_INSTALL'] === true) {
            $testBootstrapper->setForceInstall(true);
        }

        if (isset($_ENV['FORCE_INSTALL_PLUGINS']) && (bool)$_ENV['FORCE_INSTALL_PLUGINS'] === true) {
            $testBootstrapper->setForceInstallPlugins(true);
        }

        $testBootstrapper->bootstrap();

        parent::setUp();
    }

    abstract public function getPluginName(): string;

    public function getName(): string
    {
        return self::class;
    }
}
