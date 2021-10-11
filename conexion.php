<?php
  function OpenCon() {
    $dbhost = "fanny.db.elephantsql.com";
    $dbuser = "ovvcxygy";
    $dbpass = "mMF1CFaD2KK9nJcttuptKoSLgyz6eIQm";
    $dbname = "ovvcxygy";
    //$port = "5432";
    // $conn->set_charset("utf8");
    $conn = pg_connect("host=$dbhost port=$port dbname=$dbname user=$dbuser password=$dbpass")
            or die("No se pudo conectar al servidor");
    if($conn){
      echo "Se conectó correctamente";
    }else{
      echo "Ha ocurrido un problema";
    }

    /* try {
      $conn = new PDO ("pgsql: host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
      echo "Se conectó correctamente a la base de datos";
    }catch{
      echo ("No se pudo conectar a la base de datos," $exp);
    }*/
    return $conn; 
  }

  function CloseCon($conn) {
    pg_close($conn);
  }
?>
