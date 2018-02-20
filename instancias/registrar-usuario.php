<?php

$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "login";
$tbl_name = "usuarios";

$form_pass = $_POST['password'];

$hash = password_hash($form_pass, PASSWORD_BCRYPT);

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
    die("La conexion falló: " . $conexion->connect_error);
}

$buscarUsuario = "SELECT * FROM $tbl_name
 WHERE Username = '$_POST[username]' ";

$result = $conexion->query($buscarUsuario);

$count = mysqli_num_rows($result);

if ($count == 1) {
    header("Location: /crudFinal/vista/usuarioRepetido.html");
    ;
} else {

    $query = "INSERT INTO usuarios (Username, Password)
           VALUES ('$_POST[username]', '$form_pass')";

    if ($conexion->query($query) === TRUE) {

        header("Location: ../index.html");
    } else {
        echo "Error al crear el usuario." . $query . "<br>" . $conexion->error;
    }
}
mysqli_close($conexion);
?>