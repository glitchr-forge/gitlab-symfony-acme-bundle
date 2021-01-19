<?php

namespace Acme\AcmeBundle\DependencyInjection;

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
        $loader = new XmlFileLoader($container, new FileLocator(\dirname(__DIR__, 2).'/config'));
        $loader->load('controllers.xml');
        $loader->load('services.xml');

        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $container->setDefinition('acme.builder', new Definition(AcmeBuilder::class))->setPublic(false);
        $container->setAlias(AcmeBuilderInterface::class, 'acme.builder')->setPublic(false);

        if (class_exists(Environment::class)) {

            $container
                ->setDefinition('acme.twig_extension', new Definition(AcmeExtension::class))
                ->addTag('twig.extension')
                ->setPublic(false)
            ;
        }
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
