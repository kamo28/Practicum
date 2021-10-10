<?php
    require "header.php"
?>
  <body>
    <div class="center-form", style="margin-left:auto; margin-right:auto; width:24em; padding-top:50px">
      <h2 style="text-align:center"> Crear Solicud de Certficado</h2>
      <h4 style="padding-top:30px; padding-bottom:30px">Llena los siguientes datos acerca del certificado</h4>
      <form>
        <div class="mb-3">
          <label for="nombresMaestros" class="form-label">Nombre(s) de la persona certificada</label>
          <input type="text" class="form-control" id="nombresMaestros">
        </div>
        <div class="mb-3">
          <label for="apellidoPaterno" class="form-label">Apellido paterno de persona certificada</label>
          <input type="text" class="form-control" id="apellidoPaterno">
        </div>
        <div class="mb-3">
          <label for="apellidoMaterno" class="form-label">Apellido materno de persona certificada</label>
          <input type="text" class="form-control" id="apellidoMaterno">
        </div>
        <div class="mb-3">
          <label for="nombreEventos" class="form-label">Nombre del evento o razón del certificado</label>
          <input type="text" class="form-control" id="nombreEvento">
        </div>
        <div class="mb-3">
          <label for="fechaEvento" class="form-label">Fecha de realización del evento</label>
          <input type="date" class="form-control" id="fechaEvento" min="2015-10-03">
        </div>
        <div class="mb-3">
          <label>Selecciona a la persona que debe certificar</label>
          <input list="profesores" name="profesores" style="width:100%">
          <datalist id="profesores">
            <option value="Miguel Ángel Méndez Méndez">
            <option value="Teresa Inestrillas">
            <option value="María del Carmen Villar Patiño">
          </datalist>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
</html>
