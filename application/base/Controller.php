<?php
namespace app\base;

abstract class Controller {

    public $responce = null;

    abstract public function getAction($request);
    abstract public function postAction();
    abstract public function putAction();
    abstract public function deleteAction();

    public function __construct() {}

    public function defaultAction() {
        echo 'defaultAction';
    }
}