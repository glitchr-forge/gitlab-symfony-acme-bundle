<?php

namespace Acme\Bundle\DependencyInjection;
use Acme\Bundle\Service\AcmeService;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AcmeExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */

    // This happens just before theload
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        if (!isset($bundles['AcmeBundle'])) {

            $config = ['acme_common_variable' => false];
            foreach ($container->getExtensions() as $name => $extension) {
                switch ($name) {
                    case 'acme_bundle1':
                    case 'acme_bundle2':
                        // Happens before the load of acme_bundle1,acme_bundle2
                        $container->prependExtensionConfig($name, $config);
                        break;
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        //
        // Load service declaration (includes services, controllers,..)

        // Format XML
        $loader = new XmlFileLoader($container, new FileLocator(\dirname(__DIR__, 2).'/config'));
        $loader->load('services.xml');

        // Format YAML
        //$loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        //$loader->load('services.yaml');

        // Format PHP
        //$loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        //$loader->load('services.php');

        //
        // Configuration file: ./config/package/acme_bundle.yaml
        $processor = new Processor();
        $configuration = new AcmeConfiguration();
        $config = $processor->processConfiguration($configuration, $configs);
        $this->setConfiguration($container, $config, $configuration->getTreeBuilder()->getRootNode()->getNode()->getName());

        //
        // Alias declaration
        $container->setAlias(AcmeService::class, 'acme.service')->setPublic(true);
        $container->setAlias(AcmeController::class, 'acme.controller')->setPublic(true);
    }

    public function setConfiguration(ContainerBuilder $container, array $config, $globalKey = "")
    {
             foreach($config as $key => $value) {

            if (!empty($globalKey)) $key = $globalKey.".".$key;

            if (is_array($value)) $this->setConfiguration($container, $value, $key);
            else {
                $container->setParameter($key, $value);
                //dump("Acme Bundle Debug / \"$key: $value\"");
            }
        }
    }
}
