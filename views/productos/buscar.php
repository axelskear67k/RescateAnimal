<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Consulta de Animales - Diseño Moderno</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
  body { background-color: #f8f9fa; }
  .card-search, .card-result { box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.2s; }
  .card-search:hover, .card-result:hover { transform: scale(1.01); }
  .card-header { background-color: #0d6efd; color: white; font-weight: 500; }
  .no-results { color: #dc3545; font-weight: 500; text-align: center; }
</style>
</head>
<body>

<div class="container mt-4">
  <h1 class="mb-4">Consulta de Animales</h1>
  <a href="./listar.php" class="btn btn-primary btn-sm mb-4">
    <i class="bi bi-table"></i> Ver Lista Completa
  </a>

  <!-- Búsqueda por ID -->
  <div class="card card-search mb-4">
    <div class="card-header">Buscar por ID</div>
    <div class="card-body">
      <form id="busquedaPorID" class="d-flex gap-2">
        <input type="number" class="form-control" id="animalID" placeholder="Ingrese el ID">
        <button type="submit" class="btn btn-success"><i class="bi bi-search"></i> Buscar</button>
      </form>

      <div class="mt-3" id="resultadoID">
        <!-- Resultados por ID -->
      </div>
    </div>
  </div>

  <!-- Búsqueda por Estado -->
  <div class="card card-search mb-4">
    <div class="card-header">Filtrar por Estado</div>
    <div class="card-body">
      <form id="busquedaPorEstado" class="d-flex gap-2">
        <select id="filtroEstado" class="form-select">
          <option value="">Seleccione estado</option>
          <option value="Disponible">Disponible</option>
          <option value="Adoptado">Adoptado</option>
          <option value="En tratamiento">En tratamiento</option>
        </select>
        <button type="submit" class="btn btn-success"><i class="bi bi-search"></i> Filtrar</button>
      </form>

      <div class="mt-3" id="resultadoEstado">
        <!-- Resultados por Estado -->
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const renderAnimales = (animales, container) => {
        const div = document.querySelector(container);
        div.innerHTML = "";
        if(animales.length){
            animales.forEach(a => {
                div.innerHTML += `
                <div class="card card-result mb-2 p-2">
                  <div class="row align-items-center">
                    <div class="col-md-1"><strong>ID:</strong> ${a.id}</div>
                    <div class="col-md-2"><strong>Clasificación:</strong> ${a.clasificacion}</div>
                    <div class="col-md-2"><strong>Nombre:</strong> ${a.nombre}</div>
                    <div class="col-md-2"><strong>Especie:</strong> ${a.especie}</div>
                    <div class="col-md-2"><strong>Raza:</strong> ${a.raza}</div>
                    <div class="col-md-1"><strong>Estado:</strong> ${a.estado}</div>
                    <div class="col-md-2 text-end">
                      <a href="./editar.php?id=${a.id}" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i></a>
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
        const id = document.querySelector("#animalID").value.trim();
        if(!id) return alert("Ingrese un ID válido.");

        const formData = new FormData();
        formData.append("operacion", "buscarPorID");
        formData.append("id", id);

        try {
            const res = await fetch("../../app/controllers/Animales.controller.php", { method: "POST", body: formData });
            const data = await res.json();
            renderAnimales(data, "#resultadoID");
        } catch(err){ console.error("Error en la búsqueda por ID:", err); }
    };

    const buscarPorEstado = async () => {
        const estado = document.querySelector("#filtroEstado").value;
        if(!estado) return alert("Seleccione un estado.");

        const formData = new FormData();
        formData.append("operacion", "buscarPorEstado");
        formData.append("estado", estado);

        try {
            const res = await fetch("../../app/controllers/Animales.controller.php", { method: "POST", body: formData });
            const data = await res.json();
            renderAnimales(data, "#resultadoEstado");
        } catch(err){ console.error("Error en la búsqueda por estado:", err); }
    };

    document.querySelector("#busquedaPorID").addEventListener("submit", e => { e.preventDefault(); buscarPorID(); });
    document.querySelector("#busquedaPorEstado").addEventListener("submit", e => { e.preventDefault(); buscarPorEstado(); });

});
</script>

</body>
</html>
