<?php 
  namespace Ddnet\GithubBundle\Entity;
  
  class Commit {
    protected $url;
    
    protected $sha;
    
    protected $author = array();
     
    protected $committer  = array();
    
    protected $message;
    
    protected $tree = array();
    
    protected $main_author = array();
    
    protected $main_committer = array();
    
    protected $parents = array();
    
    protected $stats = array();
    
    protected $files = array();  
    
    public function setUrl($url) { $this->url = $url; }
    public function getUrl() { return $this->url; }
    
    public function setSha($sha) { $this->sha = $sha; }
    public function getSha() { return $this->sha; }
    
    public function setAuthor(Array $author = array()) {
      array_merge($this->author, $author);
    }
    public function setAuthorName($name) { $this->author['name'] = $name; }
    public function setAuthorEmail($email) { $this->author['email'] = $email; }
    public function setAuthorDate($timestamp) { $this->author['timestamp'] = $timestamp; }
    public function getAuthor() { return $this->author; }
    public function getAuthorName() { return $this->author['name']; }
    public function getAuthorEmail() { return $this->author['email']; }
    public function getAuthorDate() { return $this->author['date']; }
    
    public function setCommitter(Array $committer = array()) {
      array_merge($this->committer, $committer);
    }
    public function setCommitterName($name) { $this->committer['name'] = $name; }
    public function setCommitterEmail($email) { $this->committer['email'] = $email; }
    public function setCommitterDate($timestamp) { $this->committer['timestamp'] = $timestamp; }
    public function getCommitter() { return $this->committer; }
    public function getCommitterName() { return $this->committer['name']; }
    public function getCommitterEmail() { return $this->committer['email']; }
    public function getCommitterDate() { return $this->committer['date']; }    
  
    public function setMessage($msg) { $this->message = $msg; }
    public function getMessage() { $this->message; }
    
    public function setTree($tree) {
      array_merge($this->tree, $tree);
    }
    public function setTreeUrl($url) { $this->tree['url'] = $url; }
    public function setTreeSha($sha) { $this->tree['sha'] = $sha; }
    public function getTree() { return $this->tree; }
    public function getTreeUrl() { return $this->tree['url']; }
    public function getTreeSha() { return $this->tree['sha']; }
    
    public function setMainAuthor(Array $main_author = array()) {
      array_merge($this->main_author, $main_author);
    }
    public function setMainAuthorName($name) { $this->main_author['name'] = $name; }
    public function setMainAuthorEmail($email) { $this->main_author['email'] = $email; }
    public function setMainAuthorDate($timestamp) { $this->main_author['timestamp'] = $timestamp; }
    public function getMainAuthor() { return $this->main_author; }
    public function getMainAuthorName() { return $this->main_author['name']; }
    public function getMainAuthorEmail() { return $this->main_author['email']; }
    public function getMainAuthorDate() { return $this->main_author['date']; }
    
    public function setMainCommitter(Array $main_committer = array()) {
      array_merge($this->main_committer, $main_committer);
    }
    public function setMainCommitterName($name) { $this->main_committer['name'] = $name; }
    public function setMainCommitterEmail($email) { $this->main_committer['email'] = $email; }
    public function setMainCommitterDate($timestamp) { $this->main_committer['timestamp'] = $timestamp; }
    public function getMainCommitter() { return $this->main_committer; }
    public function getMainCommitterName() { return $this->main_committer['name']; }
    public function getMainCommitterEmail() { return $this->main_committer['email']; }
    public function getMainCommitterDate() { return $this->main_committer['date']; }      
    
    public function setParents($parents) {
      array_merge($this->parents, $parents);
    }
    public function getParents() { return $this->parents; }
    
    public function setStats($stats) { $this->stats = $stats; }
    public function getStats() { return $this->stats; }
    
    public function setFiles($files) {
      array_merge($this->files, $files);
    }
    public function getFiles() { return $this->files; }
    
    public static function fromArray(Array $array) {
      if(isset($arr['url']))                  $this->setUrl($arr['url']);
      if(isset($arr['sha']))                  $this->setSha($arr['sha']);
      if(isset($arr['commit']['author']))     $this->setAuthor($arr['author']);
      if(isset($arr['commit']['committer']))  $this->setCommitter($arr['committer']);
      if(isset($arr['commit']['message']))    $this->setMessage($arr['message']);
      if(isset($arr['commit']['tree']))       $this->setTree($arr['tree']);
      if(isset($arr['author']))               $this->setMainAuthor($arr['author']);
      if(isset($arr['committer']))            $this->setMainCommitter ($arr['committer']);
      if(isset($arr['parents']))              $this->setParents($arr['parents']);
      if(isset($arr['stats']))                $this->setStats($arr['stats']);
      if(isset($arr['files']))                $this->setFiles($arr['files']);    
    }
  }