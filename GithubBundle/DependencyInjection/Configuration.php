<?php

namespace Ddnet\GithubBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {
  /**
   * {@inheritDoc}
   */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('ddnet_github')
            ->children()
              ->variableNode('alias')->defaultNull()->end()
              ->variableNode('auth_url_token')->defaultValue('url_token')->end()
              ->variableNode('auth_http_password')->defaultValue('http_password')->end()
              ->variableNode('auth_http_token')->defaultValue('http_token')->end()
            ->end();
    return $treeBuilder;
  }
}