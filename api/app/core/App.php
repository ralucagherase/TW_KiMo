<?php
/**
 * Created by PhpStorm.
 * User: Raluca Gherase
 * Date: 06.06.2017
 * Time: 19:22
 */
class App{

    protected $controller = 'index';

    protected $method = 'index';

    protected $params = [];

    public function __construct(){

        $url = $this->parseUrl();

        if(file_exists('app/controllers/' . $url[0] . '.php')){

            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller();

        if(isset($url[1])){

            if(method_exists($this->controller, $url[1])){

                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $newParams = [];

        if(is_array($url)){

            $values = array_values($url);

            for($i = 0; $i < count($values); $i += 2){

                $value = '';

                if(!empty($values[$i + 1])){
                    $value = $values[$i + 1];
                }

                $newParams[$values[$i]] = $value;
            }
        }

        $this->params = $newParams;

        call_user_func([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl(){

        if(isset($_GET['url'])){

            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}