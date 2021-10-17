<?php
    require "header.php"
?>
<head>
  <title>Nueva Solicitud de Certficado </title>
  <style>
    .error{color: #FF0000;}
  </style>
</head>
<?php
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
// define variables and set to empty values
$nombre = $apellidoPaterno = $apellidoMaterno = $evento = $fecha = $maestro = "";
$nombreErr = $paternoErr = $maternoErr = $eventoErr = $fechaErr = $maestroErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        $nombreErr = "Nombre necesario";
    } else {
        $nombre= test_input($_POST["nombre"]);
    }

    if(empty($_POST["apellidoPaterno"])){
        $paternoErr = "Apellido requerido";
    }else{
        $apellidoPaterno = test_input($_POST["apellidoPaterno"]);
    }

    if (empty($_POST["apellidoMaterno"])) {
        $maternoErr = "Apellido necesario";
    } else {
        $apellidoMaterno = test_input($_POST["apellidoMaterno"]);
    }

    if(empty($_POST["evento"])){
        $eventoErr = "Campo necesario";
    }else{
        $evento = test_input($_POST["evento"]);
    }

    if (empty($_POST["fecha"])) {
        $fechaErr = "Fecha necesaria";
    } else {
        $fecha = test_input($_POST["fecha"]);
    }

    if (empty($_POST["profesores"])) {
        $maestroErr = "Campo necesaro";
    } else {
        $maestro = test_input($_POST["profesores"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
  <body>
    <div class="center-form", style="margin-left:auto; margin-right:auto; width:24em; padding-top:50px">
      <h2 style="text-align:center"> Crear Solicud de Certficado</h2>
      <h4 style="padding-top:30px; padding-bottom:30px">Llena los siguientes datos acerca del certificado</h4>
      <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="mb-3">
          <label for="nombresMaestros" class="form-label">Nombre(s) de la persona certificada</label>
          <input type="text" class="form-control" id="nombresMaestros" name="nombre">
          <span class="error">* <?php echo $nombreErr;?></span>
        </div>
        <div class="mb-3">
          <label for="apellidoPaterno" class="form-label">Apellido paterno de persona certificada</label>
          <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno">
          <span class="error">* <?php echo $paternoErr;?></span>
        </div>
        <div class="mb-3">
          <label for="apellidoMaterno" class="form-label">Apellido materno de persona certificada</label>
          <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno">
          <span class="error">* <?php echo $maternoErr;?></span>
        </div>
        <div class="mb-3">
          <label for="nombreEventos" class="form-label">Nombre del evento o razón del certificado</label>
          <input type="text" class="form-control" id="nombreEvento" name="evento">
          <span class="error">* <?php echo $eventoErr;?></span>
        </div>
        <div class="mb-3">
          <label for="fechaEvento" class="form-label">Fecha de realización del evento</label>
          <input type="date" class="form-control" id="fechaEvento" name="fecha" min="2015-10-03">
          <span class="error">* <?php echo $fechaErr;?></span>
        </div>
        <div class="mb-3">
          <label>Selecciona a la persona que debe certificar</label>
          <input list="profesores" name="profesores" style="width:100%">
          <datalist id="profesores">
            <!--<option value="Miguel Ángel Méndez Méndez">
            <option value="Teresa Inestrillas">
            <option value="María del Carmen Villar Patiño">-->
            <?php
              include 'conexion.php';
              $con=OpenCon();
              $query = 'SELECT nombres, apellido_paterno, apellido_materno FROM AdminsMaestros';
              $results = pg_query($con, $query) or die('Query failed: ' . pg_last_error());
              while ($row = pg_fetch_array($results)) {
                echo "<option value='".$row[0]." ".$row[1]." ".$row[2]."'>\n";
              }
             ?>
          </datalist>
          <span class="error">* <?php echo $maestroErr;?></span>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Crear</button>
      </form>
    </div>
    <?php
    if(isset($_POST['submit'])
    && !empty($_POST["nombre"]) && !empty($_POST["apellidoPaterno"]) && !empty($_POST["apellidoMaterno"]) && !empty($_POST["evento"]) && !empty($_POST["fecha"])  && !empty($_POST["profesores"]))
    {
        //////////////////////////////////////////////////////////////////////////////////
        // Crear una conexión
        //include 'conexion.php';
        //$con = OpenCon();
        //$nombreCompleto = $_POST["profesores"];
        $arregloNombre = explode(" ", $maestro);
        $length = count($arregloNombre);
        $maternoP=$arregloNombre[$length-1];
        $paternoP=$arregloNombre[$length-2];
        $nombreP="";
        for ($i=0; $i<$length-2; $i++){
          $nombreP=$nombreP.$arregloNombre[$i]." ";
        }
        $nombreP = substr($nombreP, 0, -1);
        console_log($nombreP);
        console_log($maternoP);
        console_log($maternoP);
        $arrFinalNombre = array($nombreP, $paternoP, $maternoP);
        if($queryMaestros=pg_query_params($con, 'SELECT id FROM AdminsMaestros WHERE nombres=$1 and apellido_paterno=$2 and apellido_materno=$3', $arrFinalNombre)){
          $idMaestro= pg_fetch_result($queryMaestros,0,0);
          console_log($idMaestro);
          $paramsEvento = array($evento, $fecha);
          console_log($paramsEvento[0]);
          console_log($paramsEvento[1]);
          if(pg_query_params($con, 'INSERT into eventos values (default, $1, $2)', $paramsEvento)){
            $paramsUsuario = array($nombre, $apellidoPaterno, $apellidoMaterno);
            console_log($paramsUsuario[0]);
            console_log($paramsUsuario[1]);
            console_log($paramsUsuario[2]);
            if(pg_query_params($con, 'INSERT into usuarioscertificados values (default, $1, $2, $3)', $paramsUsuario)){
              if($query1=pg_query($con, 'SELECT id_evento FROM eventos ORDER BY id_evento DESC LIMIT 1')){
                $idEvento = pg_fetch_result($query1,0,0);
                console_log($idEvento);
                if($query2=pg_query($con, 'SELECT id_usuario FROM usuarioscertificados ORDER BY id_usuario DESC LIMIT 1')){
                  $idUsuario= pg_fetch_result($query2,0,0);
                  console_log($idUsuario);
                  $paramsCertificado = array($idMaestro, $idUsuario, $idEvento);
                   if(pg_query_params($con, 'INSERT into certificados values (default, $1, $2, $3)', $paramsCertificado)){
                    console_log("Solicitud correcta");
                    echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Se ha creado la solicitud de certificado, espera a que sea autorizado</strong></div>';
                  }else{
                    console_log("Error al insertar certificado");
                    echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
                  }
                }else{
                  console_log('error al buscarl el id del usuario');
                  echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
                }
              }else {
                console_log('error al buscarl el id del evento');
                echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
              }
            }else{
              console_log('error al insertar usuario certificado');
              echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
            }
          }else{
            console_log('error al insertar evento');
            echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
          }
        }else{
          console_log('error al buscar el id del maestro');
          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
        }

        /*$query1 = "Select id from AdminsMaestros where id=$idMaestro";
        $result1 = pg_query($con, $query1);
        $rows = pg_num_rows($result1);
        if($rows>0){
          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Ya existe un maestro/administrador con ese ID</strong></div>';
        }else{
          $hashedPwd = password_hash($contraseña, PASSWORD_DEFAULT);
          $query="Insert into AdminsMaestros (id, contraseña, nombres, apellido_paterno, apellido_materno, rol, puesto, area) VALUES ($idMaestro,'$hashedPwd','$nombreMaestro','$apellidoPaterno','$apellidoMaterno','$rolMaestro','$puestoMaestro','$areaMaestro')";
          $result = pg_query($query) or die('Query failed: ' . pg_last_error());
          echo "<script type='text/javascript'>window.top.location='alta_maestros.php';</script>"; exit;
        }
      /*include 'conexion.php';
      $con=OpenCon();
      $query = 'SELECT * FROM AdminsMaestros';
      $results = pg_query($con, $query) or die('Query failed: ' . pg_last_error());

      while($line = pg_fetch_array($results, null, PGSQL_ASSOC)){
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
          echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";*/

      }
    ?>
  </body>
</html>
