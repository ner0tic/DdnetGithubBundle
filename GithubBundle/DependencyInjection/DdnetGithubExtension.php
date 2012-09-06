<?php

namespace Ddnet\GithubBundle\DependencyInjection;

use Symfony\Component\Config\Handler\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFilerLoader;

class DdnetGithubExtension extends Extension {
  protected $resources = array(
      'github'    =>  'github.yml',
//      'security'  =>  'security,yml',
  );
  
  /**
   * {@inheritDoc}
   */
  public function load(array $configs, ContainerBuilder $container) {
    $processor = new Processor();
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);
    
    $this->loadDefaults($container);
    
    if(isset($configs['alias']))
      $container->setAlias($config['alias'], 'ddnet_github_api');
    
    foreach(array('api', 'helper', 'twig') as $attr)
      $container->setParameter('ddnet_github.'.$attr.'.class', $config['class'][$attr]);
    
    $container->setParameter('github.auth_url_token', $config['auth_url_token']);
    $container->setParameter('github.auth_http_password', $config['auth_http_password']);
    $container->setParameter('github.auth_http_token', $config['auth_http_token']);
  }
  
  public function loadDefaults($container) {
    $loader = new YamlLoader($caontainer, new FileLocator(__DIR__.'/../Resources/config'));
    
    foreach($this->resources as $resource)
      $loader->load($resource);
  }
}