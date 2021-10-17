<?php
  include "../header.php";
 ?>
 
  <div class="container" style="height:50px"></div>
  <div class="center-form", style="margin-left:auto; margin-right:auto; width:24em; background">
    <h2 style="text-align:center">Eliminar maestro</h2>
    <form>

      <!--ID-->
      <div class="mb-3">
        <label for="idMaestros" class="form-label">ID</label>
        <input type="text" class="form-control" id="idMaestros">
      </div>
      <!--Nombre-->
      <div class="mb-3">
        <label for="nombresMaestros" class="form-label">Nombre(s)</label>
        <input type="text" class="form-control" id="nombresMaestros" disabled>
      </div>
      <!--Apellido paterno-->
      <div class="mb-3">
        <label for="apellidoPaterno" class="form-label">Apellido paterno</label>
        <input type="text" class="form-control" id="apellidosMaestros"
        disabled>
      </div>
      <!--Apellido materno-->
      <div class="mb-3">
        <label for="apellidosMaestros" class="form-label">Apellido materno</label>
        <input type="text" class="form-control" id="apellidosMaestros"
        disabled>
      </div>
      <!--Enviar información-->
      <button type="submit" class="btn btn-primary">Eliminar</button>
    </form>
  </div>
</body>

</html>
