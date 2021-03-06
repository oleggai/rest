<?php
namespace app\base;
use app\base\Request;
use app\controllers\AddressesController;
use app\views\JsonView;

class Application {

    public function __construct() {

        $s = DIRECTORY_SEPARATOR;

        $request = new Request();
        $response = new Response();
        $error = new Error();
        $viewName = 'app\views\\'.ucfirst($request->format).'View';
        $view = new $viewName();

        $entityName = ucfirst($request->url_elements[1]);
        $controllerName = 'app\controllers\\'.$entityName."Controller";
        $pathToController = "application". $s ."controllers". $s .$entityName."Controller.php";
        // Если нету файла запрашиваемой сущности, то возвращаем ошибку
        if(!file_exists($pathToController)) {
            $errorCode = '413';
            $response->error_message = $error->getMessage($errorCode);
            $response->error_code = $errorCode;
            return $view->render($response);
        }
        $controller = new $controllerName($response, $error, $view);
        $method = $request->method.'Action';

        if(method_exists($controller, $method)) {
            $controller->{$method}($request);
        }
        else {
            $controller->defaultAction();
        }

    }

}