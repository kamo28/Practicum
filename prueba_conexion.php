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
        include 'conexion.php';
        $conn = OpenCon();
        echo "<p>Hola</p>";
        $query = 'SELECT * FROM AdminsMaestros';
        $results = pg_query($conn, $query) or die('Query failed: ' . pg_last_error());
  
        while($line = pg_fetch_array($results, null, PGSQL_ASSOC)){
          echo "\t<tr>\n";
          foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
          }
          echo "\t</tr>\n";
        }
    ?>
</body>
</html>