<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Persona - Interfaz Alternativa</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<style>
  body {
    background-color: #f8f9fa;
  }
  .card-edit {
    border-left: 5px solid #0d6efd;
    margin-bottom: 20px;
  }
  .card-edit h5 {
    margin-bottom: 15px;
    color: #0d6efd;
  }
  .form-label {
    font-weight: 600;
  }
</style>
</head>
<body>
<div class="container mt-5 mb-5">
  <h1 class="mb-4">Editar Persona</h1>

  <div id="referencia-persona"></div>

  <form id="form-editar">
    <div id="editar-persona"></div>
    <div class="text-end mt-3">
      <button type="submit" class="btn btn-primary">Actualizar</button>
      <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const idPersona = new URLSearchParams(window.location.search).get('id');

    function cargarDatos() {
        const fdata = new FormData();
        fdata.append('operacion', 'buscarPorID');
        fdata.append('id', idPersona);

        fetch('../../app/controllers/Personas.controller.php', { method: 'POST', body: fdata })
        .then(res => res.json())
        .then(data => {
            if(!data || data.length === 0) return;
            const persona = data[0];

            // Registro actual
            document.querySelector("#referencia-persona").innerHTML = `
              <div class="card card-edit shadow-sm p-3">
                <h5>Referencia</h5>
                <p><strong>Clasificación:</strong> ${persona.clasificacion}</p>
                <p><strong>Nombre:</strong> ${persona.nombre} ${persona.apellidos}</p>
                <p><strong>Teléfono:</strong> ${persona.telefono}</p>
                <p><strong>Dirección:</strong> ${persona.direccion}</p>
                <p><strong>ID Animal:</strong> ${persona.idanimal}</p>
                <p><strong>Fecha:</strong> ${persona.fecha}</p>
              </div>
            `;

            // Formulario de edición
            document.querySelector("#editar-persona").innerHTML = `
              <div class="card shadow-sm p-3 card-edit">
                <h5>Editar Datos</h5>
                <div class="mb-3">
                  <label class="form-label">Clasificación</label>
                  <input type="text" id="clasificacion" class="form-control" value="${persona.clasificacion}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Nombre</label>
                  <input type="text" id="nombre" class="form-control" value="${persona.nombre}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Apellidos</label>
                  <input type="text" id="apellidos" class="form-control" value="${persona.apellidos}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Teléfono</label>
                  <input type="text" id="telefono" class="form-control" value="${persona.telefono}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Dirección</label>
                  <input type="text" id="direccion" class="form-control" value="${persona.direccion}">
                </div>
                <div class="mb-3">
                  <label class="form-label">ID Animal</label>
                  <input type="number" id="idanimal" class="form-control" value="${persona.idanimal}">
                </div>
                <div class="mb-3">
                  <label class="form-label">Fecha</label>
                  <input type="date" id="fecha" class="form-control" value="${persona.fecha}">
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
        datos.append('id', idPersona);
        datos.append('clasificacion', document.querySelector('#clasificacion').value);
        datos.append('nombre', document.querySelector('#nombre').value);
        datos.append('apellidos', document.querySelector('#apellidos').value);
        datos.append('telefono', document.querySelector('#telefono').value);
        datos.append('direccion', document.querySelector('#direccion').value);
        datos.append('idanimal', document.querySelector('#idanimal').value);
        datos.append('fecha', document.querySelector('#fecha').value);

        fetch('../../app/controllers/Personas.controller.php', { method: 'POST', body: datos })
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



