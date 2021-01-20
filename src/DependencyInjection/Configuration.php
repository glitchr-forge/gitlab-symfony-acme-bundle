<?php

// src/Acme/SocialBundle/DependencyInjection/Configuration.php
namespace Acme\AcmeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('acme_bundle');
        $rootNode = $treeBuilder->getRootNode();

        $this->addGlobalOptionsSection($rootNode);

        return $treeBuilder;
    }


    private function addGlobalOptionsSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->scalarNode('foo')
                    ->defaultValue('bar')
                    ->info('Test section.')
                ->end()
            ->end()
        ;
    }
}