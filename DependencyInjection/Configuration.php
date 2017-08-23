<?php

/*
 * This file is part of the PhpMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpMob\TwigModifyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('phpmob_twig_modify');

        $rootNode
            ->children()
                ->scalarNode('enabled')->defaultValue(true)->end()
                ->scalarNode('cache')->defaultValue(null)->end()
            ->end()
            ->children()
                ->arrayNode('modifiers')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->variableNode('class')->cannotBeEmpty()->end()
                            ->variableNode('method')->cannotBeEmpty()->defaultValue('modify')->end()
                            ->variableNode('options')->cannotBeEmpty()->defaultValue([])->end()
                            ->variableNode('enabled')->cannotBeEmpty()->defaultValue(true)->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
