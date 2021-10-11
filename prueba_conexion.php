<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión PostgreSQL</title>
</head>
<body>
    <?php
        //include 'conexion.php';
        //$conn = OpenCon();
        /* $resultado = pg_query($conn, "SELECT * FROM AdminsMaestros");
        if(!$resultado){
            echo "<b>Error de búsqueda</b>";
        }
        $filas = pg_numrows($resultado);
        if($filas == 0){
            echo "No se encontró ning´n registro\n";
            exit;
        }else{
            echo "<ul>";
            for($cont = 0; $cont < $filas; $cont++){
                $campo1 = pg_result($resultado, $cont, 0);
            }
            echo "</ul>";
        } */
        phpinfo()
        //ini_set("extension", "pdo_pgsql");
        //ini_set("extension", "pdo_sqlite");
    ?>
</body>
</html>