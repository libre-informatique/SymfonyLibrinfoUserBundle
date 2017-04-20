<?php

namespace Librinfo\UserBundle\DependencyInjection;

use Blast\CoreBundle\DependencyInjection\DefaultParameters;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;
use Blast\CoreBundle\DependencyInjection\BlastCoreExtension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LibrinfoUserExtension extends BlastCoreExtension
{
    /**
     * {@inheritdoc}
     */
    public function loadDataFixtures(ContainerBuilder $container, FileLoader $loader)
    {
        if ($container->getParameter('kernel.environment') == 'test')
        {
            $loader->load('datafixtures.yml');
        }
        
    }
    
    public function doLoad(ContainerBuilder $container, FileLoader $loader, array $config)
    {
        $bundleConfigDir = __DIR__ . '/../Resources/config/bundles/';

        $bundlesConfigFiles = scandir($bundleConfigDir);

        foreach ($bundlesConfigFiles as $file)
        {
            if (pathinfo($bundleConfigDir . $file)['extension'] == "yml")
            {
                $configFile = Yaml::parse(
                    file_get_contents($bundleConfigDir . $file)
                );

                DefaultParameters::getInstance($container)
                    ->defineDefaultConfiguration(
                        $configFile['default']
                    );
            }
        }
        return $this;
    }
    
    public function loadSecurity(ContainerBuilder $container)
    {
        if (class_exists('\Librinfo\SecurityBundle\Configurator\SecurityConfigurator'))
            \Librinfo\SecurityBundle\Configurator\SecurityConfigurator::getInstance($container)->loadSecurityYml(__DIR__ . '/../Resources/config/security.yml');
        return $this;
    }
}
