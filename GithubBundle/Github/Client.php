<?php
  namespace Ddnet\GithubBundle\Github\Client;

  use Ddnet\GithubBundle\Github\HttpClientInterface;
  use Ddnet\GithubBundle\Github\HttpClient\Curl as HttpClientCurl;
  use Ddnet\GithubBundle\Github\Api\User as ApiUser;
  use Ddnet\GithubBundle\Github\Api\Issue as ApiIssue;
  use Ddnet\GithubBundle\Github\Api\Commit as ApiCommit;
  use Ddnet\GithubBundle\Github\Api\Object as ApiObject;
  use Ddnet\GithubBundle\Github\Api\Organization as ApiOrganization;
  use Ddnet\GithubBundle\Github\Api\PullRequest as ApiPullRequest;
  use Ddnet\GithubBundle\Github\Api\Repository as ApiRepository;
  use Ddnet\GithubBundle\Github\Api\User as ApiUser;  
  
  use Symfony\Component\DependencyInjection\ContainerAwareInterface;
  
  class Client implements ContainerAwareInterface {
    /**
     * The httpClient instance used to communicate with GitHub
     *
     * @var HttpClientInterface
     */
    protected $httpClient = null;

    /**
     * The list of loaded API instances
     *
     * @var array
     */
    protected $apis = array();

    protected $container; 
    
    /**
     * Instanciate a new GitHub client
     *
     * @param  HttpClientInterface $httpClient custom http client
     */
    public function __construct(HttpClientInterface $httpClient = null, ContainerAwareInterface $container = null) {
      $this->container = $container;
      if(null == $httpClient)
        $this->httpClient = new HttpClientCurl();
      else
        $this->httpClient = $httpClient;        
    }
    
    public function setContainer(ContainerAwareInterface $container) {
      $this->container = $container;
    }

    /**
     * Authenticate a user for all next requests
     *
     * @param  string         $login      GitHub username
     * @param  string         $secret     GitHub private token or Github password if $method == AUTH_HTTP_PASSWORD
     * @param  string         $method     One of the AUTH_* class constants
     *
     * @return null
     */
    public function authenticate($login, $secret, $method = NULL) {
      if(!$method)  $method = $this->container->getParameter('github.auth_url_token');       

      $this->getHttpClient()
                ->setOption('auth_method', $method)
                ->setOption('login', $login)
                ->setOption('secret', $secret);
    }

    /**
     * Deauthenticate a user for all next requests
     *
     * @return null
     */
    public function deAuthenticate() {
      $this->authenticate(null, null, null);
    }

    /**
     * Call any path, GET method
     * Ex: $api->get('repos/show/my-username/my-repo')
     *
     * @param   string  $path            the GitHub path
     * @param   array   $parameters       GET parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    public function get($path, array $parameters = array(), $requestOptions = array()) {
      return $this->getHttpClient()->get($path, $parameters, $requestOptions);
    }

    /**
     * Call any path, POST method
     * Ex: $api->post('repos/show/my-username', array('email' => 'my-new-email@provider.org'))
     *
     * @param   string  $path            the GitHub path
     * @param   array   $parameters       POST parameters
     * @param   array   $requestOptions   reconfigure the request
     * @return  array                     data returned
     */
    public function post($path, array $parameters = array(), $requestOptions = array()) {
      return $this->getHttpClient()->post($path, $parameters, $requestOptions);
    }

    /**
     * Get the http client.
     *
     * @return  HttpClientInterface   a request instance
     */
    public function getHttpClient() {
      return $this->httpClient;
    }

    /**
     * Inject another http client
     *
     * @param   HttpClientInterface   a httpClient instance
     *
     * @return  null
     */
    public function setHttpClient(HttpClientInterface $httpClient) {
      $this->httpClient = $httpClient;
    }

    /**
     * Get the user API
     *
     * @return  ApiUser    the user API
     */
    public function getUserApi() {
      if(!isset($this->apis['user']))
        $this->apis['user'] = new ApiUser($this);
      return $this->apis['user'];
    }

    /**
     * Get the issue API
     *
     * @return  ApiIssue   the issue API
     */
    public function getIssueApi() {
      if(!isset($this->apis['issue']))
        $this->apis['issue'] = new ApiIssue($this);
      return $this->apis['issue'];
    }

    /**
     * Get the commit API
     *
     * @return  ApiCommit  the commit API
     */
    public function getCommitApi() {
      if(!isset($this->apis['commit']))
        $this->apis['commit'] = new ApiCommit($this);
      return $this->apis['commit'];
    }

    /**
     * Get the repo API
     *
     * @return  ApiRepository  the repo API
     */
    public function getRepositoryApi() {
      if(!isset($this->apis['repository']))
        $this->apis['repository'] = new ApiRepository($this);
      return $this->apis['repository'];
    }

    /**
     * Get the organization API
     *
     * @return  Github_Api_Organization  the object API
     */
    public function getOrganizationApi() {
      if(!isset($this->apis['organization']))
        $this->apis['organization'] = new ApiOrganization($this);
      return $this->apis['organization'];
    }

    /**
     * Get the object API
     *
     * @return  Github_Api_Object  the object API
     */
    public function getObjectApi() {
      if(!isset($this->apis['object']))
        $this->apis['object'] = new ApiObject($this);
      return $this->apis['object'];
    }

    /**
     * Get the pull request API
     *
     * @return  Github_Api_PullRequest  the pull request API
     */
    public function getPullRequestApi() {
      if(!isset($this->apis['pullrequest']))
        $this->apis['pullrequest'] = new ApiPullRequest($this);
      return $this->apis['pullrequest'];
    }

    /**
     * Inject an API instance
     *
     * @param   string                $name the API name
     * @param   Github_ApiInterface  $api  the API instance
     *
     * @return  null
     */
    public function setApi($name, ApiInterface $instance) {
      $this->apis[$name] = $instance;

      return $this;
    }

    /**
     * Get any API
     *
     * @param   string                $name the API name
     * @return  Github_ApiInterface  the API instance
     */
    public function getApi($name) {
      return $this->apis[$name];
    }
}