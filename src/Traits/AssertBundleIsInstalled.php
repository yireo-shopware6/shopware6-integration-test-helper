<?php declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Traits;

use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;

trait AssertBundleIsInstalled
{
    use IntegrationTestBehaviour;

    public function assertBundleIsInstalled(?string $bundleName = null)
    {
        if (empty($bundleName)) {
            $bundleName = $this->getPluginName();
        }

        $container = $this->getContainer();
        $bundles = $container->getParameter('kernel.bundles');
        $message = "Existing bundles:\n".implode("\n", array_keys($bundles));
        $this->assertArrayHasKey($bundleName, $bundles, $message);
    }
}
