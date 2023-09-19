<?php declare(strict_types=1);

use Shopware\Core\TestBootstrapper;

$envAdditionalPlugins = $_ENV['FORCE_INSTALL_ADDITIONAL_PLUGINS'] ?? '';

$activePlugins = [];
$activePlugins[] = 'YireoIntegrationTestHelper';
$activePlugins = array_merge($activePlugins, explode(',', $envAdditionalPlugins));

$testBootstrapper = (new TestBootstrapper())
    ->addActivePlugins(...$activePlugins)
    ->addCallingPlugin()
;

if (isset($_ENV['FORCE_INSTALL']) && (bool)$_ENV['FORCE_INSTALL'] === true) {
    $testBootstrapper->setForceInstall(true);
}

if (isset($_ENV['FORCE_INSTALL_PLUGINS']) && (bool)$_ENV['FORCE_INSTALL_PLUGINS'] === true) {
    $testBootstrapper->setForceInstallPlugins(true);
}

$testBootstrapper->bootstrap();