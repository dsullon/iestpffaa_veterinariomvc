<?php

namespace Models;
use PDO;

class ActiveRecord{
    protected static $db;
    protected static $table;
    protected static $pk;

    public static function setDB($database){
        self::$db =  $database;
    }

    public static function all(){
        $clase = new static;
        $query = "SELECT  * FROM " . static::$table;
        $stmt = self::$db->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($clase));
        return $resultado;
    }

    public static function find(int $id) {
        $clase = new static;
        $query = "SELECT * FROM " . static::$table . " WHERE " . static::$pk . "= :id";
        $stmt = self::$db->prepare($query);
        $stmt->execute([":id" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($clase));
        $resultado = $stmt->fetch();
        print_r($resultado);
    }

    public function save() {
        $propiedades = get_object_vars($this);
        print_r("Desde la clase base");
        print_r($propiedades);    
    }
}