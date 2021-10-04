<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/topMenu.css">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top>"
        <div class="container-fluid">
            <ul class="navbar-nav ml-auto">
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
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-file"></i>
                Certificados
              </a>
              <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <a class="dropdown-item" href="#">Nueva Solicitud de Certficado</a>
                <a class="dropdown-item" href="#">Modificar Solicitud de Certificado</a>
                <a class="dropdown-item" href="#">Eliminar Solicitud de Certificado</a>
              </div>
            </li>
            <li class="nav-item">
              <form role="form" action="http://localhost:8888/DesarrolloSoftware/include/logout.inc.php" method="post">
                <center><button type="submit" class="btn btn-info" name="logout-submit">Salir</button></center>
              </form>
            </li>
          </ul>
        </div>
      </nav>
      <br>
    </header>