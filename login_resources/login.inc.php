<?php
  if(isset($_POST['login-submit'])){
    require '../conexion.php';
    
    $con = OpenCon();
    $usuario = $_POST['idMaestro'];
    $contraseña = $_POST['contraseña'];

    if(empty($usuario)||empty($contraseña)){
      header("Location: /PracticumCodigo/login.php?error=camposVacios"); #mejorar
      echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Los campos está vacíos</strong></div>';
      exit();
    }

    else{
      /* $sql = "SELECT * from AdminsMaestros where id=?;"; */
      $query = "SELECT * FROM AdminsMaestros WHERE id = '$usuario'";
      $consulta = pg_query($con, $query);
      $cantidad = pg_num_rows($consulta);

      /* $stmt = mysqli_stmt_init($con); */
      if($cantidad > 0) {
        $query_contraseña = "SELECT contraseña FROM AdminsMaestros WHERE id = '$usuario'";
        $contraseña_valida = pg_query($con, $query_contraseña);
        if($row = pg_fetch_row($contraseña_valida)){
          $pwdCheck = password_verify($contraseña, $row[0]);
          if($pwdCheck==false){
            header("Location: /PracticumCodigo/login.php?error=wrongPassword");
            echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Contraseña incorrecta</strong></div>';
            exit();
          }else if($pwdCheck==true){
            session_start();
            /*$_SESSION['rol'] = $row['Rol']; */
            $_SESSION['id_maestro'] = $usuario;
            $_SESSION['contraseña'] = $contraseña;
            header("Location: /PracticumCodigo/inicio.php?login=success");
            exit();
          }else{
              header("Location: /PracticumCodigo/login.php?error=unexpectedError");
              echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error inesperado</strong></div>';
              exit();
          }
        }
      }else{
        header("Location: /PracticumCodigo/login.php?error=nouser");
        echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error de usuario</strong></div>';
        exit();
      }
    }
  }else{
    header("Location /PracticumCodigo/login.php");
  }