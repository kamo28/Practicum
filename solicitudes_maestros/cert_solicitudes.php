<?php
    require "../header.php";
    if(!isset($_SESSION['id_maestro'])){
       header("Location:../login.php");
    }
?>

<head>
  <title>Certificados pendientes</title>
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
                <a class="btn btn-primary btn-lg active"  aria-pressed="true" href="cert_solicitudes.php" role="button">Certificados solicitados</a>
            </div>
        </div>
    </div><br>

    <div class="container">
        <h3>Certificados Solicitados</h3>
        <form  method="POST" action="info_solicitud.php">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre del acreditado</th>
                        <th>Evento</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        function console_log( $data ){
                          echo '<script>';
                          echo 'console.log('. json_encode( $data ) .')';
                          echo '</script>';
                        }
                        /* include("../include/conexion.php");
                        $con = OpenCon();
                        if (mysqli_connect_errno()) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }

                        $sql="Select * from solicitud_analisis where estatus='en proceso' ORDER BY urgencia DESC;";
                        $result= mysqli_query($con,$sql); */
                        /* while($row = mysqli_fetch_array($result)) {

                            $estado=$row['estatus'];

                            /* if($estado=="en proceso"){
                                $input="<input type='radio' class='form-check-input' name='seleccion' value=".$row['ID_solicitud']." required>";
                                echo "<tr class='alert alert-danger'>
                                        <td>".$row['ID_solicitud']."</td>
                                        <td>".$row['ID_cliente']."</td>
                                        <td>".$row['ID_lote']."</td>
                                        <td style='text-align: right;'>".$input."</td>
                                    </tr>";
                            } */
                        //}
                        require '../conexion.php';
                        $con = OpenCon();
                        $idMaestro = $_SESSION['id_maestro'];
                        //console_log($idMaestro);
                        $arregloIDCertificado = [];
                        $arregloCertificados = [];
                        $arregloEvento = [];
                        $arregloFechas = [];
                        $results = pg_query($con, "SELECT * FROM certificados WHERE id_certificador = $idMaestro AND estado='en revisión'");
                        while($row = pg_fetch_array($results)){
                          $usuarioIDarr = array($row['id_usuario_certificado']);
                            if($queryCertificado= pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from usuarioscertificados where id_usuario=$1',$usuarioIDarr)){
                              $nombreCertificado = pg_fetch_result($queryCertificado, 0, 'nombres') . " " . pg_fetch_result($queryCertificado, 0, 'apellido_paterno') . " " . pg_fetch_result($queryCertificado,0,"apellido_materno");
                              array_push($arregloCertificados, $nombreCertificado);
                              $arrEventoID = array($row['id_evento']);
                              if($queryEventos = pg_query_params($con,'SELECT nombre, fecha from eventos where id_evento=$1',$arrEventoID)){
                                $nombreEvento = pg_fetch_result($queryEventos, 0, 'nombre');
                                $fechaEvento = pg_fetch_result($queryEventos, 0, 'fecha');
                                array_push($arregloEvento, $nombreEvento);
                                array_push($arregloFechas, $fechaEvento);
                              }else{
                                echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al obtener informacion, intenta de nuevo</strong></div>';
                              }
                            }else{
                              echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al obtener informacion, intenta de nuevo</strong></div>';
                            }
                            array_push($arregloIDCertificado, $row['id_certificado']);
                        }
                        console_log($arregloCertificados);
                        console_log($arregloEvento);
                        console_log($arregloFechas);
                        console_log($arregloIDCertificado);
                        CloseCon($con);

                        $contador = 0;
                        while($contador<count($arregloCertificados)){
                          echo "<tr class='alert alert-danger'>
                                  <td>" . $arregloCertificados[$contador] . "</td>
                                  <td>" . $arregloEvento[$contador] . "</td>
                                  <td>" . $arregloFechas[$contador] . "</td>
                                  <td style='text-align: right;'>
                                    <input type = 'radio' class='form-check-input' name='selection' value='" . $arregloIDCertificado[$contador] . "'>
                                  </td>
                                </tr>";
                          $contador++;
                        }
                    ?>

                    <!--<tr class='alert alert-danger'>
                        <td>Fernando Corrales</td>
                        <td>Conferencia sobre la importancia del practicum</td>
                        <td>25/08/2032</td>
                        <td style='text-align: right;'>
                            <input type='radio' class='form-check-input' name='seleccion' value=".$row['ID_solicitud']." required>
                        </td>
                    </tr>-->

                </tbody>
            </table>
            <input type="submit" name="submit" class="btn btn-dark" value="Revisar solicitud de certificado" style="text-align:center">
        </form>
    </div>
</body>
</html>
