<?php
    require "header.php"
?>
    <h2 style="padding-bottom:20px; padding-top:20px; text-align:center">Solicitudes y Certificados Aprobados</h2>
    <form method="post">
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
  <?php
      function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
      }
      require 'conexion.php';
      $con = OpenCon();
      $arregloMaestros = [];
      $arregloCertificados = [];
      $arregloEventos = [];
      $arregloEstados = [];
      $arregloIDCertificado = [];
      $query = 'SELECT * from certificados';
      $results = pg_query($con,$query) or die('Query Failed: ' . pg_last_error());
      while($row = pg_fetch_array($results)){
        $arrID = array($row['id_certificador']);
        if($queryMaestros = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from AdminsMaestros where id=$1',$arrID)){
          $nombre = pg_fetch_result($queryMaestros,0,'nombres') . " " . pg_fetch_result($queryMaestros,0,'apellido_paterno') . " " . pg_fetch_result($queryMaestros,0,'apellido_materno');
          array_push($arregloMaestros, $nombre);
          $arrEventoID = array($row['id_evento']);
          if($queryEventos = pg_query_params($con,'SELECT nombre from eventos where id_evento=$1',$arrEventoID)){
            array_push($arregloEventos, pg_fetch_result($queryEventos, 0, 'nombre'));
            $arrCertificadoID = array($row['id_usuario_certificado']);
            if($queryCertificado= pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from usuarioscertificados where id_usuario=$1',$arrCertificadoID)){
              $nombreCertificado = pg_fetch_result($queryCertificado,0,'nombres') . " " . pg_fetch_result($queryCertificado,0,'apellido_paterno') . " " . pg_fetch_result($queryCertificado,0,'apellido_materno');
              array_push($arregloCertificados, $nombreCertificado);
            }else{
              echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
            }
          }else{
            echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
          }
        }else{
          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
        }
        array_push($arregloIDCertificado, $row['id_certificado']);
        array_push($arregloEstados, $row['estado']);
      }
      CloseCon($con);
      /*console_log($arregloMaestros);
      console_log($arregloEventos);
      console_log($arregloCertificados);
      console_log($arregloEstados);
      console_log($arregloIDCertificado);*/
   ?>
    <table class="table align-middle">
      <thead class="table-dark">
        <th scope="col">ID Certificado</th>
        <th scope="col">Nombre Evento</th>
        <th scope="col">Persona Certificada</th>
        <th scope="col">Persona que debe certificar</th>
        <th scope="col">Estado del Certificado</th>
        <th scope="col" colspan="2">Acciones</th>
      </thead>
      <tbody>
        <?php
          $contador = 0;
          while($contador<count($arregloMaestros)){
            echo "<tr>
                    <th scope='row'>" . $arregloIDCertificado[$contador] . "</th>
                    <td>".$arregloEventos[$contador]."</td>
                    <td>".$arregloCertificados[$contador]."</td>
                    <td>".$arregloMaestros[$contador]."</td>
                    <td>".$arregloEstados[$contador]."</td>";
                    if($arregloEstados[$contador]=='en revisión'){
                      //aqui tenemos que cambiar para que lleve a la pagina de modificacion de certificado
                      echo "<td>
                              <form name='myForm' role='form' action='modificarCertificado.php' method='post'>
                              <input type='hidden' name='id_certificado' value='".$arregloIDCertificado[$contador]."'>
                              <button type='submit'>Modificar</button>
                              </form>
                            </td>";
                      //arreglar este boton
                      //<input type='hidden' name='IDProducto' value='".$idP."'>
                      echo "<td>
                              <form name='myForm' role='form' action='includes/borrarCertificado.inc.php' method='post'>
                              <button type='submit'>Eliminar</button>
                              </form>
                            </td>";
                    }else{
                      echo '<td><a href=#>Ver Certificado</td>';
                    }
            echo '</tr>';
            $contador++;
          }
        ?>
        <!--<tr>
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
        </tr>-->
      </tbody>
    </table>
