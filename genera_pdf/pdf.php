<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Facultad de Ingeniería de la Universidad Anáhuac México');
$pdf->SetTitle('Certificado');
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
$pdf->Image('../login_resources/uan.jpg', 128, 5, 40, 30, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);

$fontname1_regular = TCPDF_FONTS::addTTFfont('TCPDF/fonts/Extras/Merriweather/Merriweather-Regular.ttf', '', '', 32);
$fontname1_bold = TCPDF_FONTS::addTTFfont('TCPDF/fonts/Extras/Merriweather/Merriweather-Bold.ttf', '', '', 32);
$fontname3_italic = TCPDF_FONTS::addTTFfont('TCPDF/fonts/Extras/Open_Sans/OpenSans-Italic-VariableFont_wdth,wght.ttf', '', '', 32);
$fontname3_regular = TCPDF_FONTS::addTTFfont('TCPDF/fonts/Extras/Open_Sans/OpenSans-VariableFont_wdth,wght.ttf', '', '', 32);
//$html_f='<span style="font-family:'.$fontname.'.;font-weight:bold">my text in bold</span>: my normal text';
//$pdf->writeHTMLCell($w=0,$h=0,$x=11,$y=201,$html_f,$border=0,$ln=0,$fill=false,$reseth=true,$align='L',$autopadding=false);

$html3 = <<<EOD
<div>
    <div style="text-align:center">
        <h2 style="font-size:32px; font-family:'.$fontname1_regular.'; font-weight:regular">Facultad de Ingeniería</h2>
        <h4 style="line-height: 50%; font-size:14; font-family:'.$fontname1_regular.'; font-weight:regular">Otorga el presente</h4>
        <h1 style="font-size:42px; font-family:'.$fontname1_bold.'; font-weight:bold">RECONOCIMIENTO</h1>
        <h4 style="line-height: 0%; font-size:14px; font-family:'.$fontname1_regular.'; font-weight:regular">al</h4>
        <h3 style="line-height: 60%; font-size:32px; font-family: mrdafoe">Dios Daniel Sastre</h3>
        <h4 style="font-size:14px; font-family:'.$fontname1_regular.'; font-weight:regular">por su participación durante la Semana de Ingeniería 2015, con la conferencia</h4>
        <h3 style="font-size:20px; font-family: dejavusansb">"Si luchas por lo que sueñas lo conseguirás"</h3>
        <br>
        <h4 style="font-size:14px; font-family:'.$fontname1_regular.'; font-weight:regular">Huixquilucan, Estado de México a 16 de Abril de 2015.</h4>
    </div>

    <table border="0" cellspacing="3" cellpadding="4">
        <tr>
            <th align="center">
                <h4 style="font-size:14; font-family:'.$fontname1_regular.'; font-weight:regular">Fernando Corrales</h4>
                <p style="font-size:12; font-family:'.$fontname1_regular.'; font-weight:regular">Coordinador Académico de Ingeniería Mecatrónica</p>
            </th>
            <th>
            </th>
            <th></th>
            <th align="center">
                <h4 style="font-size:14; font-family:'.$fontname1_regular.'; font-weight:regular">Arinobu Okamoto</h4>
                <p style="font-size:12; font-family:'.$fontname1_regular.'; font-weight:regular">Director de la Facultad de Ingeniería</p>
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