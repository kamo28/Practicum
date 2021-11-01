<?php
 //archivo PHP que nos va a permitir hacer conexiones a nuestra base de datos de manera sencilla en cada una de las paginas que lo requiera
  function OpenCon() {
    //Estos son los parametros que se deben indicar para establecer una conexión con una base PSQL
    $dbhost = "fanny.db.elephantsql.com";
    $dbuser = "ovvcxygy";
    $dbpass = "mMF1CFaD2KK9nJcttuptKoSLgyz6eIQm";
    $dbname = "ovvcxygy";
    $port = "5432";
    // Se usa la funcion pg_connect para establecer la conexion
    $conn = pg_connect("host=$dbhost port=$port dbname=$dbname user=$dbuser password=$dbpass");
            //or die("No se pudo conectar al servidor");
    /*if($conn){
      echo "<p>Se conectó correctamente</p>";
    }else{
      echo "<p>Ha ocurrido un problema</p>";
    }*/
    return $conn;
  }
  // Se usa la funcion pg_close para terminar la conexion
  function CloseCon($conn) {
    pg_close($conn);
  }
?>
