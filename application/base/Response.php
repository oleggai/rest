<?php

namespace app\base;

class Response {
    /**
     * @var array Данные
     */
    public $data;
    /**
     * @var string Сообщение
     */
    public $message = '';
    /**
     * @var string Текст ошибки
     */
    public $error_message;
    /**
     * @var integer Код ошибки
     */
    public $error_code;
    /**
     * @var integer Код ответа
     */
    public $responce_code;
}