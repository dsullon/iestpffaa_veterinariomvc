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
        $query = "SELECT  * FROM " . static::$table;
        $stmt = self::$db->prepare($query);
        $stmt->execute();
        $resultado = [];
        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            $resultado[] = self::crearObjeto($fila);
        }
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
        $propiedades = get_object_vars($this);
        if(!isset($propiedades[static::$pk])){
            // TODO: Implementar logíca de crear un registro
            echo 'Crear registro';
            $this->crear($propiedades);
        } else {
            $this->actualizar($propiedades);
        }
    }

    function crear($propiedades){
        $columnas = [];
        foreach ($propiedades as $key => $value) {
            if($key !== static::$pk){
                $columnas[] = $key;
                $places[] = ":$key";
                $params[":$key"] = $value;
            }
        }
        $query = "INSERT INTO " . static::$table . "(" . implode(", ", $columnas) . ")
                    VALUES(" . implode(", ", $places) .")";
        $stmt = self::$db->prepare($query);
        $resultado = $stmt->execute($params);
        return $resultado;
    }

    function actualizar($propiedades){
        $columnas = [];
        $params = [];
        foreach ($propiedades as $key => $value) {
            if($key !== static::$pk){
                $columnas[] = "$key = :$key";
                $params[":$key"] = $value; 
            }
        }
        $params[":id"] = $propiedades[static::$pk];
        $query = "UPDATE " . static::$table . " SET " . 
            implode(", ", $columnas) . " WHERE " . static::$pk . " = :id";            
        $stmt = self::$db->prepare($query);
        $resultado = $stmt->execute($params);
        return $resultado;
    }

    public function sincronizar($args = []) {
        foreach($args as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;                
            }
        }
    }
}