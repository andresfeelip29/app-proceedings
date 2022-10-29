<?php


require '../app/vendor/autoload.php';

class App
{
    protected $currentController = "LoginController";
    protected $currentMethod = "index";
    protected $parameters = [];



    public function __construct()
    {
        error_log("App::_contructor-> Se inicia constructor ruteador");

        $container = new DI\Container();

        $url = $this->getUrl();


        if (file_exists('../app/controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $this->currentController = ucwords($url[0]) . 'Controller';

            unset($url[0]);
        }
        error_log("App::_contructor-> Se direcciona al controlador " . $this->currentController);

        require_once('../app/controllers/' . $this->currentController . '.php');

        // $this->currentController = new $this->currentController;
        $this->currentController = $container->get($this->currentController);

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];

                unset($url[1]);
            }
        }


        $this->parameters = $url ? array_values($url) : [];
        error_log("App::_contructor-> Se llama al metodo " . $this->currentMethod);
        call_user_func_array(array($this->currentController, $this->currentMethod), $this->parameters);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            error_log("App::getUrl-> se obtiene url");
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
