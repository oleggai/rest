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

    public function __construct($response) {
        $this->responce = $response;
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
            $this->responce->message = 'Nothing found!';
            $this->responce->responce_code = '404';
        }
        $viewName = 'app\views\\'.ucfirst($request->format).'View';
        $view = new $viewName();
        return $view->render($this->responce);
    }
    public function postAction() {

    }
    public function putAction() {

    }
    public function deleteAction() {

    }
}