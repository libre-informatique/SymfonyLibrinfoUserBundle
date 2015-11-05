<?php

namespace Librinfo\UserBundle\DependencyInjection;

use Librinfo\CoreBundle\DependencyInjection\DefaultParameters;
use Librinfo\CoreBundle\DependencyInjection\LibrinfoCoreExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LibrinfoUserExtension extends LibrinfoCoreExtension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        if($container->getParameter('kernel.environment') == 'test')
        {
            if(!$container->hasParameter('librinfo.datafixtures')){
                $container->setParameter('librinfo.datafixtures', array());
            }
            $this->mergeParameter('librinfo.datafixtures', $container, __DIR__.'/../Resources/config/','datafixtures.yml');
        }

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

    }
}
