<?php

header('Content-Type: application/json');

include "../../conexao.php";

$id = htmlspecialchars($_GET["id"]);

$sql = $pdo->prepare("DELETE FROM finalidade WHERE idFinalidade = :id;");

$sql->bindParam(":id", $id);

$resultado = $sql->execute();

if ($resultado) {
    echo json_encode([
        "status" => "success",
        "message" => "Finalidade removida com sucesso."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao remover finalidade."
    ]);
}