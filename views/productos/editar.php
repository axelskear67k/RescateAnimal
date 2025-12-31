<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Animal - Interfaz Alternativa</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<style>
  body {
    background-color: #f1f3f5;
  }
  .card-edit {
    border-left: 5px solid #198754;
    margin-bottom: 20px;
  }
  .card-edit h5 {
    color: #198754;
    margin-bottom: 15px;
  }
  .form-label {
    font-weight: 600;
  }
</style>
</head>
<body>
<div class="container mt-5 mb-5">
  <h1 class="mb-4">Editar Animal</h1>

  <div id="referencia-animal"></div>

  <form id="form-editar">
    <div id="editar-animal"></div>
    <div class="text-end mt-3">
      <button type="submit" class="btn btn-success">Actualizar</button>
      <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const idAnimal = new URLSearchParams(window.location.search).get('id');

    function cargarDatos() {
        const formData = new FormData();
        formData.append('operacion', 'buscarPorID');
        formData.append('id', idAnimal);

        fetch('../../app/controllers/Animales.controller.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            if(!data || data.length === 0) return;
            const animal = data[0];

            document.querySelector("#referencia-animal").innerHTML = `
              <div class="card card-edit shadow-sm p-3">
                <h5>Referencia</h5>
                <p><strong>Clasificación:</strong> ${animal.clasificacion}</p>
                <p><strong>Nombre:</strong> ${animal.nombre}</p>
                <p><strong>Especie:</strong> ${animal.especie}</p>
                <p><strong>Raza:</strong> ${animal.raza}</p>
                <p><strong>Género:</strong> ${animal.genero}</p>
                <p><strong>Condiciones:</strong> ${animal.condiciones}</p>
                <p><strong>Vacunas:</strong> ${animal.vacunas}</p>
                <p><strong>Estado:</strong> ${animal.estado}</p>
                <p><strong>Ingreso:</strong> ${animal.ingreso}</p>
              </div>
            `;

            document.querySelector("#editar-animal").innerHTML = `
              <div class="card shadow-sm p-3 card-edit">
                <h5>Editar Datos</h5>
                <div class="mb-3">
                  <label class="form-label">Clasificación</label>
                  <input type="text" id="clasificacion" class="form-control" value="${animal.clasificacion}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Nombre</label>
                  <input type="text" id="nombre" class="form-control" value="${animal.nombre}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Especie</label>
                  <input type="text" id="especie" class="form-control" value="${animal.especie}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Raza</label>
                  <input type="text" id="raza" class="form-control" value="${animal.raza}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Género</label>
                  <input type="text" id="genero" class="form-control" value="${animal.genero}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Condiciones</label>
                  <input type="text" id="condiciones" class="form-control" value="${animal.condiciones}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Vacunas</label>
                  <input type="text" id="vacunas" class="form-control" value="${animal.vacunas}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Estado</label>
                  <input type="text" id="estado" class="form-control" value="${animal.estado}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Ingreso</label>
                  <input type="date" id="ingreso" class="form-control" value="${animal.ingreso}">
                </div>
              </div>
            `;
        });
    }

    cargarDatos();

    document.querySelector("#form-editar").addEventListener("submit", e => {
        e.preventDefault();
        if(!confirm("¿Desea actualizar este registro?")) return;

        const datos = new FormData();
        datos.append('operacion', 'actualizar');
        datos.append('id', idAnimal);
        datos.append('clasificacion', document.querySelector('#clasificacion').value);
        datos.append('nombre', document.querySelector('#nombre').value);
        datos.append('especie', document.querySelector('#especie').value);
        datos.append('raza', document.querySelector('#raza').value);
        datos.append('genero', document.querySelector('#genero').value);
        datos.append('condiciones', document.querySelector('#condiciones').value);
        datos.append('vacunas', document.querySelector('#vacunas').value);
        datos.append('estado', document.querySelector('#estado').value);
        datos.append('ingreso', document.querySelector('#ingreso').value);

        fetch('../../app/controllers/Animales.controller.php', { method: 'POST', body: datos })
        .then(res => res.json())
        .then(res => {
            if(res.id > 0){
                alert("Registro actualizado correctamente");
                window.location.href = 'listar.php';
            } else {
                alert("No se guardaron cambios");
            }
        });
    });
});
</script>
</body>
</html>



