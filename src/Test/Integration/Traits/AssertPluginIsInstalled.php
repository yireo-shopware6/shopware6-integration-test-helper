<?php declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Traits;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;

trait AssertPluginIsInstalled
{
    use IntegrationTestBehaviour;

    public function assertPluginIsInstalled(?string $pluginName = null)
    {
        if (empty($pluginName)) {
            $pluginName = $this->getPluginName();
        }

        $container = $this->getContainer();
        $pluginRepository = $container->getParameter('plugin.repository');
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('name', $pluginName));
        $result = $pluginRepository->search($criteria, Context::createDefaultContext());
        $plugin = $result->first();
        $this->assertNotEmpty($plugin, 'Plugin is not installed');
        $this->assertEquals('1', $plugin->getActive(), 'Plugin is not activated');
    }
}
