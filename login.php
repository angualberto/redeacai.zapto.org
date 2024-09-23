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

// Função para verificar a complexidade da senha
function verificaSenha($senha) {
    $senhaRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/';
    return preg_match($senhaRegex, $senha);
}

// Verifica a complexidade da senha
if (!verificaSenha($senha)) {
    die("A senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais.");
}

// Consulta SQL
$sql = "SELECT senha FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verifica a senha
    if (password_verify($senha, $row['senha'])) {
        echo "Login bem-sucedido!";
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Email não encontrado.";
}

$stmt->close();
$conn->close();
?>
