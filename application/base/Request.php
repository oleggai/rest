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

    public function __construct() {
        $this->url_elements = explode('/', $_SERVER['PATH_INFO']);
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->parseIncomingParams();
        return true;
    }

    /**
     * Парсит входящие параметры
     */
    private function parseIncomingParams() {
        $parameters = [];

        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }

        $body = file_get_contents("php://input");
        $content_type = false;
        if(isset($_SERVER['CONTENT_TYPE'])) {
            $content_type = $_SERVER['CONTENT_TYPE'];
        }
        switch($content_type) {
            case "application/json":
                $body_params = json_decode($body);
                if($body_params) {
                    foreach($body_params as $param_name => $param_value) {
                        $parameters[$param_name] = $param_value;
                    }
                }
                $this->format = "json";
                break;
            case "application/x-www-form-urlencoded":
                parse_str($body, $postvars);
                foreach($postvars as $field => $value) {
                    $parameters[$field] = $value;
                }
                $this->format = "html";
                break;
            default:
                // Другой формат
                break;
        }
        $this->parameters = $parameters;
    }
}