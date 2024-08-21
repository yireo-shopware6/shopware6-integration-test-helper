<?php
declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Test\Functional;

use Shopware\Core\HttpKernel;

class KernelRegistry
{
    private static $instances = [];
    private HttpKernel $kernel;

    static public function getInstance(): KernelRegistry
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function setKernel(HttpKernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getKernel(): HttpKernel
    {
        return $this->kernel;
    }
}
