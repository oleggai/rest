<?php
namespace app\base;

class Error {
    private $errors = [
        "200" => "OK",
        "206" => "Partial Content",
        "301" => "Moved Permanently",
        "302" => "Found",
        "304" => "Not Modified",
        "403" => "Forbidden",
        "404" => "Nothing found!",
        "413" => "Entity not found!",
        "414" => "Incorrect name of parameter",
        "415" => "Parametr must required",
        "416" => "Entity wasn't created",
        "417" => "Entity was created",
        "418" => "Entity wasn't updated",
        "419" => "Entity was updated",
        "420" => "Id of entity must required",
        "421" => "Entity wasn't deleted",
        "422" => "Entity was deleted",
        "500" => "Internal Server Error",
        'default' => 'Unknown error!'
    ];
    public function getMessage($code) {
        return array_key_exists($code, $this->errors) ? $this->errors[$code] : $this->errors['default'];
    }
}