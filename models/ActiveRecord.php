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
        return $resultado;
    }

    public function save() {
       // TODO: Validar si es que se crea un nuevo registro o se actualiza
       $propiedades = get_object_vars($this);
       if(!isset($propiedades[static::$pk])){
        // TODO: Implementar logíca de crear un registro
        echo 'Crear registro';
        $this->crear($propiedades);
       } else {
        // TODO: Implementar lógica de actualizar un registro
        echo 'Actualizar registro';
        $this->actualizar($propiedades);
       }
    }

    function crear($propiedades){

    }

    function actualizar($propiedades){

    }

    public function sincronizar($args = []) {
        foreach($args as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;                
            }
        }
    }
}