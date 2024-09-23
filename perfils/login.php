<?php
session_start();
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Aqui você faria uma consulta no banco de dados para validar o login.

$_SESSION['usuario'] = $usuario;
header("Location: perfil.php");
?>
