<?php declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Test\Integration\Traits;

use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;

trait AssertServiceExists
{
    use IntegrationTestBehaviour;

    public function assertServiceExists(string $serviceId)
    {
        $container = $this->getContainer();
        $service = $container->get($serviceId);
        $this->assertTrue(is_object($service));
    }
}
