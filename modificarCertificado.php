<?php
    //header con barra de navegacion
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
    //esta funcion solo nos ayuda a debuggear
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }
  //checar que el usuario tiene permiso de ver esta pagina
  //session_start();
  if(!isset($_SESSION['id_maestro'])){
     header("Location:Login.php");
  }
  if($_SESSION['rol']=='Maestro'){
     header("Location:error.php");
  }

  // definir ve inicializar variables, las variables de error tendran el error a mostrar en pantalla si este existe
  $idCertificado = $nombre = $apellidoPaterno = $apellidoMaterno = $evento = $fecha = $maestro = "";
  $idErr = $nombreErr = $paternoErr = $maternoErr = $eventoErr = $fechaErr = $maestroErr = "";
  //chear si el id del certificado se obtuvo de la pagina de solitudes o se busco desde esta misma pagina, esto lo define la variable de post utilizada
  if(isset($_POST['id_certificado'])){
    $idCertificado=$_POST['id_certificado'];
  }else{
    $idCertificado=$_POST['id_cert'];
  }
  //empezar conexion a base de datos
  include 'conexion.php';
  $con=OpenCon();
  //seleccionamos el certificado con el id correspondiente, este se obtienen normalmente desde solicitudCertificado, a traves del form que contiene el boton de modificar
  $result = pg_query($con, "SELECT * FROM certificados WHERE id_certificado = $idCertificado");
  //necesitamos la informacion de las columnas de este certifiacdo
  $row = pg_fetch_row($result);
  if(!$row){
      echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>No existe un certificado con ese ID</strong></div>';
  }else{
    //row[0]->id_certificado
    //row[1]->id_certificador
    //row[2]->id_usuario_certificado
    //row[3]->id_evento
    //row[4]->estado
    //Tenemos que acceder a las tablas de usuariosCertificados, adminsMaestros, y eventos para obtener la informacion completa del certificado
    //Esto lo hacemos a traves de las llaves foraneas que tiene la tabla de certificados
    $arrID = array($row[2]);
      if($queryUsuarios = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from usuarioscertificados where id_usuario=$1',$arrID)){
        //guardamos la informacion del usuario certificado, para que se despliegue automaticamente al cargar la pagina
        $nombre=pg_fetch_result($queryUsuarios,0,'nombres');
        $apellidoPaterno=pg_fetch_result($queryUsuarios,0,'apellido_paterno');
        $apellidoMaterno=pg_fetch_result($queryUsuarios,0,'apellido_materno');
        $arrEventoID = array($row[3]);
        if($queryEventos = pg_query_params($con,'SELECT nombre, fecha from eventos where id_evento=$1',$arrEventoID)){
          //guardamos la informacion del evento, para que se despliegue automaticamente al cargar la pagina
          $evento = pg_fetch_result($queryEventos,0,'nombre');
          $fecha = pg_fetch_result($queryEventos, 0, 'fecha');
          $maestroID = array($row[1]);
            if($queryMaestros = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from AdminsMaestros where id=$1',$maestroID)){
              //guardamos la informacion de la persona que tiene que autorizar, para que se despliegue automaticamente al cargar la pagina. Aqui se uso la concatenacion para unir los campor nombres, apellido_paterno y apellido_materno
              $maestro = pg_fetch_result($queryMaestros,0,'nombres') . " " . pg_fetch_result($queryMaestros,0,'apellido_paterno') . " " . pg_fetch_result($queryMaestros,0,'apellido_materno');
            }else{
              //estos mensajes nos ayudan a debug y a ver si hay problemas con los queries anteriormente utilizados
              echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
            }
        }else{
          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
        }
      }else{
        echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
      }
  }
  //cerramos la conexion
  CloseCon($con);
  //Estos ifs siguientes estan para asegurar que los campos tengan la informacion requerida
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
  //funcion para limpiar la informacion que ingresa el usuario, seguridad adicional para el sitio
  function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
