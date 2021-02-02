<?php

// src/Acme/SocialBundle/DependencyInjection/Configuration.php
namespace Acme\AcmeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Configuration implements ConfigurationInterface
{
    private $treeBuilder;
    public function getTreeBuilder() { return $this->treeBuilder; }
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $this->treeBuilder = new TreeBuilder('acme_bundle');
        $rootNode = $this->treeBuilder->getRootNode();

        $this->addGlobalOptionsSection($rootNode);

        return $this->treeBuilder;
    }


    private function addGlobalOptionsSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->scalarNode('foo')
                    ->defaultValue('bar')
                    ->info('Test section.')
                ->end()
                ->arrayNode('gag')
                    ->addDefaultsIfNotSet()
                    ->children()
                    ->scalarNode('anvil')
                        ->defaultValue('0')
                        ->info('Anvil Weight')
                    ->end()
                ->end()
            ->end()
        ;
    }
}