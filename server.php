<?php
// server.php

$instituicoesCadastradas = ['Instituição 1', 'Instituição 2'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = trim($_POST['nome']);
    $sobrenome = trim($_POST['sobrenome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $instituicao = trim($_POST['instituicao']);
    $nova_instituicao = trim($_POST['nova_instituicao']);
    $genero = trim($_POST['genero']);
    $status_civil = trim($_POST['status_civil']);
    $idade = (int)$_POST['idade'];
    $curso = trim($_POST['curso']);
    $bio = trim($_POST['bio']);

    // Se o usuário selecionou criar uma nova instituição, usa o nome dela
    if ($instituicao === 'nova' && !empty($nova_instituicao)) {
        $instituicao = $nova_instituicao;
    }

    // Verifica se a instituição já está cadastrada
    if (in_array($instituicao, $instituicoesCadastradas) && $instituicao !== $nova_instituicao) {
        echo "Essa instituição já está cadastrada.";
    } else {
        // Aqui você deve fazer a lógica para armazenar os dados no banco de dados
        // ...
        echo "Cadastro realizado com sucesso!";
    }
}
?>
