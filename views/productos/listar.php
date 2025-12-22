
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animales</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Lista de Animales</h1>
    <a href="#" class = "btn btn-sm btn-primary">Registrar</a>
    <hr>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Clasificación</th>
          <th>Nombre</th>
          <th>Especie</th>
          <th>Raza</th>
          <th>Genero</th>
          <th>Condiciones</th>
          <th>Vacunas</th>
          <th>Estado</th>
          <th>Ingreso</th>
        </tr>

      </thead>
      <tbody>
        <!-- Contenido dinamico, viene desde la BD -->
      </tbody>
    </table>
  </div>
  <script>
    //Verificar que toda la pafgina este cargada
    document.addEventListener("DOMContentLoaded", function(){
      console.log("Pagina lista");
    })
  </script>
</body>
</html>