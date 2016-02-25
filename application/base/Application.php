<?php
namespace app\base;
use app\base\Request;
use app\controllers\AddressesController;

class Application {

    public function __construct() {

        $request = new Request();

        $controllerName = 'app\controllers\\'.ucfirst($request->url_elements[1])."Controller";
        // Смотрим есть ли файл контроллера
        // Если нет, возвращаем ошибку клиенту
        $controller = new $controllerName();
        $method = $request->method.'Action';

        if(method_exists($controller, $method)) {
            $controller->{$method}($request);
        }
        else {
            $controller->defaultAction();
        }

    }

}