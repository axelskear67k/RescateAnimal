<?php
//todos los modelos (logica / motor de la APP) requieren acceder
//a la base de datos, esta clase, brindara este acceso
class Conexion{
  //Atributos
  private $servidor ="localhost";
  private $puerto = "3306";
  private $baseDatos = "tiendaperu";
  private $usuario = "root";
  private $clave = "";


  public function getConexion(){
    //manejador de excepciones/errores
    //try (intentar)
    //ctach (accidente, error)
    try{
      //La clase PDO Permite conectarte a diferentes motores de BD,
      //Requiere una configuracion minima y es facil de utilizar
      $pdo = new PDO(
        "mysql:host={$this->servidor}; port={$this->puerto}; dbname={$this->baseDatos}; charset=UTF8",
        $this->usuario,
        $this->clave);
      //configurar el manejo de rrores PDO
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
      
    }
    catch(Exception $e){
      //Cuando se sucito un error al conectarme al ssitema
      die($e->getMessage());

    }
  }
}