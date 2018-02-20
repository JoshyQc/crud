<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
} else {
  header('Location: /crudFinal/vista/loginObligado.html');

    exit;
}

$now = time();

if ($now > $_SESSION['expire']) {
    session_destroy();

 header('Location: /crudFinal/vista/userError.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Panel de Control</title>
        <link rel="stylesheet" type="text/css" href="/crudFinal/css/estilosLogin.css"/>
    </head>

    <body>
        <h1>Opciones a Realizar!!</h1>
        <hr />
        <form action="../vista/table.php">
            <input id="iniciar" type="submit" value="Tabla " />
        </form>


        <hr>
        <br>


        <footer>
            &copy;2018 <a href="../instancias/logout.php">Cerrar Sesion</a>
        </footer>
    </body>
</html>
