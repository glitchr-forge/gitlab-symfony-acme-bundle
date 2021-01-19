<?php

namespace Acme\AcmeBundle\DependencyInjection;
use Acme\AcmeBundle\Service\AcmeService;

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
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        //
        // Alias declaration
        $container->setAlias(AcmeService::class, 'acme.service')->setPublic(false);
        $container->setAlias(AcmeController::class, 'acme.controller')->setPublic(false);
    }

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        if (!isset($bundles['AcmeGoodbyeBundle'])) {

            $config = ['use_acme_goodbye' => false];
            foreach ($container->getExtensions() as $name => $extension) {
                switch ($name) {
                    case 'acme_something':
                    case 'acme_other':
                        $container->prependExtensionConfig($name, $config);
                        break;
                }
            }
        }

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);
        if (isset($config['entity_manager_name'])) {
            $config = ['entity_manager_name' => $config['entity_manager_name']];
            $container->prependExtensionConfig('acme_something', $config);
        }
    }
}
