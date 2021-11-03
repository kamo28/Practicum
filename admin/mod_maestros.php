<?php
  include "../header.php";
 ?>
  <head>
    <title> Modificar datos de Maestros </title>
    <style>
        .error {color: #FF0000;}
    </style>
  </head>
  <?php
      // define variables and set to empty values
      $idMaestro = $nombreMaestro = $apellidoPaterno = $apellidoMaterno = $puestoMaestro = $rolMaestro = $areaMaestro = $contraseña = $verificar = "";
      $idErr = $nombreErr = $contraseñaErr = $paternoErr = $maternoErr = $puestoErr = $rolErr = $areaErr = $verificarErr = "";

      //Comprobar que los campos estan llenos
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
          if (empty($_POST["rolMaestro"])) {
           $rolErr = "Rol necesario";
          } else {
           $rolMaestro = test_input($_POST["rolMaestro"]);
          }
      }

      //Eliminar espacios en blanco, slash inverso, convertir caracteres
      //especiales en entidades HTML
      function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      }
  ?>

    <?php
      if(isset($_POST['buscar']) && !empty($_POST["idMaestro"])){
        // Crear una conexión
        include '../conexion.php';
        $con = OpenCon();

        // escape variables for security
        $idMaestro = $_POST['idMaestro'];
        $result = pg_query($con, "SELECT * FROM AdminsMaestros WHERE id = $idMaestro");

        $arr = pg_fetch_assoc($result);
        if (!$arr) {
          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>No existe un maestro/administrador con ese ID</strong></div>';
        }else{
          $arr = pg_fetch_array($result, 0, PGSQL_BOTH);
          $nombreMaestro = $arr[2];
          $apellidoPaterno = $arr[3];
          $apellidoMaterno = $arr[4];
          $rolMaestro = $arr[5];
          $puestoMaestro = $arr[6];
          $areaMaestro = $arr[7];
        }

        CloseCon($con);
      }
    ?>

    <div class="container" style="height:50px"></div>
    <div class="center-form", style="margin-left:auto; margin-right:auto; width:24em;">
      <h2 style="text-align:center"> Modificar Maestro</h2>

      <?//Comienza formulario?>
      <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <!--ID-->
        <div class="mb-3">
          <label for="idMaestro" class="form-label">ID</label>
          <input type="number" min="0" name="idMaestro" class="form-control" value="<?php echo $idMaestro;?>">
          <span class="error">* <?php echo $idErr;?></span>
        </div>
        <input type="submit" name="buscar" class="btn btn-primary" value="Buscar"><br><br><br>

        <?php
        ?>


        <!--Nombre-->
        <div class="mb-3">
          <label for="nombreMaestro" class="form-label">Nombre(s)</label>
          <input type="text" class="form-control" id="nombreMaestro" name="nombreMaestro" value="<?php echo $nombreMaestro;?>">
          <span class="error">* <?php echo $nombreErr;?></span>
        </div>

        <!--Apellido paterno-->
        <div class="mb-3">
          <label for="apellidoPaterno" class="form-label">Apellido paterno</label>
          <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" value="<?php echo $apellidoPaterno;?>">
          <span class="error">* <?php echo $paternoErr;?></span>
        </div>

        <!--Apellido materno-->
        <div class="mb-3">
          <label for="apellidoMaterno" class="form-label">Apellido materno</label>
          <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" value="<?php echo $apellidoMaterno;?>">
          <span class="error">* <?php echo $maternoErr;?></span>
        </div>

        <!--Puesto-->
        <div class="mb-3">
          <label for="puestoMaestro" class="form-label">Puesto (Coordinador, Maestro de planta, Administrativo)</label>
          <input type="text" class="form-control" id="puestoMaestro" name="puestoMaestro" value="<?php echo $puestoMaestro;?>">
          <span class="error">* <?php echo $puestoErr;?></span>
        </div>

        <!--Área-->
        <div class="mb-3">
          <label for="areaMaestro" class="form-label">Área (Matemáticas, Sistemas, Física)</label>
          <input type="text" class="form-control" id="areaMaestro" name="areaMaestro" value="<?php echo $areaMaestro;?>">
          <span class="error">* <?php echo $areaErr;?></span>
        </div>

        <!--Rol-->
        <h5>Rol en el sitio</h5>
        <span class="error">* <?php echo $rolErr;?></span>
        <div class="mb-3 form-check">
          <input type="radio" class="form-check-input" name="rolMaestro" value="Maestro">
          <label class="form-check-label" for="rolMaestro">Maestro (Los maestros no pueden crear solicitudes de certificado, sólo autorizan)</label>
        </div>
        <div class="mb-3 form-check">
          <input type="radio" class="form-check-input" name="rolMaestro" value="Admin">
          <label class="form-check-label" for="rolMaestro">Administrador (Pueden crear solicitudes de certificado y crear nuevos usuarios)</label>
        </div>

        <!--Enviar información-->
        <button type="submit" name="cambiar" class="btn btn-primary">Guardar cambios</button>
      </form>
    </div>

    <?php
      //Si los campos están llenos se mandan los datos a la base datos
        if(isset($_POST['cambiar']) && !empty($_POST["nombreMaestro"]) && !empty($_POST["apellidoPaterno"]) && !empty($_POST["apellidoMaterno"]) && !empty($_POST["puestoMaestro"]) && !empty($_POST["areaMaestro"]) && !empty($_POST["rolMaestro"])
      ){
            echo "<p>hola</p>";
            //////////////////////////////////////////////////////////////////////////////////
            // Crear una conexión
            include '../conexion.php';
            $con = OpenCon();

            $query="UPDATE AdminsMaestros
                    SET nombres = '$nombreMaestro',
                        apellido_paterno = '$apellidoPaterno',
                        apellido_materno = '$apellidoMaterno',
                        rol = '$rolMaestro',
                        puesto = '$puestoMaestro',
                        area = '$areaMaestro'
                    WHERE id = $idMaestro;";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            header('Location: mod_maestros.php');
            echo "<script type='text/javascript'>window.top.location='mod_maestros.php';</script>"; exit;

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
