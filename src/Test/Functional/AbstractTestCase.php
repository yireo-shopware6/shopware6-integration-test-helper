<?php declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Test\Functional;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Yireo\IntegrationTestHelper\Test\Functional\Traits\AssertBundleIsInstalled;
use Yireo\IntegrationTestHelper\Test\Functional\Traits\AssertEntityExtensionExists;
use Yireo\IntegrationTestHelper\Test\Functional\Traits\AssertServiceExists;

abstract class AbstractTestCase extends TestCase
{
    use AssertBundleIsInstalled;
    use AssertServiceExists;
    use AssertEntityExtensionExists;

    abstract public function getPluginName(): string;

    public function getContainer(): ContainerInterface
    {
        return KernelRegistry::getInstance()->getKernel()->getKernel()->getContainer();
    }

    protected function getAnyProduct(?Criteria $criteria = null): ProductEntity
    {
        /** @var EntityRepository $productRepository */
        $productRepository = $this->getContainer()->get('product.repository');
        if ($criteria === null) {
            $criteria = new Criteria();
        }

        $result = $productRepository->search($criteria, Context::createDefaultContext());

        return $result->first();
    }
}
