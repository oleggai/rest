<?php
spl_autoload_register('apiAutoload');

function apiAutoload($className) {

    $s = DIRECTORY_SEPARATOR;
    // Берем имя класса
    $arr = explode('\\', $className);
    $className = end($arr);

    $pathToController = __DIR__ . $s .'application'. $s .'controllers'. $s . $className . '.php';
    $pathToModel = __DIR__ . $s .'application'. $s .'models'. $s . $className . '.php';
    $pathToView = __DIR__ . $s .'application'. $s .'views'. $s . $className . '.php';
    $pathToBase = __DIR__ . $s .'application'. $s .'base'. $s . $className . '.php';

    if (preg_match('/[a-zA-Z]+Controller$/', $className) && file_exists($pathToController)) {
        include $pathToController;
        return true;
    }
    if (preg_match('/[a-zA-Z]+Model$/', $className) && file_exists($pathToModel)) {
        include $pathToModel;
        return true;
    }
    if (preg_match('/[a-zA-Z]+View$/', $className) && file_exists($pathToView)) {
        include $pathToView;
        return true;
    }
    if(file_exists($pathToBase)) {
        include $pathToBase;
        return true;
    }
}