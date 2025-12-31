<?php

require_once '../models/Personas.php';
$personas = new Personas();

header('Content-Type: application/json');

// 🔴 FORZAR listar si no llega operacion
if (!isset($_POST['operacion'])) {
  echo json_encode($personas->listar());
  exit;
}

switch($_POST['operacion']){
  case 'listar':
    echo json_encode($personas->listar());
    break;

  case 'registrar':
    $datos = [
      "clasificacion" => $_POST['clasificacion'],
      "nombre"        => $_POST['nombre'],
      "apellidos"     => $_POST['apellidos'],
      "telefono"      => $_POST['telefono'],
      "direccion"     => $_POST['direccion'],
      "idanimal"      => $_POST['idanimal'],
      "fecha"         => date('Y-m-d')
    ];
    echo json_encode($personas->registrar($datos));
    break;

  case 'actualizar':
    $datos = [
      "clasificacion" => $_POST['clasificacion'],
      "nombre"        => $_POST['nombre'],
      "apellidos"     => $_POST['apellidos'],
      "telefono"      => $_POST['telefono'],
      "direccion"     => $_POST['direccion'],
      "idanimal"      => $_POST['idanimal'],
      "fecha"         => $_POST['fecha'],
      "id"            => $_POST['id']
    ];
    echo json_encode($personas->actualizar($datos));
    break;

  case 'eliminar':
    echo json_encode($personas->eliminar($_POST['id']));
    break;

  case 'buscarPorID':
    echo json_encode($personas->buscarPorID($_POST['id']));
    break;

  case 'buscarPorClasificacion':
    echo json_encode($personas->buscarPorClasificacion($_POST['clasificacion']));
    break;
}
