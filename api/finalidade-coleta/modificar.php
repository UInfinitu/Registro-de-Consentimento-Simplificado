<?php

header('Content-Type: application/json');

include "../../conexao.php";

$id = htmlspecialchars($_POST["id"]);
$nome = htmlspecialchars($_POST["nome"]);
$descricao = htmlspecialchars($_GET["desc"]);

$sql = $pdo->prepare("UPDATE finalidade SET nomeFinalidade = :nome, descFinalidade = :descricao WHERE idFinalidade = :id");

$sql->bindParam(":id", $id);
$sql->bindParam(":nome", $nome);
$sql->bindParam(":descricao", $descricao);

$resultado = $sql->execute();

if ($resultado) {
    echo json_encode([
        "status" => "success",
        "message" => "Finalidade modificada com sucesso!"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao modficar finalidade."
    ]);
}