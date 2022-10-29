<?php


class Controller
{

    public function renderView($view, $data = [], $data2 = [])
    {
        $url = '../app/views/' . $view . '.php';
        $this->d1 = $data;
        $this->d2 = $data2;
        if (file_exists($url)) {
            error_log("Controller::renderView -> Se carga vista " . $view);
            require '../app/views/' . $view . '.php';
        } else {
            error_log("Controller::renderView -> No existe la vista en " . $view);
        }
    }

    public function loadModel($model)
    {
        $url = '../app/models/' . $model . 'model.php';
        if (file_exists($url)) {
            require_once $url;
            $modelName = $model . 'Model';
            $this->model  = new $modelName;
        }
    }


    public function existPOST($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                error_log("Controller::existPOST -> No existe el parametro " . $param);
                return false;
            }
        }
        error_log("Controller::existPOST -> Parametros en POST correctos!");
        return true;
    }

    public function existGET($params)
    {
        foreach ($params as $param) {
            if (!isset($_GET[$param])) {
                error_log("Controller::existGET -> No existe el parametro " . $param);
                return false;
            }
        }
        error_log("Controller::existGET -> Parametros en GET correctos!");
        return true;
    }

    public function getGet($name)
    {
        return $_GET[$name];
    }
    public function getPost($name)
    {
        return $_POST[$name];
    }

    public function redirect($route, $mensajes)
    {
        $data = [];
        $params = '';

        foreach ($mensajes as $key => $mensaje) {
            array_push($data, $key . "=" . $mensaje);
        }

        $params = join('&', $data);
        if ($params != '') {
            $params = '?' . $params;
        }

        header('Location: ' . constant('URL') . $route . $params);
    }
}
