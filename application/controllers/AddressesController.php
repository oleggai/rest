<?php
namespace app\controllers;

use app\base\Controller;
use app\base\Model;
use app\models\AddressesModel;
use app\base\Request;
use app\base\Response;

class AddressesController extends Controller {
    /**
     * Модель сущности
     * @var Model
     */
    private $model;

    public function __construct($response, $error, $view) {
        $this->responce = $response;
        $this->error = $error;
        $this->view = $view;
        $this->model = new AddressesModel();
    }

    /**
     * @param $request Request
     */
    public function getAction($request) {

        if(array_key_exists(2, $request->url_elements) && $request->url_elements[2] !== "") {
            $addressId = (int)$request->url_elements[2];
            if(array_key_exists(3, $request->url_elements) && $request->url_elements[3] !== "") {
                switch($request->url_elements[3]) {
                    // for example
                    case 'friends':
                        break;
                    default:

                        break;
                }
                } else {
                // Один адрес
                $this->responce->data = $this->model->getOne($addressId);
                }
            } else {
                // весь список адресов
                $this->responce->data = $this->model->getAll();
            }
        if(empty($this->responce->data)) {
            $errorCode = '404';
            $this->responce->error_message = $this->error->getMessage($errorCode);
            $this->responce->responce_code = $errorCode;
        }
        else {
            $errorCode = '302';
            $this->responce->message = $this->error->getMessage($errorCode);
            $this->responce->responce_code = $errorCode;
        }
        return $this->view->render($this->responce);
    }

    /**
     * Создает сущность
     * @param $request
     */
    public function postAction($request) {
        foreach($request->parameters as $key => $val) {
            // Проверяем, если неверно введено название атрибута, то выдаем ошибку. Например не city, а city1
            if(!in_array($key, $this->model->columns)) {
                $errorCode = '414';
                $this->responce->error_message = $this->error->getMessage($errorCode)." ".$key;
                $this->responce->error_code = $errorCode;
                return $this->view->render($this->responce);
            }
            // Если пустой параметр, то выдаем ошибку
            if($val == '') {
                $errorCode = '415';
                $this->responce->error_message = $this->error->getMessage($errorCode)." ($key)";
                $this->responce->error_code = $errorCode;
                return $this->view->render($this->responce);
            }
        }
        $res = $this->model->create($request->parameters);

        $errorCode = $res ? '417' : '416';
        $this->responce->error_message = $this->error->getMessage($errorCode);
        $this->responce->error_code = $errorCode;
        return $this->view->render($this->responce);
    }

    /**
     * Обновляет сущность
     */
    public function putAction($request) {
        foreach($request->parameters as $key => $val) {
            // Проверяем, если неверно введено название атрибута, то выдаем ошибку. Например не city, а city1
            if(!in_array($key, $this->model->columns)) {
                $errorCode = '414';
                $this->responce->error_message = $this->error->getMessage($errorCode)." ".$key;
                $this->responce->error_code = $errorCode;
                return $this->view->render($this->responce);
            }
            // Если пустой параметр, то выдаем ошибку
            if($val == '') {
                $errorCode = '415';
                $this->responce->error_message = $this->error->getMessage($errorCode)." ($key)";
                $this->responce->error_code = $errorCode;
                return $this->view->render($this->responce);
            }
        }
        // Если нету ид сущности
        if(!array_key_exists(2, $request->url_elements) || $request->url_elements[2] == "") {
            $errorCode = '420';
            $this->responce->error_message = $this->error->getMessage($errorCode);
            $this->responce->error_code = $errorCode;
            return $this->view->render($this->responce);
        }
        $res = $this->model->update($request->parameters, $request->url_elements[2]);

        $errorCode = $res ? '419' : '418';
        $this->responce->error_message = $this->error->getMessage($errorCode);
        $this->responce->error_code = $errorCode;
        return $this->view->render($this->responce);
    }

    /**
     * Удаляет сущность
     */
    public function deleteAction($request) {
        // Если нету ид сущности, то выдаем ошибку
        if(!array_key_exists(2, $request->url_elements) || $request->url_elements[2] == "") {
            $errorCode = '420';
            $this->responce->error_message = $this->error->getMessage($errorCode);
            $this->responce->error_code = $errorCode;
            return $this->view->render($this->responce);
        }
        $res = $this->model->delete($request->url_elements[2]);

        $errorCode = $res ? '422' : '421';

        $this->responce->error_message = $this->error->getMessage($errorCode);
        $this->responce->error_code = $errorCode;
        return $this->view->render($this->responce);
    }
}