?>

  <body>
    <div class="center-form", style="margin-left:auto; margin-right:auto; width:24em; padding-top:50px">
      <h2 style="text-align:center"> Modificar Solicud de Certficado</h2>
      <h4 style="padding-top:30px; padding-bottom:30px">Llena los siguientes datos acerca del certificado</h4>
      <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><!--Se hace el resto del codigo php incluido en esta pagina -->
        <?php
        //checamos si obtuvimos el id del certificado de la pagina de solicitudesCertificados
          if(!isset($_POST['id_certificado'])){
            echo '<div class="mb-3">
                    <label for="idMaestro" class="form-label">ID</label>
                    <input type="number" min="0" name="id_cert" class="form-control" value="' . $idCertificado . '">
                    <span class="error">* <?php echo $idErr;?></span>
                  </div>
                  <input type="submit" name="buscar" class="btn btn-primary" value="Buscar"><br><br><br>';
          }else{
            echo '<div class="mb-3">
                    <input type="hidden" name="id_cert" class="form-control" value="' . $idCertificado . '">';
          }
         ?>
        <!--En el value de los input ponemos las varibles que guardan la informacion del certificado obtenida anteriormente, para que se desplieguen automaticamente para el usuario-->
        <div class="mb-3">
          <label for="nombresMaestros" class="form-label">Nombre(s) de la persona certificada</label>
          <input type="text" class="form-control" id="nombresMaestros" name="nombre" value="<?php echo $nombre;?>">
          <span class="error">* <?php echo $nombreErr;?></span>
        </div>
        <div class="mb-3">
          <label for="apellidoPaterno" class="form-label">Apellido paterno de persona certificada</label>
          <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" value="<?php echo $apellidoPaterno;?>">
          <span class="error">* <?php echo $paternoErr;?></span>
        </div>
        <div class="mb-3">
          <label for="apellidoMaterno" class="form-label">Apellido materno de persona certificada</label>
          <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" value="<?php echo $apellidoMaterno;?>">
          <span class="error">* <?php echo $maternoErr;?></span>
        </div>
        <div class="mb-3">
          <label for="nombreEventos" class="form-label">Nombre del evento o razón del certificado</label>
          <input type="text" class="form-control" id="nombreEvento" name="evento" value="<?php echo $evento;?>">
          <span class="error">* <?php echo $eventoErr;?></span>
        </div>
        <div class="mb-3">
          <label for="fechaEvento" class="form-label">Fecha de realización del evento</label>
          <input type="date" class="form-control" id="fechaEvento" name="fecha" min="2015-10-03" value="<?php echo $fecha;?>">
          <span class="error">* <?php echo $fechaErr;?></span>
        </div>
        <div class="mb-3">
          <label>Selecciona a la persona que debe certificar</label>
          <input list="profesores" name="profesores" style="width:100%">
          <datalist id="profesores">
            <?php
            //este php nos permite obtener la lista de admins y maestros registrados en el sitio
            $con = OpenCon();
              $query = 'SELECT nombres, apellido_paterno, apellido_materno FROM AdminsMaestros';
              $results = pg_query($con, $query) or die('Query failed: ' . pg_last_error());
              while ($row = pg_fetch_array($results)) {
                echo "<option value='".$row[0]." ".$row[1]." ".$row[2]."'>\n";
              }
             ?>
          </datalist>
          <span class="error">* <?php echo $maestroErr;?></span>
        </div>
        <button type="submit" name="cambiar" class="btn btn-primary">Cambiar</button>
      </form>
    </div>
    <?php
    //checamos de nuevo de donde se obtiene el id del certificado, esto tambien nos ayuda a que cuando se recargue la pagina se vuelva a desplegar la informacion de los campos
      if(isset($_POST['id_certificado'])){
        $idCertificado=$_POST['id_certificado'];
      }else if(isset($_POST['buscar'])){
        $idCertificado=$_POST['id_cert'];
      }
      //checar si no hay campos vacios
      if(isset($_POST['cambiar'])
      && !empty($_POST["nombre"]) && !empty($_POST["apellidoPaterno"]) && !empty($_POST["apellidoMaterno"]) && !empty($_POST["evento"]) && !empty($_POST["fecha"])  && !empty($_POST["profesores"]))
      {
        $result = pg_query($con, "SELECT * FROM certificados WHERE id_certificado = $idCertificado");
        $row = pg_fetch_row($result);
        if(!$row){
            echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>No existe un certificado con ese ID</strong></div>';
        }else{
          //row[0]->id_certificado
          //row[1]->id_certificador
          //row[2]->id_usuario_certificado
          //row[3]->id_evento
          //row[4]->estado
          //hacemos los updates
            $arrParams = array($nombre,$apellidoPaterno, $apellidoMaterno, $row[2]);
            if($queryUsuarios2 = pg_query_params($con,
                                                'UPDATE usuarioscertificados
                                                 SET nombres = $1,
                                                     apellido_paterno=$2,
                                                     apellido_materno=$3
                                                 where id_usuario=$4'
                                                ,$arrParams))
              {
                //console_log("update de la tabla usuario correcto");
                $arrEventoParams = array($evento, $fecha, $row[3]);
                if($queryEventos2 = pg_query_params($con,
                                                    'UPDATE eventos
                                                     SET nombre = $1,
                                                         fecha=$2
                                                     where id_evento=$3'
                                                    ,$arrEventoParams))
                  {
                  //  console_log("update de ka tabla eventos correcto");
                    $arregloNombre = explode(" ", $maestro);
                    $length = count($arregloNombre);
                    $maternoP=$arregloNombre[$length-1];
                    $paternoP=$arregloNombre[$length-2];
                    $nombreP="";
                    for ($i=0; $i<$length-2; $i++){
                      $nombreP=$nombreP.$arregloNombre[$i]." ";
                    }
                    $nombreP = substr($nombreP, 0, -1);
                    $arrNombreMaestro=array($nombreP, $paternoP, $maternoP);
                      if($queryMaestros2=pg_query_params($con, 'SELECT id FROM AdminsMaestros WHERE nombres=$1 and apellido_paterno=$2 and apellido_materno=$3', $arrNombreMaestro)){
                        $idMaestro = pg_fetch_result($queryMaestros2,0,0);
                        $arrParamsCert = array($idMaestro, $idCertificado);
                        if($queryCertificado2 = pg_query_params($con,
                                                            'UPDATE certificados
                                                             SET id_certificador = $1
                                                             where id_certificado=$2'
                                                            ,$arrParamsCert))
                          {
                            //de nuevo, estos echos nos ayudan a ver errores en los queries
                              echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Actualizacion Correcta</strong></div>';
                          }else{
                            echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error #2 al cambiar la tabla certificados</strong></div>';
                          }
                      }else{
                          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error #1 al cambiar la tabla certificados</strong></div>';
                      }
                  }
              }else{
                echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al cambiar la tabla usuarios</strong></div>';
            }
        }
      }
     ?>

  </body>
</html>
