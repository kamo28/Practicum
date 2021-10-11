<?php
  include "../header.php";
 ?>
  <head>
    <title> Alta de Maestros </title>
  </head>
  <?php
      // define variables and set to empty values
      $idMaestro = $nombreMaestro = $apellidoPaterno = $apellidoMaterno = $puestoMaestro = $rolMaestro = $areaMaestro = $contraseña = $verificar = "";
      $idErr = $nombreErr = $contraseñaErr = $paternoErr = $maternoErr = $puestoErr = $rolErr = $areaErr = $verificarErr = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["idMaestro"])) {
              $idErr = "ID necesario";
          } else {
              $idMaestro= test_input($_POST["idMaestro"]);
          }
          if (empty($_POST["nombreMaestro"])) {
              $nombreErr = "Nombre necesario";
          } else {
              $nombreMaestro= test_input($_POST["nombreMaestro"]);
          }

          if(empty($_POST["apellidoPaterno"])){
              $paternoErr = "Apellido requerido";
          }else{
              $apellidoPaterno = test_input($_POST["apellidoPaterno"]);
          }

          if (empty($_POST["apellidoMaterno"])) {
              $maternoErr = "Apellido necesario";
          } else {
              $apellidoMaterno = test_input($_POST["apellidoMaterno"]);
          }

          if (empty($_POST["puestoMaestro"])) {
              $puestoErr = "Puesto necesario";
          } else {
              $puestoMaestro= test_input($_POST["puestoMaestro"]);
          }

          if(empty($_POST["areaMaestro"])){
              $areaErr = "Area necesaria";
          }else{
              $areaMaestro = test_input($_POST["areaMaestro"]);
          }

          if (empty($_POST["contraseñaMaestro"])) {
              $contraseñaErr = "Contraseña necesaria";
          } else {
              $contraseña = test_input($_POST["contraseñaMaestro"]);
          }
      }

      function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      }
  ?>
    <div class="container" style="height:50px"></div>
    <div class="center-form", style="margin-left:auto; margin-right:auto; width:24em; background">
      <h2 style="text-align:center"> Crear Nuevo Maestro</h2>
      <h3 style="text-align:center">Llena los siguientes datos del maestro que se va a crear</h3>
      <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!--ID-->
        <div class="mb-3">
          <label for="idMaestro" class="form-label">ID</label>
          <input type="text" class="form-control" id="idMaestro" name="idMaestro">
        </div>
        <!--Nombre-->
        <div class="mb-3">
          <label for="nombreMaestro" class="form-label">Nombre(s)</label>
          <input type="text" class="form-control" id="nombreMaestro" name="nombreMaestro">
        </div>
        <!--Apellido paterno-->
        <div class="mb-3">
          <label for="apellidoPaterno" class="form-label">Apellido paterno</label>
          <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno">
        </div>
        <!--Apellido materno-->
        <div class="mb-3">
          <label for="apellidoMaterno" class="form-label">Apellido materno</label>
          <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno">
        </div>
        <!--Puesto-->
        <div class="mb-3">
          <label for="puestoMaestro" class="form-label">Puesto (Coordinador, Maestro de planta, Administrativo)</label>
          <input type="text" class="form-control" id="puestoMaestro" name="puestoMaestro">
        </div>
        <!--Área-->
        <div class="mb-3">
          <label for="areaMaestro" class="form-label">Área (Matemáticas, Sistemas, Física)</label>
          <input type="text" class="form-control" id="areaMaestro" name="areaMaestro">
        </div>
        <!--Contraseña-->
        <div class="mb-3">
          <label for="contraseñaMaestro" class="form-label">Contraseña</label>
          <input type="text" class="form-control" id="contraseñaMaestro" name="contraseñaMaestro">
        </div>
        <!--Rol-->
        <h5>Rol en el sitio</h5>
        <div class="mb-3 form-check">
          <input type="radio" class="form-check-input" name="rolMaestro">
          <label class="form-check-label" for="rolMaestro">Maestro (Los maestros no pueden crear solicitudes de certificado, sólo autorizan)</label>
        </div>
        <div class="mb-3 form-check">
          <input type="radio" class="form-check-input" name="rolMaestro">
          <label class="form-check-label" for="rolMaestro">Administrador (Pueden crear solicitudes de certificado y crear nuevos usuarios)</label>
        </div>
        <!--Enviar información-->
        <button type="submit" class="btn btn-primary">Crear</button>
      </form>
    </div>
    <?php
        if(isset($_POST['submit'])
        && !empty($_POST["idMaestro"]) && isset($_POST["nombreMaestro"]) && !empty($_POST["apellidoPaterno"]) && !empty($_POST["apellidoMaterno"]) && !empty($_POST["puestoMaestro"]) && !empty($_POST["areaMaestro"]) && !empty($_POST["contraseñaMaestro"])
        ){

            //////////////////////////////////////////////////////////////////////////////////
            // Crear una conexión
            include 'conexion.php';
            $con = OpenCon();
            // escape variables for security
            /*$NombreUsuario = mysqli_real_escape_string($con, $_POST['nombre']);
            $fecha = mysqli_real_escape_string($con, $_POST['fecha']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $tarjeta = mysqli_real_escape_string($con, $_POST['tarjeta']);
            $direccion = mysqli_real_escape_string($con, $_POST['direccion']);
            $contraseña = mysqli_real_escape_string($con, $_POST['contraseña']);*/
            
            
            //$query="Insert into AdminsMaestros (id, contraseña, nombres, apellido_paterno, apellido_materno, rol, puesto, area) VALUES ($idMaestro,$contraseña,$nombreMaestro,$apellidoPaterno,$apellidoMaterno,$rolMaestro,$puestoMaestro,$areaMaestro)";
            //$result = pg_query($query) or die('Query failed: ' . pg_last_error());
            
            /* $res = pg_insert($con, 'AdminsMaestros', $_POST, PG_DML_ESCAPE);
            if ($res) {
              echo "POST data is successfully logged\n";
            } else {
              echo "User must have sent wrong inputs\n";
            } */
            //echo $row[0];


            $sql = "INSERT INTO AdminsMaestros VALUES('$idMaestro', '$contraseña', '$nombreMaestro', '$apellidoPaterno', '$apellidoMaterno', '$rolMaestro', '$puestoMaestro', '$areaMaestro')";
            pg_query($con, $sql);



            /*$stmt = mysqli_stmt_init($con);
            if(!mysqli_stmt_prepare($stmt, $sql)){
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              exit();
            }else{
              mysqli_stmt_bind_param($stmt, "s", $email);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_store_result($stmt);
              $resultCheck = mysqli_stmt_num_rows($stmt);
              if($resultCheck>0){
              echo "<p style=\"color:red; margin-left:125px;\">*Email ya utilizado, pruebe con otro</p>";
                exit();
              }else{
                  $sql = "INSERT INTO Usuario (Nombre_del_usuario, Correo_electronico, Contraseña, Fecha_de_Nacimiento, Numero_de_tarjeta_bancaria, Direccion_Postal) VALUES (?,?,?,?,?,?)";
                  $stmt = mysqli_stmt_init($con);
                  if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                  }else{
                    $hashedPwd = password_hash($contraseña, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssssis", $NombreUsuario, $email, $hashedPwd, $fecha, $tarjeta, $direccion);
                    mysqli_stmt_execute($stmt);
                    echo "<script type='text/javascript'>window.top.location='http://localhost/PHPProjects/DAWproyecto-main/php/registroCorrecto.php';</script>"; exit;
                    mysqli_close($con);
              }
            }
          }*/
        }
    ?>
  </body>

</html>
