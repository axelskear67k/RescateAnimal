<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Consulta de Personas - Diseño Moderno</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
  body {
    background-color: #f8f9fa;
  }
  .card-search, .card-result {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s;
  }
  .card-search:hover, .card-result:hover {
    transform: scale(1.01);
  }
  .card-header {
    background-color: #0d6efd;
    color: white;
    font-weight: 500;
  }
  .no-results {
    color: #dc3545;
    font-weight: 500;
    text-align: center;
  }
</style>
</head>
<body>

<div class="container mt-4">
  <h1 class="mb-4">Consulta de Personas</h1>
  <a href="listarp.php" class="btn btn-primary btn-sm mb-4">
    <i class="bi bi-table"></i> Ver Lista Completa
  </a>

  <!-- Búsqueda por ID -->
  <div class="card card-search mb-4">
    <div class="card-header">Buscar por ID</div>
    <div class="card-body">
      <form id="busquedaID" class="d-flex gap-2">
        <input type="number" class="form-control" id="personaID" placeholder="Ingrese el ID">
        <button type="submit" class="btn btn-success"><i class="bi bi-search"></i> Buscar</button>
      </form>

      <div class="mt-3" id="resultadoID">
        <!-- Resultados por ID -->
      </div>
    </div>
  </div>

  <!-- Búsqueda por Clasificación -->
  <div class="card card-search mb-4">
    <div class="card-header">Filtrar por Clasificación</div>
    <div class="card-body">
      <form id="busquedaClasificacion" class="d-flex gap-2">
        <select id="filtroClasificacion" class="form-select">
          <option value="">Seleccione</option>
          <option value="Voluntario">Voluntario</option>
          <option value="Adoptante">Adoptante</option>
          <option value="Veterinario">Veterinario</option>
          <option value="Donante">Donante</option>
        </select>
        <button type="submit" class="btn btn-success"><i class="bi bi-search"></i> Filtrar</button>
      </form>

      <div class="mt-3" id="resultadoClasificacion">
        <!-- Resultados por clasificación -->
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const renderPersonas = (personas, container) => {
        const div = document.querySelector(container);
        div.innerHTML = "";
        if(personas.length){
            personas.forEach(p => {
                div.innerHTML += `
                <div class="card card-result mb-2 p-2">
                  <div class="row align-items-center">
                    <div class="col-md-2"><strong>ID:</strong> ${p.id || '-'}</div>
                    <div class="col-md-2"><strong>Clasificación:</strong> ${p.clasificacion}</div>
                    <div class="col-md-2"><strong>Nombre:</strong> ${p.nombre}</div>
                    <div class="col-md-2"><strong>Apellidos:</strong> ${p.apellidos}</div>
                    <div class="col-md-2"><strong>Teléfono:</strong> ${p.telefono}</div>
                    <div class="col-md-2 text-end">
                      <strong>Acción:</strong> 
                      <a href="./editarp.php?id=${p.id}" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i></a>
                    </div>
                  </div>
                </div>
                `;
            });
        } else {
            div.innerHTML = `<div class="no-results">No se encontraron resultados</div>`;
        }
    };

    const buscarPorID = async () => {
        const id = document.querySelector("#personaID").value.trim();
        if(!id) return alert("Ingrese un ID válido");

        const datos = new FormData();
        datos.append("operacion", "buscarPorID");
        datos.append("id", id);

        try {
            const res = await fetch("../../app/controllers/Personas.controller.php", { method: "POST", body: datos });
            const personas = await res.json();
            renderPersonas(personas, "#resultadoID");
        } catch(err){
            console.error("Error al buscar por ID:", err);
        }
    };

    const buscarPorClasificacion = async () => {
        const clas = document.querySelector("#filtroClasificacion").value;
        if(!clas) return alert("Seleccione una clasificación");

        const datos = new FormData();
        datos.append("operacion", "buscarPorClasificacion");
        datos.append("clasificacion", clas);

        try {
            const res = await fetch("../../app/controllers/Personas.controller.php", { method: "POST", body: datos });
            const personas = await res.json();
            renderPersonas(personas, "#resultadoClasificacion");
        } catch(err){
            console.error("Error al filtrar por clasificación:", err);
        }
    };

    document.querySelector("#busquedaID").addEventListener("submit", e => { e.preventDefault(); buscarPorID(); });
    document.querySelector("#busquedaClasificacion").addEventListener("submit", e => { e.preventDefault(); buscarPorClasificacion(); });

});
</script>

</body>
</html>

