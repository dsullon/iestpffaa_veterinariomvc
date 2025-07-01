<?php
namespace API;

use Models\Usuario;

class APIAuth {
  public static function procesar(){
    $respuesta = respuestaAPI(mensaje: "Error en el procesamiento");
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $accion = $_POST['accion'];
        if($accion == "add"){
            $respuesta = self::crear($_POST);
        } else {
            $respuesta = respuestaAPI(mensaje: "Operación no implementada");
        }

    } else {
        $respuesta = respuestaAPI(mensaje: "Método no implementado");
    }
    echo json_encode($respuesta);
  }

  private static function crear($data){
    $respuesta = respuestaAPI(mensaje: "No se ha podido registrar al usuario");
    $usuario = new Usuario($data);
    $alertas = $usuario->validar();
    if(empty($alertas)){
        $filtro = ['campo' => 'email', 'operador' => '=', 'valor' => $usuario->email];
        $existe = Usuario::where([$filtro])->get();
        if($existe){
            $respuesta = respuestaAPI(mensaje: "El email ingresado ya existe");
        } else {
            $usuario->uid = md5(uniqid());
            $usuario->hashPassword();
            $usuario->token = uniqid();
            $exito = $usuario->save();
            if($exito){
                $respuesta = respuestaAPI(estado: true, mensaje: "Registro creado");
            }
        }
    } else{
        $respuesta = respuestaAPI(mensaje: "Debe completar todos los datos");
    }

    return $respuesta;
  }
}