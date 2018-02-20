<?php
/*
 * require_once para acceder al uso de las funciones y metodos de la clase
 * users y haciendo uso del patron singleton accedemos al metodo getUsuarios()
 * para mostrarlos, rimero asignamos el array a la variable data para a 
 * continuación recorrerlo con un foreach
 */
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    require_once '../class/users.class.php';
$users = users::singleton();
$data = $users->get_usuarios();
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
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>CRUD EN PHP CON LA EXTESION PDO</title>
        <link rel="stylesheet" type="text/css" href="../css/estilos.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/estilosLogin.css">
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.1/themes/ui-darkness/jquery-ui.css" />
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/funciones.js"></script>
    </head>
    <body>

        <h1>Crud con php y la extensión PDO</h1>


        <div class="tableComplete">
            <table id="customers">
                <tr>
                <div id="head_nombre"><th>Nombre</th></div>
                <div  id="head_email"><th>Email</th></div>
                <div  id="head_registro"><th>Fecha de registro</th></div>
                <div  id="head_editar"><th>Editar</th></div>
                <div  id="head_eliminar"><th>Eliminar</th></div>
                </tr>
                <?php
                foreach ($data as $fila):
                    ?>
                    <tr>
                    <div  id="body">
                        <td><div  id="nombre<?= $fila['id'] ?>"><?= $fila['nombre'] ?></div></td>
                        <td><div  id="email<?= $fila['id'] ?>"><?= $fila['email'] ?></div></td>
                        <td><div  id="registro<?= $fila['id'] ?>"><?= $fila['registro'] ?></div></td>
                        <td><div  id="editar"><input type="button" value="Editar" id="<?= $fila['id'] ?>" class="editar"></div></td>
                        <td><div  id="eliminar"><input type="button" value="Eliminar" id="<?= $fila['id'] ?>" class="eliminar"></div></td>

                    </div>
                    </tr>

                    <?php
                endforeach;
                ?>
                <button id="agregar" value="Añadir" id="<?= $fila['id'] ?>" class="agregar">Nuevo</button>
            </table>
            <br>

            <br>
        </div>

        <footer>
             &copy;2018 <a href="../instancias/logout.php">Cerrar Sesion</a>
        </footer>

    </body>
</html>
