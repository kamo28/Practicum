<?php
  session_start();
  require "../conexion.php";
  $con = OpenCon();
  $idCertificado = array($_POST['id_certificado']);
  if($query = pg_query_params($con, 'DELETE FROM certificados where id_certificado=$1', $idCertificado)){
    header("Location: ../admin/solicitudesCertificados.php?notify=CertificadoBorrado");
  }else {
    header("Location: ../admin/solicitudesCertificados.php?notify=Error");// code...
  }
 ?>
