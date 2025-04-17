<?php

header('Content-Type: application/json');

include "../../conexao.php";

$nome = htmlspecialchars($_POST["nome"]);
$email = htmlspecialchars($_POST["email"]);
$senha = md5(htmlspecialchars($_POST["senha"]));

$sql = $pdo->prepare("INSERT INTO usuario (nomeUsuario, emailUsuario, senhaUsuario) VALUES (:nome, :email, :senha);");

$sql->bindParam(":nome", $nome);
$sql->bindParam(":email", $email);
$sql->bindParam(":senha", $senha);

$resultado = $sql->execute();

if ($resultado) {
    echo json_encode([
        "status" => "success",
        "message" => "Usuário cadastrado com sucesso!"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao cadastrar novo usuário."
    ]);
}