<?php
  namespace Ddnet\GithubBundle\Github;
  
  use Ddnet\GithubBundle\Github\Client;
//  use Symfony\Component\DependencyInjection\ContainerAwareInterface;
  
  class Github extends Client { //implements ContainerAwareInterface {
    public function __construct(array $options = array()) {
      parent::construct($options);
    }    
  }