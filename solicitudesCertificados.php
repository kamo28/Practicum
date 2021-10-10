<?php
    require "header.php"
?>
    <h2 style="padding-bottom:20px; padding-top:20px; text-align:center">Solicitudes y Certificados Aprobados</h2>
    <form method="post"">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type='radio' name='certs' value='aprobados' id="inlineRadio1" checked>
        <label class="form-check-label" for="inlineRadio1">Aprobados</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type='radio' name='certs' value='pendientes' id="inlineRadio2">
        <label class="form-check-label" for="inlineRadio2">Pendientes</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type='radio' name='certs' value='all' id="inlineRadio3">
        <label class="form-check-label" for="inlineRadio3">Todos</label>
      </div>
        <button type='submit'>Filtrar</button>
  </form>
    <table class="table align-middle">
      <thead class="table-dark">
        <th scope="col">#</th>
        <th scope="col">Nombre Evento</th>
        <th scope="col">Persona Certificada</th>
        <th scope="col">Persona que debe certificar</th>
        <th scope="col">Estado del Certificado</th>
        <th scope="col" colspan="2">Acciones</th>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Presentación de Ejemplo #1</td>
          <td>Daniel Sastré Villaseñor</td>
          <td>Miguel Ángel Méndez Méndez</td>
          <td>Certificado Aprobado</td>
          <td><a href=#>Ver Certificado</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Presentación de Ejemplo #2</td>
          <td>Daniel Sastré Villaseñor</td>
          <td>Miguel Ángel Méndez Méndez</td>
          <td>Certificado por aprobar</td>
          <td><a href=#>Modificar datos del certificado</td>
          <td><a href=#>Eliminar</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Presentación de Ejemplo #3</td>
          <td>Daniel Sastré Villaseñor</td>
          <td>Miguel Ángel Méndez Méndez</td>
          <td>Certificado Aprobado</td>
          <td><a href=#>Modificar datos del certificado</td>
          <td><a href=#>Eliminar</td>
        </tr>
      </tbody>
    </table>