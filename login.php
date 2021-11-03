<!DOCTYPE html >
<!--Pagina de Login-->
<html lang="es">
<head>
    <title>Inicio de sesión</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <br><br><br><br>
    <!-- <?php
        //se crea la sesion del usuario (maestro o admin)
        session_start();
        if($_SESSION['rol']=='Maestro'){
            header("Location: /PracticumCodigo/maestro/cert_solicitudes.php");
        }elseif($_SESSION['rol']=='Admin'){
            header("Location: /PracticumCodigo/inicio.php?login=success");
        }else{

            if(!isset($_SESSION['id_maestro'])){
                echo ' -->
                    <br><br>
                    <div class="container">
                        <div class="d-flex justify-content-center h-100">
                            <img src="resources/facultad_inge.png" alt="Texto Alternativo" style="width:auto;height:150px;border:0">
                        </div>
                    </div>
                    <br><br><br>
                    <div class="container">
                        <div class="d-flex justify-content-center h-100">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Inicio de sesión</h3>
                                </div>
                                <div class="card-body">
                                <form role="form" action="includes/login.inc.php" method="post">
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="idMaestro" id="idMaestro" placeholder="username">

                                    </div>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="password">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default" name="login-submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- ';
            }
        }

    ?> -->
</div>
</body>
</html>
