<?php
    require "header.php";
    //checar si hay filtro puesto o no
    if (isset($_POST['certs'])){
      $estado=$_POST['certs'];
    }else{
      $estado="";
    }
?>
    <h2 style="padding-bottom:20px; padding-top:20px; text-align:center">Solicitudes y Certificados Aprobados</h2>
    <!--Este es un filtro que nos ayuda a buscar certificados por su estado -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type='radio' name='certs' <?php if ($estado=="aprobados") echo "checked";?> value='aprobados' id="inlineRadio1" checked>
        <label class="form-check-label" for="inlineRadio1">Aprobados</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type='radio' name='certs' <?php if ($estado=="denegados") echo "checked";?> value='denegados' id="inlineRadio2">
        <label class="form-check-label" for="inlineRadio2">Denegados</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type='radio' name='certs' <?php if ($estado=="en revisión") echo "checked";?> value='en revisión' id="inlineRadio2">
        <label class="form-check-label" for="inlineRadio2">En revisión</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type='radio' name='certs' <?php if ($estado=="") echo "checked";?> value='all' id="inlineRadio3">
        <label class="form-check-label" for="inlineRadio3">Todos</label>
      </div>
        <button type='submit'>Filtrar</button>
  </form>
  <br>
  <br>
  <?php
      require 'conexion.php';
      $con = OpenCon();
      //Filtro, ver si esta puesto
      $estado="";
      //si esta puesto entonces buscamos por el tipo de estado especifico
      if(!empty($_POST['certs'])){
        $estado=$_POST['certs'];
      }
      if($estado=='aprobados'){
        $query = "SELECT * FROM certificados WHERE estado = 'aprobado'";
      }else if($estado=='denegados'){
        $query = "SELECT * FROM certificados WHERE estado = 'denegado'";
      }else if($estado=='en revisión'){
        $query = "SELECT * FROM certificados WHERE estado = 'en revisión'";
      }else{
        $query = "SELECT * FROM certificados";
      }
      //funcion de debugging
      function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
      }
      //checar permisos del usuario
      if(!isset($_SESSION['id_maestro'])){
         header("Location:Login.php");
      }
      if($_SESSION['rol']=='Maestro'){
         header("Location:error.php");
      }
      //estos arreglos nos ayudan a guardar la informacion de los certificados existentes en orden para desplegarla en pantalla
      $arregloMaestros = [];
      $arregloCertificados = [];
      $arregloEventos = [];
      $arregloEstados = [];
      $arregloIDCertificado = [];
      //$el query depende de si hay filtro o no
      $results = pg_query($con,$query) or die('Query Failed: ' . pg_last_error());
      while($row = pg_fetch_array($results)){
        $arrID = array($row['id_certificador']);
        if($queryMaestros = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from AdminsMaestros where id=$1',$arrID)){
          $nombre = pg_fetch_result($queryMaestros,0,'nombres') . " " . pg_fetch_result($queryMaestros,0,'apellido_paterno') . " " . pg_fetch_result($queryMaestros,0,'apellido_materno');
          //guardamos los nombres de los maestros que deben certificicar en arregloMaestros
          array_push($arregloMaestros, $nombre);
          $arrEventoID = array($row['id_evento']);
          if($queryEventos = pg_query_params($con,'SELECT nombre from eventos where id_evento=$1',$arrEventoID)){
            //guardamos el nombre de los eventos  existentes en arregloEventos
            array_push($arregloEventos, pg_fetch_result($queryEventos, 0, 'nombre'));
            $arrCertificadoID = array($row['id_usuario_certificado']);
            if($queryCertificado= pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from usuarioscertificados where id_usuario=$1',$arrCertificadoID)){
              $nombreCertificado = pg_fetch_result($queryCertificado,0,'nombres') . " " . pg_fetch_result($queryCertificado,0,'apellido_paterno') . " " . pg_fetch_result($queryCertificado,0,'apellido_materno');
              //guardamos el nombre de los usuarios certificados en arregloCertificados
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
        //guardamos los ids los certificados y los estados en sus arreglos correspondientes, aqui no hay necesidad de consultar otras tablas, estos se obtienen directamente del query inicial
        array_push($arregloIDCertificado, $row['id_certificado']);
        array_push($arregloEstados, $row['estado']);
      }
      //cerramos conexion
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
          //el ciclo while nos ayuda a recorrer los arreglos para desplegar cada uno de nuestros registros, podemos tomar cualquier arreglo para la longitud, pues todos tienen la misma
          while($contador<count($arregloMaestros)){
            echo "<tr>
                    <th scope='row'>" . $arregloIDCertificado[$contador] . "</th>
                    <td>".$arregloEventos[$contador]."</td>
                    <td>".$arregloCertificados[$contador]."</td>
                    <td>".$arregloMaestros[$contador]."</td>
                    <td>".$arregloEstados[$contador]."</td>";
                    //dependiendo del estado del certificado, el administrador tiene diferentes opciones
                    //si esta en revision, el admin puede modificar la informacion del mismo o borrar la solicitud
                    if($arregloEstados[$contador]=='en revisión'){
                      echo "<td>
                              <form name='myForm' role='form' action='modificarCertificado.php' method='post'>
                                <input type='hidden' name='id_certificado' value='".$arregloIDCertificado[$contador]."'>
                              <button type='submit'>Modificar</button>
                              </form>
                            </td>";
                      echo "<td>
                              <form name='myForm' role='form' action='includes/borrarCertificado.inc.php' method='post'>
                                <input type='hidden' name='id_certificado' value='".$arregloIDCertificado[$contador]."'>
                              <button type='submit'>Eliminar</button>
                              </form>
                            </td>";
                    //si es denegado, el admin solo puede borrar la solicitud
                    }else if($arregloEstados[$contador]=='denegado'){
                      echo "<td>
                            </td>";
                      //arreglar este boton
                      echo "<td>
                              <form name='myForm' role='form' action='includes/borrarCertificado.inc.php' method='post'>
                                <input type='hidden' name='id_certificado' value='".$arregloIDCertificado[$contador]."'>
                              <button type='submit'>Eliminar</button>
                              </form>
                            </td>";
                    //si esta aprobado, entonces el admin puede crear el documento pdf
                    }else{
                      echo '<td><a href=#>Ver Certificado</td>';
                      echo "<td>
                              <form name='myForm' role='form' action='includes/borrarCertificado.inc.php' method='post'>
                                <input type='hidden' name='id_certificado' value='".$arregloIDCertificado[$contador]."'>
                              <button type='submit'>Eliminar</button>
                              </form>
                            </td>";
                    }
            echo '</tr>';
            $contador++;
          }
        ?>
      </tbody>
    </table>
