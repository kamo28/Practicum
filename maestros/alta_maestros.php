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
    <!--Empieza barra de navegacion-->
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
    <!--Termina barra de navegacion-->
    <!--termina header-->
    <div class="container" style="height:50px"></div>
    <div class="center-form", style="margin-left:auto; margin-right:auto; width:24em; background">
      <h2 style="text-align:center"> Crear Nuevo Maestro</h2>
      <h3 style="text-align:center">Llena los siguientes datos del maestro que se va a crear</h3>
      <form>
        <!--ID-->
        <div class="mb-3">
          <label for="idMaestros" class="form-label">ID</label>
          <input type="text" class="form-control" id="nombresMaestros">
        </div>
        <!--Nombre-->
        <div class="mb-3">
          <label for="nombresMaestros" class="form-label">Nombre(s)</label>
          <input type="text" class="form-control" id="nombresMaestros">
        </div>
        <!--Apellido paterno-->
        <div class="mb-3">
          <label for="apellidoPaterno" class="form-label">Apellido paterno</label>
          <input type="text" class="form-control" id="apellidosMaestros">
        </div>
        <!--Apellido materno-->
        <div class="mb-3">
          <label for="apellidosMaestros" class="form-label">Apellido materno</label>
          <input type="text" class="form-control" id="apellidosMaestros">
        </div>
        <!--Puesto-->
        <div class="mb-3">
          <label for="puestoMaestros" class="form-label">Puesto (Coordinador, Maestro de planta, Administrativo)</label>
          <input type="text" class="form-control" id="puestoMaestros">
        </div>
        <!--Área-->
        <div class="mb-3">
          <label for="areaMaestros" class="form-label">Área (Matemáticas, Sistemas, Física)</label>
          <input type="text" class="form-control" id="areaMaestros">
        </div>
        <!--Rol-->
        <h5>Rol en el sitio</h5>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="rolMaestro">
          <label class="form-check-label" for="exampleCheck1">Maestro (Los maestros no pueden crear solicitudes de certificado, sólo autorizan)</label>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="rolMaestro">
          <label class="form-check-label" for="exampleCheck1">Administrador (Pueden crear solicitudes de certificado y crear nuevos usuarios)</label>
        </div>
        <!--Enviar información-->
        <button type="submit" class="btn btn-primary">Crear</button>
      </form>
    </div>
  </body>

</html>
