<?php
  include "../header.php";
 ?>
  <head>
    <title> Alta de Maestros </title>
    <style>
      .error {color: #FF0000;}
    </style>
    <script>
    function limpiarInputs() {
       document.getElementById('idMaestro').value='';
       document.getElementById('nombreMaestro').value='';
       document.getElementById('apellidoPaterno').value='';
       document.getElementById('apellidoMaterno').value='';
       document.getElementById('puestoMaestro').value='';
       document.getElementById('areaMaestro').value='';
       document.getElementById('contraseñaMaestro').value='';
    }
    </script>
  </head>
  <?php
      // define variables and set to empty values
      $idMaestro = $nombreMaestro = $apellidoPaterno = $apellidoMaterno = $puestoMaestro = $rolMaestro = $areaMaestro = $contraseña = $verificar = "";
      $idErr = $nombreErr = $contraseñaErr = $paternoErr = $maternoErr = $puestoErr = $rolErr = $areaErr = $verificarErr = "";
//comprueba si los campos están llenos
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["idMaestro"])) {
              $idErr = "ID necesario";
          } else {
              $idMaestro= test_input($_POST["idMaestro"]);
          }
      }

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
         }

        CloseCon($con);
      }
    ?>

    <div class="container" style="height:50px"></div>
    <div class="center-form", style="margin-left:auto; margin-right:auto; width:24em; background">
      <h2 style="text-align:center">Eliminar maestro</h2>
      <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <!--ID-->
        <div class="mb-3">
          <label for="idMaestro" class="form-label">ID</label>
          <input type="number" min="0" class="form-control" name="idMaestro" value="<?php echo $idMaestro;?>">
          <span class="error">* <?php echo $idErr;?></span>
        </div>
        <input type="submit" name="buscar" class="btn btn-primary" value="Buscar"><br><br><br>

        <?php
        ?>

        <!--Nombre-->
        <div class="mb-3">
          <label for="nombreMaestro" class="form-label">Nombre(s)</label>
          <input type="text" class="form-control" id="nombreMaestro" name="nombreMaestro" value="<?php echo $nombreMaestro; ?>" disabled>
          <span class="error">* <?php echo $nombreErr;?></span>
        </div>
        <!--Apellido paterno-->
        <div class="mb-3">
          <label for="apellidoPaterno" class="form-label">Apellido paterno</label>
          <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" value="<?php echo $apellidoPaterno;?>" disabled>
          <span class="error">* <?php echo $paternoErr;?></span>
        </div>
        <!--Apellido materno-->
        <div class="mb-3">
          <label for="apellidoMaterno" class="form-label">Apellido materno</label>
          <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" value="<?php echo $apellidoMaterno;?>" disabled>
          <span class="error">* <?php echo $maternoErr;?></span>
        </div>

        <!--Enviar información-->
        <button type="submit" name="submit" class="btn btn-primary">Eliminar</button>
      </form>
    </div>

<?php
   //query para borrar
    if(isset($_POST['submit'])
    && !empty($_POST["idMaestro"])){

        include '../conexion.php';
        $con = OpenCon();

        $idMaestro = $_POST['idMaestro'];
        $result = pg_query($con, "SELECT * FROM AdminsMaestros WHERE id = $idMaestro");

        $query = "DELETE FROM AdminsMaestros WHERE id = $idMaestro ";
        if($result = pg_query($query)){
          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Usuario borrado correctamente</strong></div>';
          //Añadir función en JS que limpie todos los campos
          echo '<script>limpiarInputs();</script>';
        }else{
          echo '<div class="alert alert-warning alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error al borrar</strong></div>';
        }
        //header('Location: baja_maestros.php');
        //echo "<script type='text/javascript'>window.top.location='baja_maestros.php';</script>"; exit;
        CloseCon($con);
      }
    ?>
  </body>

</html>
