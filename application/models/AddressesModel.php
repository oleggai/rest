<?php
namespace app\models;

use app\base\Model;

class AddressesModel extends Model {
    /**
     * @var array атрибуты таблицы.
     * Если в запросе присутствуют некоректные названия атрибутов, то выдать придупреждение
     */
    public $columns = ['label', 'street', 'house_number', 'postal_code', 'city', 'country'];
    /**
     * Возвращает массив адрессов
     * @return array
     */
    public function getAll() {
        try {
            $sql = "SELECT * FROM address";
            $sth = $this->db->query($sql);
            $sth->setFetchMode(\PDO::FETCH_ASSOC);
            return $sth->fetchAll();
        }
        catch(\Exception $e) {
            // do something
        }
    }

    /**
     * Возврщает один адрес
     */
    public function getOne($id) {
        try {
            $sql = "SELECT * FROM address WHERE address_id=:id";
            $sth = $this->db->prepare($sql);
            $sth->execute(array(
                    ":id" => $id
                ));
            $sth->setFetchMode(\PDO::FETCH_ASSOC);
            return $sth->fetchAll();
        }
        catch(\Exception $e) {
            // do something
        }
    }

    public function create($parameters) {
        try {
            $sql = "INSERT INTO address (label, street, house_number, postal_code, city, country)
                    VALUES (:label, :street, :house_number, :postal_code, :city, :country)";
            $query = $this->db->prepare($sql);
            $query->execute(array(
                    ":label" => $parameters['label'],
                    ":street"   => $parameters['street'],
                    ":house_number"     => $parameters['house_number'],
                    ":postal_code"      => $parameters['postal_code'],
                    ':city' => $parameters['city'],
                    'country' => $parameters['country']
                ));
            return $this->db->lastInsertId();
        }
        catch(\Exception $e) {
            // do something
        }
    }

    public function update($parameters, $id) {
        // Выражение для обновления
        $set = '';
        $executeArray = [];
        foreach($parameters as $key => $val) {
            $set .= "$key = :$key, ";
            $executeArray[":$key"] = $val;
        }
        // Убираем последнюю кому с выражения
        $set = explode(',', $set);
        array_splice($set, (count($set) - 1));
        $set = implode(',', $set);

        $executeArray[":id"] = $id;
        try {
            $sql = "UPDATE address SET ".$set ." WHERE address_id = :id";
            $query = $this->db->prepare($sql);
            $query->execute($executeArray);
            return $query->rowCount()? true : false;
        }
        catch(\Exception $e) {
        }
    }

    /**
     * Удаляет сущность
     * @param $id
     *
     * @return bool
     */
    public function delete($id) {
        try {
            $sql = "DELETE FROM address WHERE address_id = :id";
            $sth = $this->db->prepare($sql);
            $sth->execute(array(
                    ":id" => $id
                ));
            return $sth->rowCount()? true : false;
        }
        catch(\Exception $e) {
        }
    }
}