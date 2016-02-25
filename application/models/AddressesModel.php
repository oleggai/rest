<?php
namespace app\models;

use app\base\Model;

class AddressesModel extends Model {
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

}