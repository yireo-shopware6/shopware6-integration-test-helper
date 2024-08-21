<?php declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Test\Functional\Traits;

trait AssertServiceExists
{
    public function assertServiceExists(string $serviceId)
    {
        $container = $this->getContainer();
        $service = $container->get($serviceId);
        $this->assertTrue(is_object($service));
    }
}
