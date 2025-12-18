<?php
require_once 'Conexion.php';
class Producto extends Conexion{
//Este atributo contendra la conexion
private $pdo;

public function __construct(){
  //La conexion asigna el acceso a $this ->pdo
  $this->pdo = $this->getConexion();
}
public function listar(){
try{
  // 1 Crear mi consulta sql
$sql = "SELECT * FROM productos";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);
//3 Ejecutar la consulta}
$consulta->execute();

//4 Entregar resultado
//fetchAll (Coleccion de arreglos)
//PDO::FETCH_ASSOC (los valores son asociativos)
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
  return [];
}
}
public function refistrar(){

}
public function eliminar(){

}
public function actualizar(){ 

}
public function buscar(){ 

}
  

}