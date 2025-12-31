<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro de Animales - Diseño Moderno</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
  body {
    background-color: #f8f9fa;
  }
  .card-registro {
    border-left: 5px solid #198754;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  }
  .card-registro h5 {
    color: #198754;
    margin-bottom: 20px;
  }
  .form-floating > label {
    font-weight: 500;
  }
</style>
</head>
<body>

<div class="container mt-5 mb-5">
  <h1 class="mb-4">Registrar Animal</h1>

  <a href="listar.php" class="btn btn-outline-success mb-4">
    <i class="bi bi-table"></i> Ver Lista de Animales
  </a>

  <form id="registroAnimal">
    <div class="card card-registro p-4">
      <h5>Complete la información del animal</h5>
      <div class="row g-3">

        <div class="col-md-6">
          <div class="form-floating">
            <select id="categoriaAnimal" class="form-select" required>
              <option value="">Seleccione</option>
              <option value="Cachorro">Cachorro</option>
              <option value="Adulto">Adulto</option>
              <option value="Senior">Senior</option>
              <option value="Discapacitado">Discapacitado</option>
            </select>
            <label for="categoriaAnimal">Clasificación</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="nombreAnimal" class="form-control" required>
            <label for="nombreAnimal">Nombre</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="especieAnimal" class="form-control" required>
            <label for="especieAnimal">Especie</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="razaAnimal" class="form-control" required>
            <label for="razaAnimal">Raza</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="generoAnimal" class="form-control" required>
            <label for="generoAnimal">Género</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="condicionAnimal" class="form-control" required>
            <label for="condicionAnimal">Condiciones de Salud</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="vacunaAnimal" class="form-control" required>
            <label for="vacunaAnimal">Vacunas</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" id="estadoAnimal" class="form-control" required>
            <label for="estadoAnimal">Estado</label>
          </div>
        </div>

      </div>
      <div class="text-end mt-4">
        <button type="submit" class="btn btn-success">Guardar</button>
        <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const formulario = document.querySelector("#registroAnimal");

    formulario.addEventListener("submit", async (e) => {
        e.preventDefault();

        if(!confirm("¿Desea registrar este animal?")) return;

        const datos = new FormData();
        datos.append("operacion", "registrar");
        datos.append("clasificacion", document.querySelector("#categoriaAnimal").value);
        datos.append("nombre", document.querySelector("#nombreAnimal").value);
        datos.append("especie", document.querySelector("#especieAnimal").value);
        datos.append("raza", document.querySelector("#razaAnimal").value);
        datos.append("genero", document.querySelector("#generoAnimal").value);
        datos.append("condiciones", document.querySelector("#condicionAnimal").value);
        datos.append("vacunas", document.querySelector("#vacunaAnimal").value);
        datos.append("estado", document.querySelector("#estadoAnimal").value);

        try {
            const res = await fetch("../../app/controllers/Animales.controller.php", { method: "POST", body: datos });
            const resultado = await res.json();

            if(resultado.id > 0){
                formulario.reset();
                alert("Animal registrado correctamente");
            } else {
                alert("Error al registrar el animal");
            }
        } catch(err){
            console.error("Error al enviar los datos:", err);
        }
    });

});
</script>

</body>
</html>
