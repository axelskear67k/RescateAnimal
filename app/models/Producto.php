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
$sql = "
SELECT 
id,classificacion, marca, descripcion, garantia, ingreso, cantidad
 FROM productos
 ORDER BY id DESC";
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

public function registrar($registro = []):int{
  try{
    //los comodines, poseen indices (arreglos)
    $sql="
    INSERT INTO productos 
    (classificacion, marca, descripcion, garantia, ingreso, cantidad) VALUES
     (?,?,?,?,?,?)
     ";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);
//3 La consulta lleva comodines, pasamos los datos en execute()
$consulta->execute(
array(
$registro ['classificacion'],
$registro ['marca'],
$registro ['descripcion'],
$registro ['garantia'],
$registro ['ingreso'],
$registro ['cantidad']
)

);
//retornar la Primary Key generada
return $this->pdo->lastInsertId();


  }
  catch(Exception $e){
    return -1; 

  }

}

public function eliminar(){
  try{
    $sql="DELETE FROM productos WHERE id=?";

$consulta = $this->pdo->prepare($sql);

$consulta->execute();
  }
  catch(Exception $e){
    return -1;
  }
}
public function actualizar(){ 

}
public function buscar(){ 

}
  

}