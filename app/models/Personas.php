<?php
//1. Acceder a la clase conexion
require_once 'Conexion.php';
//2 El provedor heredara las funcionalidad de la clase conexion
class personas extends Conexion{
//3. Creamos un atributo que guardara la conexion
private $pdo;

//4. En el constructor, guardamos la conexion activa
public function __construct(){
  //tenemos que usar $this porque pdo es un atributo de la clase
  //Despues de llamar a pdo usamos parent para acceder ala conexion de la clase
  $this->pdo = parent::getConexion();
}
public function listar(){
  try{
    $sql = "
    SELECT
    id,clasificacion,nombre, apellidos, telefono, direccion, ingreso, created, updated
    ORDER BY id DESC
    ";
    $consulta = $this->pdo->prepare($sql);

    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(Exception $e){
    return [];
  }

}
public function registrar($registro = []):int{
  try{
    $sql="
    INSERT INTO personas
    (clasificacion,nombre, apellidos, telefono, direccion, ingreso) VALUES
    (?,?,?,?,?,?)
    ";
    $consulta = $this->pdo->prepare($sql);
    $consulta->execute(
      array(
        $registro['clasificacion'],
        $registro['nombre'],
        $registro['apellidos'],
        $registro['telefono'],
        $registro['direccion'],
        $registro['ingreso']
      )
    );
    return $consulta->rowCount();
  }
  catch(Exception $e){
    return -1;
  }

}
  
public function actualizar($registro = []):int{
  try{
    $sql="
    UPDATE personas SET
    clasificacion = ?,
    nombre = ?,
    apellidos = ?,
    telefono = ?,
    direccion = ?,
    ingreso = ?,
    updated = NOW()
    WHERE id = ?
    ";
    $consulta = $this->pdo->prepare($sql);
    $consulta->execute(
      array(
        $registro['clasificacion'],
        $registro['nombre'],
        $registro['apellidos'],
        $registro['telefono'],
        $registro['direccion'],
        $registro['ingreso'],
        $registro['id']
      )
    );
    return $consulta->rowCount();
  }
  catch(Exception $e){
    return -1;
  }

}
public function eliminar($id){
    try{
    $sql="DELETE FROM personas WHERE id=?";

$consulta = $this->pdo->prepare($sql);
//El execute() esta vacio cuando no utilizamos comodines
$consulta->execute(
  array($id)
);

//Devolvemos un numero si se pudo o no borrar
//retorna la cantidad de filas afectadas
  return $consulta->rowCount();
  }
  catch(Exception $e){
    return -1;
  }

}


}