<?php
require_once 'Conexion.php';

class Personas extends Conexion{
  
  private $pdo;

  public function __construct(){
    $this->pdo = parent::getConexion();
  }

  public function listar(){
    try{
      $sql = "
      SELECT 
        clasificacion,
        id,
        nombre,
        apellidos,
        telefono,
        direccion,
        idanimal,
        fecha,
        created,
        updated
      FROM personas
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
      $sql = "
      INSERT INTO personas
      (
        clasificacion,
        nombre,
        apellidos,
        telefono,
        direccion,
        idanimal,
        fecha,
        updated
      )
      VALUES (?,?,?,?,?,?,?,NOW())
      ";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(
        array(
          $registro['clasificacion'],
          $registro['nombre'],
          $registro['apellidos'],
          $registro['telefono'],
          $registro['direccion'],
          $registro['idanimal'],
          $registro['fecha']
        )
      );

      return $consulta->rowCount();
    }
    catch(Exception $e){
      return -1;
    }
  }

  public function eliminar($id):int{
    try{
      $sql = "DELETE FROM personas WHERE id = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(array($id));
      return $consulta->rowCount();
    }
    catch(Exception $e){
      return -1;
    }
  }

  public function actualizar($registro = []):int{
    try{
      $sql = "
      UPDATE personas SET
        clasificacion = ?,
        nombre        = ?,
        apellidos     = ?,
        telefono      = ?,
        direccion     = ?,
        idanimal      = ?,
        fecha         = ?,
        updated       = NOW()
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
          $registro['idanimal'],
          $registro['fecha'],
          $registro['id']
        )
      );

      return $consulta->rowCount();
    }
    catch(Exception $e){
      return -1;
    }
  }

  public function buscarPorID(int $id):array{
    try{
      $sql = "SELECT * FROM personas WHERE id = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(array($id));
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      return [];
    }
  }

  public function buscarPorClasificacion(string $clasificacion){
    try{
      $sql = "SELECT * FROM personas WHERE clasificacion = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(array($clasificacion));
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      return [];
    }
  }
}
