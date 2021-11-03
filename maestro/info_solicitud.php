<?php
    require "../header.php"
?>
<head>
    <title>Información sobre solicitud</title>
</head>

<style>
    .bar{width:100%;overflow:hidden}
    .bar .bar-item{padding:8px 16px;float:left;width:auto;border:none;display:block;outline:0}
    .bar .button{white-space:normal}
    .button:hover{color:#000!important;background-color:#ccc!important}
    .top,.bottom{position:static;width:100%;z-index:1}.top{top:0}.bottom{bottom:0}
    .white,.white:hover{color:#000!important;background-color:#fff!important}
    .wide{letter-spacing:4px}
    .padding{padding:8px 16px!important}
    .card{box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)}
    .right{float:right!important}
    .hide-small{display:none!important}
    a{background-color:transparent;color: black;font-size: large;}a:active,a:hover{outline-width:0}
</style>

    <!-- Button group -->
    <div class="container">
        <div class='wrapper text-center'>
            <div class="btn-group btn-group-lg">
                <a class="btn btn-primary" href="cert_solicitudes.php" role="button">Certificados solicitados</a>
            </div>
        </div>
    </div><br>

    <?php
      if(!isset($_SESSION['id_maestro'])){
         header("Location:../login.php");
      }
      $idCertificado = $nombre = $evento = $personaSolicita = $area = $puesto = "";
      //$idCertificadoErr = $nombreErr = $eventoErr = $personaSolicitaErr = $areaErr = $puestoErr = "";
      $idCertificado = $_POST['selection'];
      include '../conexion.php';
      $con = OpenCon();
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
        //row[5]->id_persona_que_solicita
        $arrID = array($row[2]);
          if($queryUsuarios = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from usuarioscertificados where id_usuario=$1',$arrID)){
            $nombre=pg_fetch_result($queryUsuarios,0,'nombres') . " " . pg_fetch_result($queryUsuarios,0,'apellido_paterno') . " " . pg_fetch_result($queryUsuarios,0,'apellido_materno') ;
            $arrEventoID = array($row[3]);
            if($queryEventos = pg_query_params($con,'SELECT nombre, fecha from eventos where id_evento=$1',$arrEventoID)){
              $evento = pg_fetch_result($queryEventos,0,'nombre');
              $fecha = pg_fetch_result($queryEventos, 0, 'fecha');
              $personaSolicitaID = array($row[5]);
                if($queryMaestros = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno, area, puesto from AdminsMaestros where id=$1',$personaSolicitaID)){
                  $personaSolicita = pg_fetch_result($queryMaestros,0,'nombres') . " " . pg_fetch_result($queryMaestros,0,'apellido_paterno') . " " . pg_fetch_result($queryMaestros,0,'apellido_materno');
                  $area = pg_fetch_result($queryMaestros,0,'area');
                  $puesto = pg_fetch_result($queryMaestros, 0, 'puesto');
                }else{
                  echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
                }
            }else{
              echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
            }
          }else{
            echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al hacer solicitud certificado, intenta de nuevo</strong></div>';
          }
      }
      CloseCon($con);
        /* $id=$_GET['seleccion'];
        include("../include/conexion.php");
        $con = OpenCon();
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $inicial=$subsecuente=" ";
        $sql="Select * from solicitud_analisis where ID_solicitud = $id;";
        $result= mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $lote=$row['ID_lote'];
        $cliente=$row['ID_cliente'];
        $query="Select * from resultados_analisis where ID_lote=$lote";
        $resultado= mysqli_query($con,$query);
        $row2 = mysqli_fetch_array($resultado);
        if($row2==NULL){
            $analisis="Inicial";
        }
        else{
            $analisis="Subsecuente";
        } */
    ?>
  <div class="container">
    <form action="accion.php" method="POST">
        <input type="hidden" class="form-control" name="id_cert" value="<?php echo $idCertificado?>"> 
        <br>
        <label for="solicitud"><h4>Nombre del acreditado:</h4></label>
<!--         <input type="number" class="form-control" name="solicitud" value="<?php echo $id?>" readonly>
-->        <input type="text" class="form-control" name="nombre_acreditado" value="<?php echo $nombre?>" readonly>

        <label for="lote"><h4>Evento:</h4></label>
<!--         <input type="number" class="form-control" name="lote" value="<?php echo $lote?>" readonly>
-->        <input type="text" class="form-control" name="evento" value="<?php echo $evento?>" readonly>

        <label for="cliente"><h4>Fecha del evento:</h4></label>
<!--         <input type="number" class="form-control" name="cliente" value="<?php echo $cliente?>" readonly>
-->        <input type="text" class="form-control" name="fecha" value="<?php echo $fecha?>" readonly>

        <label for="analisis"><h4>Solicitó el certificado:</h4></label><br>
<!--         <input type="text" class="form-control" name="anali" value="<?php echo $analisis?>" readonly>
-->        <input type="text" class="form-control" name="solicito" value="<?php echo $personaSolicita?>" readonly>

        <label for="analisis"><h4>Área de quien solicitó el certificado:</h4></label><br>
<!--         <input type="text" class="form-control" name="anali" value="<?php echo $analisis?>" readonly>
-->        <input type="text" class="form-control" name="area_solicito" value="<?php echo $area?>" readonly>

        <label for="analisis"><h4>Puesto de quien solicitó el certificado:</h4></label><br>
<!--         <input type="text" class="form-control" name="anali" value="<?php echo $analisis?>" readonly>
-->        <input type="text" class="form-control" name="puesto_solicito" value="<?php echo $puesto?>" readonly>
        <br>

        <input type="submit" name="accion" class="btn btn-success" value="Aprobar">
        <input type="submit" name="accion" class="btn btn-danger" value="Denegar">
    </form><br>

    </div>
</body>
</html>
