<?php declare(strict_types=1);

use Shopware\Core\TestBootstrapper;

$activePlugins = [];
//$activePlugins[] = 'YireoIntegrationTestHelper';

$envAdditionalPlugins = $_ENV['FORCE_INSTALL_ADDITIONAL_PLUGINS'] ?? false;
if ($envAdditionalPlugins) {
    $activePlugins = array_merge($activePlugins, explode(',', $envAdditionalPlugins));
}

echo "Active plugins: ".implode(', ', $activePlugins)."\n";

$testBootstrapper = (new TestBootstrapper())
    ->addActivePlugins(...$activePlugins)
    ->addCallingPlugin()
;

if (isset($_ENV['FORCE_INSTALL']) && (bool)$_ENV['FORCE_INSTALL'] === true) {
    echo "Forcing installation\n";
    $testBootstrapper->setForceInstall(true);
}

if (isset($_ENV['FORCE_INSTALL_PLUGINS']) && (bool)$_ENV['FORCE_INSTALL_PLUGINS'] === true) {
    echo "Forcing plugin install\n";
    $testBootstrapper->setForceInstallPlugins(true);
}

$testBootstrapper->bootstrap();