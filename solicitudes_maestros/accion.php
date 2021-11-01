<?php
    require "../header.php";
    require "../conexion.php";
    $con = OpenCon();
    if(isset($_POST['accion'])){
      if($_POST['accion']=='Aprobar'){
        $nuevoEstado = "aprobado";
      }else{
        $nuevoEstado = "denegado";
      }
      $idCertificado = $_POST['id_cert'];
      $updateParams = array($nuevoEstado, $idCertificado);
      if($updateQuery = pg_query_params($con,
                                        'UPDATE certificados
                                         SET estado = $1
                                         WHERE id_certificado = $2',
                                         $updateParams))
        {
          echo "<h1>El certificado ha sido $nuevoEstado correctamente</h1>";
          echo "<a href='cert_solicitudes.php'>Volver a mis solicitudes</a>";
        }
    }else{
      echo "Ha habido un error";
    }
 ?>
