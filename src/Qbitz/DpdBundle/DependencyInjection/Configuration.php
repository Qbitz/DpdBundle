<?php

namespace Qbitz\DpdBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('qbitz_dpd');

        $rootNode->children()
            ->scalarNode('wsdl')
                ->isRequired()
                ->defaultNull()
            ->end()
            ->scalarNode('login')
                ->isRequired()
                ->defaultNull()
            ->end()
            ->scalarNode('password')
                ->isRequired()
                ->defaultNull()
            ->end()
            ->scalarNode('fid')
                ->isRequired()
                ->defaultNull()
            ->end()
            ->scalarNode('output_dir')
                ->isRequired()
                ->defaultNull()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
