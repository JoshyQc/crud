<?php

session_start();

$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "login";
$tbl_name = "usuarios";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
    die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM $tbl_name WHERE Username = '$username'";

$result = $conexion->query($sql);



if ($result->num_rows > 0) {
    
}

$row = $result->fetch_array(MYSQLI_ASSOC);
$passwordV = $row['Password'];


if ($password == $passwordV) {
    
    
    
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    header('Location: ../instancias/panel-control.php');    
    
} else {
    header('Location: ../vista/reinicio.html');
}
mysqli_close($conexion);
?>