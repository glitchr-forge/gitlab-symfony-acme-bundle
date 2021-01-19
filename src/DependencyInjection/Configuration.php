<?php

// src/Acme/SocialBundle/DependencyInjection/Configuration.php
namespace Acme\AcmeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder("acme");

        $builder->getRootNode()
            ->children()
                ->scalarNode('foo')->end()
                ->scalarNode('bar')->end()
            ->end();

        return $builder;
    }
}