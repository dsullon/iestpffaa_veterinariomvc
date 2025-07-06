<?php
namespace API;

use Classes\Email;
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
            $usuario->uid = uniqid();
            $usuario->hashPassword();
            $usuario->token = md5(uniqid());;
            $exito = $usuario->save();
            if($exito){
                $email = new Email();
                $data = [
                    'email' => $usuario->email,
                    'usuario' => $usuario->nombres,
                    'token' => $usuario->token
                ];
                $email->confirmacionRegistro($data);
                $respuesta = respuestaAPI(estado: true, mensaje: "Registro creado");
            }
        }
    } else{
        $respuesta = respuestaAPI(mensaje: "Debe completar todos los datos");
    }

    return $respuesta;
  }

  public static function login() {
    $respuesta = respuestaAPI(mensaje: "Usuario o password incorrecto o el usuario no se encuentra activo.");
    $auth = new Usuario($_POST);
    $alertas = $auth->validarLogin();
    if(empty($alertas)){
        $filtros = [
            ['campo' => 'email', 'operador' => '=', 'valor' => $auth->email ],
            ['campo' => 'confirmado', 'operador' => '=', 'valor' => 1 ]
        ];
        $usuario = Usuario::where($filtros)->get();
        if($usuario[0] && $usuario[0]->comprobarPassword($auth->password)){
            $usuario = $usuario[0];
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['usuarioID'] = $usuario->id;
            $_SESSION['usuario'] = $usuario->nombres;
            $respuesta = respuestaAPI(estado:true, data: ['data' => $usuario]);
        }
    }
    echo json_encode($respuesta);
  }

}