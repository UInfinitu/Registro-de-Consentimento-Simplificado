<?php
session_start();

include "../conexao.php";

$email = htmlspecialchars($_POST["email"]);
$senha = htmlspecialchars($_POST["senha"]);

$sql = $pdo->prepare("SELECT idUsuario, nomeUsuario, emailUsuario, senhaUsuario FROM usuario WHERE emailUsuario = :email;");
$sql->bindParam(":email", $email);
$sql->execute();

$usuario = $sql->fetch();

if ("admin@dponet.com" === $email && "1234" === $senha) {
    $_SESSION['nome'] = "Admin";
    header("Location: admin.html");
    exit;
} else if ($usuario) {
    if ($senha === $usuario['senhaUsuario']) {
        $_SESSION['id'] = $usuario['idUsuario'];
        $_SESSION['nome'] = $usuario['nomeUsuario'];
        $_SESSION['email'] = $usuario['emailUsuario'];
        $_SESSION['senha'] = $usuario['senhaUsuario'];
        header("Location: cliente.php");
        exit;
    }
}

$_SESSION['error'] = "Usuário não encontrado ou senha incorreta. Tente novamente.";
header("Location: home.php");
exit;