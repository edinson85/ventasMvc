<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){

      $url = $this->getUrl();
      // Look in controllers for first value
      if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
        // If exists, set as controller
        $this->currentController = ucwords($url[0]);
        // Unset 0 Index
        unset($url[0]);
      }
      try {
        require_once '../app/controllers/'. $this->currentController . '.php';
      } catch (\Throwable $rg) {
        // TO DO ADD LOG
        $r = $rg;
      }
      // Require the controller

      // Instantiate controller class
      try {
        $this->currentController = new $this->currentController;
      } catch (\Throwable $rg) {
        // TO DO ADD LOG
        $r = $rg;
      }

      // Check for second part of url
      if(isset($url[1])){
        // Check to see if method exists in controller
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
          // Unset 1 index
          unset($url[1]);
        }
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
      if(isset($_SERVER['REQUEST_URI'])){
        $url = rtrim($_SERVER['REQUEST_URI'], '/');
        $url = ltrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
  } 
  
  