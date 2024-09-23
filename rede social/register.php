<?php
$servername = "localhost"; // ou o nome do servidor
$username = "seu_usuario"; // seu usuário do MySQL
$password = "sua_senha"; // sua senha do MySQL
$dbname = "acai_db"; // nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recebe dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Faz o hash da senha
$hashed_password = password_hash($senha, PASSWORD_DEFAULT);

// Prepara e vincula
$sql = "INSERT INTO usuarios (email, senha) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed_password);

if ($stmt->execute()) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
