<?php declare(strict_types=1);

namespace Yireo\IntegrationTestHelper\Traits;

use Shopware\Core\Framework\DataAbstractionLayer\ExtensionRegistry;

trait AssertEntityExtensionExists
{
    public function assertEntityExtensionExists(string $entityExtensionClass)
    {
        $container = $this->getContainer();
        $extensionRegistry = $container->get(ExtensionRegistry::class);
        $entityExtensions = $extensionRegistry->getExtensions();

        $entityExtensionFound = false;
        foreach ($entityExtensions as $entityExtension) {
            if ($entityExtension instanceof $entityExtensionClass) {
                $entityExtensionFound = true;
            }
        }

        $message = 'Entity extension with class "'.$entityExtensionClass.'" is not found';
        $this->assertTrue($entityExtensionFound, $message);
    }
}