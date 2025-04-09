<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica se o formulário foi enviado
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $senhaConfirmacao = $_POST['senha_confirmacao'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $comentario = $_POST['mensagem'] ?? '';

        print_r($_POST); // Exibe os dados do formulário para depuração
    }
?>