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
    <form action="registro.php" method="$_GET"> 
        <br>
        <label for="solicitud"><h4>Nombre del acreditado:</h4></label>
<!--         <input type="number" class="form-control" name="solicitud" value="<?php echo $id?>" readonly>
 -->        <input type="text" class="form-control" name="nombre_acreditado" value="Fernando Corrales" readonly>

        <label for="lote"><h4>Evento:</h4></label>
<!--         <input type="number" class="form-control" name="lote" value="<?php echo $lote?>" readonly>
 -->        <input type="text" class="form-control" name="evento" value="Conferencia sobre la importancia del practicum" readonly>

        <label for="cliente"><h4>Fecha del evento:</h4></label>
<!--         <input type="number" class="form-control" name="cliente" value="<?php echo $cliente?>" readonly>
 -->        <input type="text" class="form-control" name="fecha" value="25/08/2035" readonly>

        <label for="analisis"><h4>Solicitó el certificado:</h4></label><br>
<!--         <input type="text" class="form-control" name="anali" value="<?php echo $analisis?>" readonly>
 -->        <input type="text" class="form-control" name="solicito" value="Gloria" readonly>

        <label for="analisis"><h4>Área de quien solicitó el certificado:</h4></label><br>
<!--         <input type="text" class="form-control" name="anali" value="<?php echo $analisis?>" readonly>
 -->        <input type="text" class="form-control" name="area_solicito" value="Coordinación" readonly>

        <label for="analisis"><h4>Puesto de quien solicitó el certificado:</h4></label><br>
<!--         <input type="text" class="form-control" name="anali" value="<?php echo $analisis?>" readonly>
 -->        <input type="text" class="form-control" name="puesto_solicito" value="Coordinadora" readonly>
        <br>

        <input type="submit" name="aprobar" class="btn btn-success" value="Aprobar certificado">
        <input type="submit" name="denegar" class="btn btn-danger" value="Denegar certificado">
    </form><br>

    <form action="cert_solicitudes.php">
        <input type="submit" class="btn btn-dark" name="submit" value="Regresar">
        </form>
    </div>
</body>
</html>