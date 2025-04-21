<?php
session_start();

header('Content-Type: application/json');

include "../../conexao.php";

$id = htmlspecialchars($_POST["id"]);
$nome = htmlspecialchars($_POST["nome"]);
$email = htmlspecialchars($_POST["email"]);
$senha = htmlspecialchars($_POST["senha"]);

$sql = $pdo->prepare("UPDATE usuario SET nomeUsuario = :nome, emailUsuario = :email, senhaUsuario = :senha WHERE idUsuario = :id");

$sql->bindParam(":id", $id);
$sql->bindParam(":nome", $nome);
$sql->bindParam(":email", $email);
$sql->bindParam(":senha", $senha);

$resultado = $sql->execute();

if ($resultado) {
    echo json_encode([
        "status" => "success",
        "message" => "Cliente modificado com sucesso!"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao modficar cliente."
    ]);
}