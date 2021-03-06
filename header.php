<?php
//tomar la sesion actual
  session_start();
 ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--necesitamos el estilo y el js de bootstrap para utilizarlo en nuestra pagina web, ademas de fontwaesome para diversos tipos de texto-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <header>
      <!--Barra de nvegacion, nos apoyamos de las clases bootstrap para su diseño y funcionalidad -->
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top>"
        <div class="container-fluid">
          <a class="navbar-brand" href="http://localhost/PracticumCodigo/inicio.php">Ingeniería UAM</a><!--Pagina default de Inicio-->
          <ul class="navbar-nav ml-auto">
            <?php
            //La barra de navegacion debe desplegar diferentes opciones dependiendo del tipo de usuario del sitio
              if ($_SESSION['rol'] == "Admin") {
                echo '
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    Maestros
                  </a>
                  <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <a class="dropdown-item" href="/PracticumCodigo/admin/alta_maestros.php">Nuevo Maestro</a>
                    <a class="dropdown-item" href="/PracticumCodigo/admin/mod_maestros.php">Modificar Maestro</a>
                    <a class="dropdown-item" href="/PracticumCodigo/admin/baja_maestros.php">Borrar Maestro</a>
                  </div>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file"></i>
                    Certificados
                  </a>
                  <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <a class="dropdown-item" href="/PracticumCodigo/admin/nuevoCertificado.php">Nueva Solicitud de Certficado</a>
                    <a class="dropdown-item" href="/PracticumCodigo/admin/solicitudesCertificados.php">Ver Certificados</a>
                  </div>
                </li>';
              }

              /*}elseif ($_SESSION['rol'] == "Maestro") {
                echo '
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    Maestros
                  </a>
                  <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <a class="dropdown-item" href="#">Nuevo Maestro</a>
                    <a class="dropdown-item" href="#">Modificar Maestro</a>
                    <a class="dropdown-item" href="#">Borrar Maestro</a>
                  </div>
                </li>';
              }*/
            ?>

            <li class="nav-item">
              <form role="form" action="http://localhost/PracticumCodigo/includes/logout.inc.php" method="post"><!--PHP que va a terminar la sesión-->
                <center><button type="submit" class="btn btn-info" name="logout-submit">Salir</button></center>
              </form>
            </li>
          </ul>
        </div>
      </nav>
      <br>
    </header>
