<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Personas - Diseño Moderno</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
  .card-persona {
    transition: transform 0.2s;
  }
  .card-persona:hover {
    transform: scale(1.03);
  }
  .card-body p {
    margin-bottom: 0.3rem;
  }
</style>
</head>
<body>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Personas Registradas</h1>
    <div>
      <a href="./crearp.php" class="btn btn-primary">
        <i class="bi bi-card-checklist"></i> Registrar
      </a>
      <a href="./buscarp.php" class="btn btn-secondary">
        <i class="bi bi-search"></i> Buscar
      </a>
    </div>
  </div>

  <div class="row" id="personas-grid">
    <!-- Contenido dinámico -->
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

  function cargarPersonas() {
    const datos = new FormData();
    datos.append("operacion", "listar");

    fetch('../../app/controllers/Personas.controller.php', { method: 'POST', body: datos })
    .then(res => res.json())
    .then(data => {
      const grid = document.querySelector("#personas-grid");
      grid.innerHTML = "";

      data.forEach(persona => {
        grid.innerHTML += `
          <div class="col-md-4 mb-4">
            <div class="card card-persona shadow-sm">
              <div class="card-body">
                <h5 class="card-title">${persona.nombre} ${persona.apellidos}</h5>
                <p><strong>Clasificación:</strong> ${persona.clasificacion}</p>
                <p><strong>Teléfono:</strong> ${persona.telefono}</p>
                <p><strong>Dirección:</strong> ${persona.direccion}</p>
                <p><strong>ID Animal:</strong> ${persona.idanimal}</p>
                <p><strong>Fecha:</strong> ${persona.fecha}</p>
                <div class="d-flex justify-content-between mt-3">
                  <a href="./editarp.php?id=${persona.id}" class="btn btn-sm btn-info">
                    <i class="bi bi-pencil"></i> Editar
                  </a>
                  <button class="btn btn-sm btn-danger" onclick="eliminarPersona(${persona.id})">
                    <i class="bi bi-trash"></i> Eliminar
                  </button>
                </div>
              </div>
            </div>
          </div>
        `;
      });
    })
    .catch(err => console.error("Error al cargar personas:", err));
  }

  cargarPersonas();
});

function eliminarPersona(id) {
  if(!confirm(`¿Desea eliminar el registro con ID: ${id}?`)) return;

  const datos = new FormData();
  datos.append("operacion", "eliminar");
  datos.append("id", id);

  fetch('../../app/controllers/Personas.controller.php', { method: 'POST', body: datos })
  .then(res => res.text())
  .then(resp => {
    if(parseInt(resp) > 0) {
      alert("Registro eliminado correctamente");
      location.reload();
    } else {
      alert("No se pudo eliminar el registro");
    }
  })
  .catch(err => console.error("Error al eliminar persona:", err));
}
</script>

</body>
</html>

