<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro de Personas - Diseño Moderno</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
  body {
    background-color: #f1f3f5;
  }
  .card-registro {
    border-left: 5px solid #0d6efd;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
  }
  .card-registro h5 {
    color: #0d6efd;
    margin-bottom: 20px;
  }
  .form-floating > label {
    font-weight: 500;
  }
</style>
</head>
<body>

<div class="container mt-5 mb-5">
  <h1 class="mb-4">Registrar Persona</h1>

  <a href="listarp.php" class="btn btn-outline-primary mb-4">
    <i class="bi bi-table"></i> Ver Lista de Personas
  </a>

  <form id="registroPersona">
    <div class="card card-registro p-4">
      <h5>Complete la información de la persona</h5>
      <div class="row g-3">

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="tipoPersona" class="form-control" placeholder="Ej: Voluntario" required>
            <label for="tipoPersona">Clasificación</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="nombrePersona" class="form-control" required>
            <label for="nombrePersona">Nombre</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="apellidosPersona" class="form-control" required>
            <label for="apellidosPersona">Apellidos</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="telefonoPersona" class="form-control" required>
            <label for="telefonoPersona">Teléfono</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="direccionPersona" class="form-control" required>
            <label for="direccionPersona">Dirección</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="number" id="animalID" class="form-control">
            <label for="animalID">ID Animal (opcional)</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="date" id="fechaRegistro" class="form-control" required>
            <label for="fechaRegistro">Fecha</label>
          </div>
        </div>

      </div>
      <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const formulario = document.querySelector("#registroPersona");

    formulario.addEventListener("submit", async (e) => {
        e.preventDefault();

        if(!confirm("¿Desea registrar esta persona?")) return;

        const datos = new FormData();
        datos.append("operacion", "registrar");
        datos.append("clasificacion", document.querySelector("#tipoPersona").value);
        datos.append("nombre", document.querySelector("#nombrePersona").value);
        datos.append("apellidos", document.querySelector("#apellidosPersona").value);
        datos.append("telefono", document.querySelector("#telefonoPersona").value);
        datos.append("direccion", document.querySelector("#direccionPersona").value);
        datos.append("idanimal", document.querySelector("#animalID").value);
        datos.append("fecha", document.querySelector("#fechaRegistro").value);

        try {
            const res = await fetch("../../app/controllers/Personas.controller.php", { method: "POST", body: datos });
            const resultado = await res.json();

            if(resultado.id > 0){
                formulario.reset();
                alert("Persona registrada correctamente");
            } else {
                alert("Error al registrar la persona");
            }
        } catch(err){
            console.error("Error al enviar los datos:", err);
        }
    });

});
</script>

</body>
</html>


