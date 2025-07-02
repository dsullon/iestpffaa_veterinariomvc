<?php
/**
 * Este archivo contiene la implementación de la clase ActiveRecord
 * que será utilizado para implementar la persistencia de datos utilizando PDO
 *
 * @author Alex Sullon (@dsullon)
 * @version 1.0
 * @date 2025-06-01
 */

namespace Models;
use PDO;
use \Exception;

class ActiveRecord{
    protected static $db;
    protected static $table;
    protected static $pk;
    protected $page = 1;
    protected $perPage = 10;
    protected $query = '';
    protected $params = [];
    protected $orderBy = '';

    /**
    * Asigna la conexión a la base de datos.
    * @param PDO $database Representa la conexión a la base de datos. PDO.
    * @return void
    */
    public static function setDB($database){
        self::$db =  $database;
    }

    /**
    * Ejecuta la consulta y devuelve los resultados.
    *
    * Este método ejecuta la consulta previamente construida y retorna los resultados obtenidos.
    * Se utiliza como el paso final en una cadena de construcción de consultas.
    *
    * Ejemplo de uso:
    * ```php
    * $filtros = [
    *   ['campo' => 'estado', 'operador' => '=', 'valor' => 1, 'conector' => 'AND']
    * ]
    * $usuarios = User::where($filtros)->get();
    * foreach ($usuarios as $usuario) {
    *     echo $usuario['nombre'];
    * }
    * ```
    *
    * @return mixed Los resultados de la consulta ejecutada. Generalmente un array o un iterable.
    */
    public function get() {
        return $this->runQuery();
    }

    /**
    *Establece el número de página actual para la paginación.
    *
    * Este método define el número de página a utilizar en las consultas paginadas.
    * Si se proporciona un número menor que 1, se ajusta automáticamente a 1.
    *
    * Ejemplo de uso:
    * ```php
    * User::where([...])->page(2);
    * ```
    *
    * @param int $pageNumber Número de página solicitado (1 o mayor).
    * @return $this Retorna la instancia actual para encadenamiento de métodos.
    */
    public function page(int $pageNumber) {
        $this->page = max(1, $pageNumber); // Evitar página 0 o negativa
        return $this;
    }

    /**
    * Establece la cantidad de registros a mostrar por página en una paginación.
    *
    * Este método define cuántos registros se mostrarán por página. Si se pasa un número menor que 1,
    * automáticamente se ajustará a 1 como valor mínimo.
    *
    * Ejemplo de uso:
    * ```php
    * User::where([...])->recordsPerPage(10);
    * ```
    *
    * @param int $recordsPerPage Número de registros por página (mínimo 1).
    * @return static Retorna la instancia actual para permitir encadenamiento de métodos.
    */
    public function recordsPerPage(int $recordsPerPage) {
        $this->perPage = max(1, $recordsPerPage); // Mínimo 1 resultado por página
        return $this;
    }

    /**
    * Ejecuta la consulta con paginación y devuelve los resultados junto con metadatos.
    *
    * Este método aplica paginación a la consulta SQL previamente construida,
    * ejecuta la consulta y retorna los resultados junto con
    * información de paginación como la página actual, elementos por página,
    * total de registros y total de páginas.
    *
    * ### Ejemplo de uso:
    * ```php
    * $resultado = User::where([...])->page(2)->perPage(5)->paginate();
    * 
    * foreach ($resultado['data'] as $usuario) {
    *     echo $usuario->nombre;
    * }
    * echo "Página actual: " . $resultado['meta']['page'];
    * ```
    *
    * @return array {
    *     @type array $data Lista de objetos del resultado.
    *     @type array $meta Información de paginación.
    *     @type int   $meta['page'] Página actual.
    *     @type int   $meta['per_page'] Cantidad de resultados por página.
    *     @type int   $meta['total'] Total de registros encontrados.
    *     @type int   $meta['total_pages'] Total de páginas calculado.
    * }
    */
    public function paginate(): array {
        $total = $this->count();
        $offset = ($this->page - 1) * $this->perPage;
        $resultados = $this->runQuery($this->perPage, $offset);

        return [
            'data' => $resultados,
            'meta' => [
                'page'        => $this->page,
                'per_page'    => $this->perPage,
                'total'       => $total,
                'total_pages' => ceil($total / $this->perPage),
            ]
        ];
    }

