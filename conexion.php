<?php
  function OpenCon() {
    $dbhost = "fanny.db.elephantsql.com";
    $dbuser = "ovvcxygy";
    $dbpass = "mMF1CFaD2KK9nJcttuptKoSLgyz6eIQm";
    $dbname = "ovvcxygy";
    $port = "5432";
    // $conn->set_charset("utf8");
    $conn = pg_connect("host=$dbhost port=$port dbname=$dbname user=$dbuser password=$dbpass");
            //or die("No se pudo conectar al servidor");
    if($conn){
      echo "<p>Se conectó correctamente</p>";
    }else{
      echo "<p>Ha ocurrido un problema</p>";
    }
    return $conn;
  }

  function CloseCon($conn) {
    pg_close($conn);
  }
?>
