<?php
namespace app\base;

class Error {
    private $errors = [
        "404" => "Nothing found!",
        "413" => "Entity not found!",
        'default' => 'Unknown error!'
    ];
    public function getMessage($code) {
        return array_key_exists($code, $this->errors) ? $this->errors[$code] : $this->errors['default'];
    }
}