    /**
    * Cuenta la cantidad total de registros que devuelve la consulta actual.
    *
    * Este método ejecuta una subconsulta basada en la propiedad `$this->query`
    * y utiliza los parámetros almacenados en `$this->params` para contar cuántos
    * resultados existen en total. Es útil para implementar paginación o conocer
    * la cantidad de elementos que cumplen una condición.
    *
    * Ejemplo de uso:
    * ```php
    * $total = User::where([...])->count();
    * ```
    *
    * @return int Número total de registros que cumplen la consulta.
    */
    public function count() {
        $sql = "SELECT COUNT(*) AS total FROM (" . $this->query . ") AS sub";
        $stmt = self::$db->prepare($sql);
        $stmt->execute($this->params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($row['total'] ?? 0);
    }

    /**
    * Crea una instancia del modelo con una cláusula WHERE basada en filtros avanzados.
    *
    * Esta función construye dinámicamente una consulta SQL con filtros múltiples
    * utilizando operadores lógicos avanzados (AND, OR, etc.) y asigna los parámetros
    * correspondientes a la propiedad interna del modelo.
    *
    * Ejemplo de uso:
    * ```php
    * $filtros = [
    *    ['group' => [
    *        ['campo' => 'name', 'operador' => 'LIKE', 'valor' => '%juan%', 'conector' => 'OR'],
    *        ['campo' => 'email', 'operador' => 'LIKE', 'valor' => '%@gmail.com%', 'conector' => 'OR'],
    *    ]],
    *        ['campo' => 'active', 'operador' => '=', 'valor' => 1, 'conector' => 'AND']
    *    ];
    * $user = User::where($filtros)
    *   ->orderBy('id', 'DESC')
    *   ->get()
    * echo $user?->name ?? 'No encontrado';
    * $count = User::where($filtros)->count();
    * echo "Coincidencias: $count";
    *
    * ```
    *
    * @param array $filters Arreglo de condiciones para construir la cláusula WHERE.
    * Puede contener condiciones simples o anidadas usando claves lógicas como 'AND' o 'OR'.
    * @return static Instancia del modelo con la consulta y parámetros configurados.
    */
    public static function where(array $filters) {
        if(count($filters) == 0){
            throw new Exception("No se ha proporcionado ningún filtro a evaluar.", 1);            
        }
        $instance = new static();
        $index = 0;
        $resultado = $instance->buildWhere($filters, $index);
        $instance->query = "SELECT * FROM " . static::$table . " WHERE " . $resultado['where'];
        $instance->params = $resultado['params'];
        return $instance;
    }

    protected function buildWhere(array $filtros, int &$index): array {
        $where = '';
        $params = [];
        if(count($filtros) > 0){
            foreach ($filtros as $filtro) {
                $conector = $filtro['conector'] ?? 'AND';

                if (isset($filtro['group'])) {
                    $sub = $this->buildWhere($filtro['group'], $index);
                    $fragmento = '(' . $sub['where'] . ')';
                    $params += $sub['params'];
                } else {
                    $campo = $filtro['campo'];
                    $operador = strtoupper($filtro['operador']);
                    $param = ":param$index";
                    $index++;
                    $fragmento = "($campo $operador $param)";
                    $params[$param] = $filtro['valor'];
                }
                $where .= ($where === '') ? $fragmento : " $conector $fragmento";
            }
            return ['where' => $where, 'params' => $params];
        }
        else {
            return [];
        }
    }

    private function runQuery(?int $limit = null, ?int $offset = null): array {
        $sql = $this->query . $this->orderBy;
        if (!is_null($limit)) {
            $sql .= " LIMIT $limit";
            if (!is_null($offset)) {
                $sql .= " OFFSET $offset";
            }
        }

        $stmt = self::$db->prepare($sql);
        $stmt->execute($this->params);
        $resultado = [];
        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            $resultado[] = self::crearObjeto($fila);
        }
        return $resultado;
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
        $query = "SELECT * FROM " . static::$table . " WHERE " . static::$pk . "= :id LIMIT 1";
        $stmt = self::$db->prepare($query);
        $stmt->execute([":id" => $id]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $stmt->fetch();
        $resultado = self::crearObjeto($resultado);
        return $resultado;
    }

    public function save() {
        $resultado = false;
        $propiedades = get_object_vars($this);
        // ELIMINAR ATRIBUTOS INNECESARIOS
        unset($propiedades['page'], $propiedades['perPage'], $propiedades['query'], $propiedades['params'], $propiedades['orderBy']);
        
        if(!isset($propiedades[static::$pk])){
            $resultado = $this->crear($propiedades);
        } else {
            $resultado = $this->actualizar($propiedades);
        }
        return $resultado;
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

    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $clave => $valor){
            if(property_exists($objeto, $clave)){
                $objeto->$clave = $valor;
            }
        }
        return $objeto;
    }
}