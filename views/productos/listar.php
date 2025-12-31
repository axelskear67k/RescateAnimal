<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Animales - Diseño Moderno</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
  .card-animal {
    transition: transform 0.2s;
  }
  .card-animal:hover {
    transform: scale(1.03);
  }
  .card-img-top {
    height: 180px;
    object-fit: cover;
  }
</style>
</head>
<body>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lista de Animales</h1>
    <div>
      <a href="./crear.php" class="btn btn-primary">
        <i class="bi bi-card-checklist"></i> Registrar
      </a>
      <a href="./buscar.php" class="btn btn-secondary">
        <i class="bi bi-search"></i> Buscar
      </a>
    </div>
  </div>

  <div class="row" id="animales-grid">
    <!-- Contenido dinámico -->
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

  function cargarAnimales() {
    const datos = new FormData();
    datos.append("operacion", "listar");

    fetch('../../app/controllers/Animales.controller.php', { method: 'POST', body: datos })
    .then(res => res.json())
    .then(data => {
      const grid = document.querySelector("#animales-grid");
      grid.innerHTML = "";

      data.forEach(animal => {
        grid.innerHTML += `
          <div class="col-md-4 mb-4">
            <div class="card card-animal shadow-sm">
              <img src="/RescateAnimal/public/images/${animal.foto}?t=${new Date().getTime()}" class="card-img-top" alt="${animal.nombre}">
              <div class="card-body">
                <h5 class="card-title">${animal.nombre}</h5>
                <p><strong>Clasificación:</strong> ${animal.clasificacion}</p>
                <p><strong>Especie:</strong> ${animal.especie}</p>
                <p><strong>Raza:</strong> ${animal.raza}</p>
                <p><strong>Género:</strong> ${animal.genero}</p>
                <p><strong>Condiciones:</strong> ${animal.condiciones}</p>
                <p><strong>Vacunas:</strong> ${animal.vacunas}</p>
                <p><strong>Estado:</strong> ${animal.estado}</p>
                <p><strong>Ingreso:</strong> ${animal.ingreso}</p>
                <div class="d-flex justify-content-between mt-3">
                  <a href="editar.php?id=${animal.id}" class="btn btn-sm btn-info">
                    <i class="bi bi-pencil"></i> Editar
                  </a>
                  <button class="btn btn-sm btn-danger" onclick="eliminarAnimal(${animal.id})">
                    <i class="bi bi-trash"></i> Eliminar
                  </button>
                </div>
              </div>
            </div>
          </div>
        `;
      });
    })
    .catch(err => console.error("Error al cargar animales:", err));
  }

  cargarAnimales();
});

function eliminarAnimal(id) {
  if(!confirm(`¿Desea eliminar el registro con ID: ${id}?`)) return;

  const datos = new FormData();
  datos.append("operacion", "eliminar");
  datos.append("id", id);

  fetch('../../app/controllers/Animales.controller.php', { method: 'POST', body: datos })
  .then(res => res.text())
  .then(resp => {
    if(parseInt(resp) > 0) {
      alert("Registro eliminado correctamente");
      location.reload();
    } else {
      alert("No se pudo eliminar el registro");
    }
  })
  .catch(err => console.error("Error al eliminar:", err));
}
</script>

</body>
</html>

