<?php

  if(isset($_POST['login-submit'])){
    require 'conexion.php';
    $con = OpenCon();
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    if(empty($usuario)||empty($contraseña)){
      header("Location: /DesarrolloSoftware/login.php?error=camposVacios"); #mejorar
      echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Los campos está vacíos</strong></div>';
      exit();
    }

    else{
      $sql = "SELECT * from usuarios where Usuario=?;";
      $stmt = mysqli_stmt_init($con);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: /DesarrolloSoftware/login.php?error=sqlerror");
        echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error de SQL</strong></div>';
        exit();
      }else{
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $pwdCheck = password_verify($contraseña, $row['Contraseña']);
            if($pwdCheck==false){
              header("Location: /DesarrolloSoftware/login.php?error=wrongPassword");
              echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Contraseña incorrecta</strong></div>';
              exit();
            }else if($pwdCheck==true){
              session_start();
              $_SESSION['usuario']=$row['Usuario'];
              $_SESSION['contraseña']=$row['Contraseña'];
              $_SESSION['rol'] = $row['Rol'];
              header("Location: /DesarrolloSoftware/inicio.php?login=success");
              exit();
            }else{
                header("Location: /DesarrolloSoftware/login.php?error=unexpectedError");
                echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error inesperado</strong></div>';
                exit();
            }
        }else{
          header("Location: /DesarrolloSoftware/login.php?error=nouser");
          echo '<br><br><div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert"> &times;</button><strong>Error de usuario</strong></div>';
          exit();
        }
      }
    }


  }else{
    header("Location /DesarrolloSoftware/login.php");
  }