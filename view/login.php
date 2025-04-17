<?php
session_start();

include "../conexao.php";

$email = htmlspecialchars($_POST["email"]);
$senha = htmlspecialchars($_POST["senha"]);

$sql = $pdo->prepare("SELECT nomeUsuario, emailUsuario, senhaUsuario FROM usuario WHERE emailUsuario = :email;");
$sql->bindParam(":email", $email);
$sql->execute();

$usuario = $sql->fetch();

if ("admin@dponet.com" === $email && "1234" === $senha) {
    $_SESSION['nome'] = "Admin";
    header("Location: admin.html");
    exit;
} else if ($usuario) {
    if (password_verify($senha, $usuario['senhaUsuario'])) {
        $_SESSION['nome'] = $usuario['nomeUsuario'];
        header("Location: cliente.html");
        exit;
    } else {
        $_SESSION['error'] = "Senha incorreta. Tente novamente.";
        header("Location: home.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Usuário não encontrado. Tente novamente.";
    header("Location: home.php");
    exit;
}
?>