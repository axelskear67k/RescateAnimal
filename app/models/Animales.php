<?php
require_once 'Conexion.php';
class Animales extends Conexion{
//Este atributo contendra la conexion que iniciamos en class Producto extends Conexion
private $pdo;

public function __construct(){
  //La conexion asigna el acceso a $this ->pdo
  $this->pdo = parent::getConexion();
  //tomamos parent que tiene almacenado a conexion junto a get conection y lo
  //guardamos en pdo
}
public function listar(){
try{
  // 1 Crear mi consulta sql
$sql = "
SELECT 
id,clasificacion,nombre, especie,raza,genero,condiciones,vacunas,estado,ingreso,foto,created,updated
 FROM animales
 ORDER BY id DESC";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);

//3 Ejecutar la consulta
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
    INSERT INTO animales 
    (clasificacion,nombre, especie,raza,genero,condiciones,vacunas,estado,ingreso) VALUES
     (?,?,?,?,?,?,?,?,?)
     ";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);
//3 La consulta lleva comodines, pasamos los datos en execute()
$consulta->execute(
array(
$registro ['clasificacion'],
$registro ['nombre'],
$registro ['especie'],
$registro ['raza'],
$registro ['genero'],
$registro ['condiciones'],
$registro ['vacunas'],
$registro ['estado'],
$registro ['ingreso']
)
);
//¡Cuantos registros fueron afectados
return $consulta->rowCount();


  }
  catch(Exception $e){
    //Se optiene cuando salio mal
    return -1; 

  }

}

public function eliminar($id):int{
  try{
    $sql="DELETE FROM animales WHERE id=?";
    
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

public function actualizar($registro = []):int{ 
  try{
    //los comodines, poseen indices (arreglos)
    $sql="
    UPDATE animales SET
    clasificacion = ?,
    nombre         = ?,
    especie        = ?,
    raza           = ?,
    genero         = ?,
    condiciones    = ?,
    vacunas        = ?,
    estado         = ?,
    ingreso        = ?,
    updated        = NOW()
    WHERE id = ?
";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);
//3 La consulta lleva comodines, pasamos los datos en execute()
$consulta->execute(
array(
$registro ['clasificacion'],
$registro ['nombre'],
$registro ['especie'],
$registro ['raza'],
$registro ['genero'],
$registro ['condiciones'],
$registro ['vacunas'],
$registro ['estado'],
$registro ['ingreso'],
$registro ['id']
)

);
//retornar la Primary Key generada
 return $consulta->rowCount();


  }
  catch(Exception $e){
    return -1; 

  }
  

}

public function buscarPorID(int $id):array{ 
try{
  // 1 Crear mi consulta sql
$sql = " SELECT * FROM animales WHERE id = ?";
//2 Enviar la consulta preparada a PDO
$consulta = $this->pdo->prepare($sql);

//3 Ejecutar la consulta}
$consulta->execute(
  array($id)
);

//4 Entregar resultado
//fetchAll (Coleccion de arreglos)
//PDO::FETCH_ASSOC (los valores son asociativos)
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
  die($e->getMessage());
}
}
public function buscarPorEstado(string $estado){
  try{
    //crear Consulta SQL
    $sql="SELECT * FROM animales WHERE estado =?";
    //Enviar consulta preparada a PDO
    $consulta = $this->pdo->prepare($sql);
    //Ejecucion
    $consulta -> execute(array($estado));

    //resultados
    //fetchAll (Coleccion de arreglos, los retorna)
    //FETCH_ASSOC formateo como arreglos
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(Exception $e){
    die($e->getMessage());

  }
}
}