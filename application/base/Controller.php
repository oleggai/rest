<?php
namespace app\base;

abstract class Controller {

    /**
     * @var Response|null
     */
    public $responce = null;
    /**
     * @var Error|null
     */
    public $error = null;
    /**
     * @var View|null
     */
    public $view = null;

    abstract public function getAction($request);
    abstract public function postAction($request);
    abstract public function putAction($request);
    abstract public function deleteAction($request);

    public function __construct() {}

    public function defaultAction() {
        echo 'defaultAction';
    }
}