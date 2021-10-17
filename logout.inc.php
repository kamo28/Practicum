<?php
//se destruye la sesion
session_start();
session_unset();
session_destroy();
header("Location: ../login.php");
