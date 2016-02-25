<?php

namespace app\base;

class Request {

    /*
     *
     */
    public $url_elements = [];
    /*
     * HTTP-method
     */
    public $method;
    /*
     * Входящие параметры
     */
    public $parameters = [];

    /*
     * Формат запрашиваемых данных, по умолчанию
     */
    public $format = 'json';

    public function __construct() {}
}