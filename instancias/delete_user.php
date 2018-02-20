<?php

/*
 * Hara intermediario entre la vista y el modelo, que en nuestro caso es
 * el archivo users.class.php
 * 
 * 
 * Si no existe la varaible "post id" mandamos de nuevo
 * al archivo index.php, en otro caso, se habra pulsado en 
 * el boton  y hacemos la peticion al archivo users.php
 * y en especifico a la funcion delete_usuarios($id) a la que
 * como vemos debemos pasarle la id del usuario a eliminar
 */

if (!isset($_POST['id'])) {
    header("Location: ../");
} else {
    require_once'../class/users.class.php';
    $usuarios = Users::singleton();

    $id = $_POST['id'];
    $usuarios->delete_usuario($id);
}
?>
