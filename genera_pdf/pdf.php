<?php
//obtenido de: https://mimentevuela.wordpress.com/2016/04/30/convertir-fechas-de-php-a-castellano/comment-page-1/
//funcion para imprimir fecha en castellano
function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
session_start();
if(!isset($_SESSION['id_maestro'])){
   header("Location:../login.php");
}

if(!isset($_POST['id_certificado'])){
  header("Location:../error.php");
}else{
  $nombreCertificado = $nombreSolicitador = $puestoSolicitador = $areaSolcitador = $nombreAutorizador  = $puestoAutorizador = $areaAutorizador = $fechaEvento = $evento ="";
  $idCertificado = $_POST['id_certificado'];
  include '../conexion.php';
  $con = OpenCon();
  $result = pg_query($con, "SELECT * FROM certificados WHERE id_certificado=$idCertificado");
  $row = pg_fetch_row($result);
  if(!$row){
    echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al buscar certificado</strong></div>';
  }else{
    //row[0]->id_certificado
    //row[1]->id_certificador
    //row[2]->id_usuario_certificado
    //row[3]->id_evento
    //row[4]->estado
    //row[5]->id_persona_que_solicita
    //row[6]->fecha_expedicion
    $fecha = $row[6];
    date_default_timezone_set('America/Mexico_City');
    $fechaEvento = date($fecha);
    $fechaEvento = fechaCastellano($fechaEvento);
    $arrID = array($row[2]);;
    if($queryUsuarios = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno from usuarioscertificados where id_usuario=$1',$arrID)){
      $nombreCertificado = pg_fetch_result($queryUsuarios,0,'nombres') . " " . pg_fetch_result($queryUsuarios,0,'apellido_paterno') . " " . pg_fetch_result($queryUsuarios,0,'apellido_materno');
      $arrEventoID = array($row[3]);
      if($queryEventos = pg_query_params($con,'SELECT nombre from eventos where id_evento=$1',$arrEventoID)){
        $evento = pg_fetch_result($queryEventos,0,'nombre');
        $maestroID = array($row[1]);
        if($queryMaestros = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno, puesto, area from AdminsMaestros where id=$1',$maestroID)){
          $nombreAutorizador = pg_fetch_result($queryMaestros,0,'nombres') . " " . pg_fetch_result($queryMaestros,0,'apellido_paterno') . " " . pg_fetch_result($queryMaestros,0,'apellido_materno');
          $puestoAutorizador=pg_fetch_result($queryMaestros,0,'puesto');
          $areaAutorizador=pg_fetch_result($queryMaestros,0,'area');
          $idSolicitador = array($row[5]);
          if($querySolicitante = pg_query_params($con,'SELECT nombres, apellido_paterno, apellido_materno, puesto, area from AdminsMaestros where id=$1',$idSolicitador)){
            $nombreSolicitador = pg_fetch_result($querySolicitante,0,'nombres') . " " . pg_fetch_result($querySolicitante,0,'apellido_paterno') . " " . pg_fetch_result($querySolicitante,0,'apellido_materno');
            $puestoSolicitador = pg_fetch_result($querySolicitante,0,'puesto');
            $areaSolcitador = pg_fetch_result($querySolicitante,0,'area');
            // Include the main TCPDF library (search for installation path).
            require_once('tcpdf_include.php');

            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Facultad de Ingeniería de la Universidad Anáhuac México');
            $pdf->SetTitle("Certificado $nombreCertificado");
            $pdf->SetSubject('Agradecimiento');
            $pdf->SetKeywords('Ingeniería, Anáhuac, Reconocimiento, Agradecimiento');

            // set default header data
            // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            /* $pdf->setFooterData(array(0,64,0), array(0,64,128)); */

            //remove default header/footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

            // set auto page breaks
            $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set default font subsetting mode
            $pdf->setFontSubsetting(true);

            // Set font
            // dejavusans is a UTF-8 Unicode font, if you only need to
            // print standard ASCII chars, you can use core fonts like
            // helvetica or times to reduce file size.
            //$pdf->SetFont('freeserifi', '', 14, '', true);

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            //$pdf->setCellHeightRatio(1.5);

            // set text shadow effect
            $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

            // Image example with resizing
            $pdf->Image('../resources/uan.jpg', 128, 5, 40, 30, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);

            $fontname1_regular = TCPDF_FONTS::addTTFfont('TCPDF/fonts/Extras/Merriweather/Merriweather-Regular.ttf', '', '', 32);
            $fontname1_bold = TCPDF_FONTS::addTTFfont('TCPDF/fonts/Extras/Merriweather/Merriweather-Bold.ttf', '', '', 32);
            $fontname3_italic = TCPDF_FONTS::addTTFfont('TCPDF/fonts/Extras/Open_Sans/OpenSans-Italic-VariableFont_wdth,wght.ttf', '', '', 32);
            $fontname3_regular = TCPDF_FONTS::addTTFfont('TCPDF/fonts/Extras/Open_Sans/OpenSans-VariableFont_wdth,wght.ttf', '', '', 32);
            //$html_f='<span style="font-family:'.$fontname.'.;font-weight:bold">my text in bold</span>: my normal text';
            //$pdf->writeHTMLCell($w=0,$h=0,$x=11,$y=201,$html_f,$border=0,$ln=0,$fill=false,$reseth=true,$align='L',$autopadding=false);

            //dejavusanscondensedb
            $html3 = <<<EOD
            <div>
                <div style="text-align:center">
                    <h2 style="font-size:32px; font-family:'.$fontname1_regular.'; font-weight:regular">Facultad de Ingeniería</h2>
                    <h4 style="line-height: 50%; font-size:14; font-family:'.$fontname1_regular.'; font-weight:regular">Otorga el presente</h4>
                    <h1 style="line-height: 120%; font-size:42px; font-family:'.$fontname1_bold.'; font-weight:bold">RECONOCIMIENTO</h1>
                    <h4 style="line-height: 20%; font-size:14px; font-family:'.$fontname1_regular.'; font-weight:regular">al</h4>
                    <h3 style="line-height: 120%; font-size:32px; font-family: pdfatimesi">$nombreCertificado</h3>
                    <h4 style="font-size:14px; font-family:'.$fontname1_regular.'; font-weight:regular">por su participación en el evento,</h4>
                    <h3 style="font-size:20px; font-family: dejavusansb">"$evento"</h3>
                    <br>
                    <h4 style="font-size:14px; font-family:'.$fontname1_regular.'; font-weight:regular">Huixquilucan, Estado de México, $fechaEvento.</h4>
                </div>

                <table border="0" cellspacing="3" cellpadding="4">
                    <tr>
                        <th align="center">
                            <h4 style="font-size:14; font-family:'.$fontname1_regular.'; font-weight:regular">$nombreSolicitador</h4>
                            <p style="font-size:10; font-family:'.$fontname1_regular.'; font-weight:regular">$puestoSolicitador<br> $areaSolcitador</p>
                        </th>
                        <th>
                        </th>
                        <th></th>
                        <th align="center">
                            <h4 style="font-size:14; font-family:'.$fontname1_regular.'; font-weight:regular">$nombreAutorizador</h4>
                            <p style="font-size:10; font-family:'.$fontname1_regular.'; font-weight:regular">$puestoAutorizador<br> $areaAutorizador</p>
                        </th>
                    </tr>
                </table>
            </div>

            EOD;

            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $html3, 0, 1, 0, true, '', true);

            // QRCODE,H : QR-CODE Best error correction
            $style = array(
                'border' => true,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
            $pdf->write2DBarcode('www.grhwergawef.org', 'QRCODE,H', 135, 155, 30, 30, $style, 'N');

            // ---------------------------------------------------------

            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            $pdf->Output('example_001.pdf', 'I');

            //============================================================+
            // END OF FILE
            //============================================================+
          }else{
            echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al buscar certificado(tabla adminsmaestros:solicitante)</strong></div>';
          }
        }else{
          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al buscar certificado(tabla adminsmaestros:certificador)</strong></div>';
        }
      }else{
        echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al buscar certificado(tabla eventos)</strong></div>';
      }
    }else{
      echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al buscar certificado(tabla usuarios)</strong></div>';
    }
  }
}
