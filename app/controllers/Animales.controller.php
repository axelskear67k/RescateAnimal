<?php

require_once '../models/Animales.php';
$animales = new Animales();

if (isset($_POST['operacion'])){

    switch($_POST['operacion']){

        case 'listar':
            // LISTAR (incluye foto desde el modelo)
            $registros = $animales->listar();
            echo json_encode($registros);
            break;

        case 'registrar':
            // REGISTRAR (AGREGADO: foto)
            $datos = [
                "clasificacion" => $_POST['clasificacion'],
                "nombre"        => $_POST['nombre'],
                "especie"       => $_POST['especie'],
                "raza"          => $_POST['raza'],
                "genero"        => $_POST['genero'],
                "condiciones"   => $_POST['condiciones'],
                "vacunas"       => $_POST['vacunas'],
                "estado"        => $_POST['estado'],
                "foto"          => $_POST['foto'],
                "ingreso"       => date('Y-m-d')
            ];

            $idobtenido = $animales->registrar($datos);
            echo json_encode(["id" => $idobtenido]);
            break;

        case 'actualizar':
            // ACTUALIZAR (AGREGADO: foto)
            $datos = [
                "id"            => $_POST['id'],
                "clasificacion" => $_POST['clasificacion'],
                "nombre"        => $_POST['nombre'],
                "especie"       => $_POST['especie'],
                "raza"          => $_POST['raza'],
                "genero"        => $_POST['genero'],
                "condiciones"   => $_POST['condiciones'],
                "vacunas"       => $_POST['vacunas'],
                "estado"        => $_POST['estado'],
                "foto"          => $_POST['foto'], // 👈 NUEVO
                "ingreso"       => $_POST['ingreso']
            ];

            echo json_encode($animales->actualizar($datos));
            break;

        case 'eliminar':
            echo json_encode($animales->eliminar($_POST['id']));
            break;

        case 'buscarPorID':
            echo json_encode($animales->buscarPorID($_POST['id']));
            break;

        case 'buscarPorEstado':
            echo json_encode($animales->buscarPorEstado($_POST['estado']));
            break;
    }
}
