<?php

namespace Acme\AcmeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

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
        $loader->load('services.xml');

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
        // get all bundles
        $bundles = $container->getParameter('kernel.bundles');

        // determine if AcmeGoodbyeBundle is registered
        if (!isset($bundles['AcmeGoodbyeBundle'])) {

            // disable AcmeGoodbyeBundle in bundles
            $config = ['use_acme_goodbye' => false];
            foreach ($container->getExtensions() as $name => $extension) {
                switch ($name) {
                    case 'acme_something':
                    case 'acme_other':
                        // set use_acme_goodbye to false in the config of
                        // acme_something and acme_other
                        //
                        // note that if the user manually configured
                        // use_acme_goodbye to true in config/services.yaml
                        // then the setting would in the end be true and not false
                        $container->prependExtensionConfig($name, $config);
                        break;
                }
            }
        }

        // process the configuration of AcmeHelloExtension
        $configs = $container->getExtensionConfig($this->getAlias());
        // use the Configuration class to generate a config array with
        // the settings "acme_hello"
        $config = $this->processConfiguration(new Configuration(), $configs);

        // check if entity_manager_name is set in the "acme_hello" configuration
        if (isset($config['entity_manager_name'])) {
            // prepend the acme_something settings with the entity_manager_name
            $config = ['entity_manager_name' => $config['entity_manager_name']];
            $container->prependExtensionConfig('acme_something', $config);
        }
    }
}