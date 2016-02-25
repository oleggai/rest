<?php

namespace app\base;

abstract class Model {
    /**
     * Коннект к бд
     * @var null
     */
    public $db = null;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    /**
     * Возвращает массив сущностей
     * @return array
     */
    abstract public function getAll();

    /**
     * возвращает массив с одной сущностью
     * @param $id. ИД сущности
     * @return array
     */
    abstract public function getOne($id);
}
