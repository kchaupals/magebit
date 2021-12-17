<?php
/* 
    * App Class
    * Creates URL & loads core controller
    * URL FORMAT - /controller/method/params
*/

class App
{
    protected $currentController = 'home';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        // $this->getURL();
        $url = $this->getURL();

        //Look in controllers for first value 
        if (empty($url[0])) {
            $this->currentController = 'home';
        } else if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // If exists set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 index
            unset($url[0]);
        } else {
            header("HTTP/1.0 404 Not Found");
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instansiate controller class 
        $this->currentController = new $this->currentController;

        // Check for second part of URL 
        if (isset($url[1])) {
            //Checks to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];

                //Unset 1 index
                unset($url[1]);
            } else {
                $this->currentMethod = 'index';
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
