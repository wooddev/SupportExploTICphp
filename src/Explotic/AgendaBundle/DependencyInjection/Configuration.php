<?php

namespace Explotic\AgendaBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('explotic_agenda');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->arrayNode('booking_types')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('context')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('status_options')
                            ->isRequired()
                            ->requiresAtLeastOneElement()                               
                                ->prototype('scalar')->isRequired()->end()                                
                            ->end()                            
                            ->scalarNode('default_status')->isRequired()->end()
                            ->scalarNode('booking_class')
                                ->isRequired()
                                ->defaultValue('rdv')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;    
        
        return $treeBuilder;
    }
}
