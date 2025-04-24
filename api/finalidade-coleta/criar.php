<?php

header('Content-Type: application/json');

include "../../conexao.php";

$nome = htmlspecialchars($_POST["nome"]);
$descricao = htmlspecialchars($_POST["desc"]);

$sql = $pdo->prepare("INSERT INTO finalidade (nomeFinalidade, descFinalidade) VALUES (:nome, :descricao);");

$sql->bindParam(":nome", $nome);
$sql->bindParam(":descricao", $descricao);

$resultado = $sql->execute();

if ($resultado) {
    echo json_encode([
        "status" => "success",
        "message" => "Finalidade criada com sucesso!"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao criar nova finalidade."
    ]);
}