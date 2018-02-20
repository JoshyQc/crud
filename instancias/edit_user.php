<?php

$email = '';
$email_err = '';

if (!isset($_POST['email'])) {
    header("Location: ../");
} else {
    require '../class/users.class.php';

    $usuarios = Users::singleton();

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $nombre = $_POST['nombre'];


    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a valid email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = 'Please enter a valid email.';
    } else {
        $email = $input_email;
    }
    $registro = date('Y-m-d');
    $usuarios->update_usuario($id, $nombre, $email, $registro);
}
?>