<?php

header('Content-Type: application/json');

include "../../conexao.php";

$finalidade = htmlspecialchars($_GET["finalidade"]);
$usuario = htmlspecialchars($_GET["usuario"]);

$sql = $pdo->prepare("DELETE FROM consentimentos WHERE usuario_idUsuario = :usuario AND finalidade_idFinalidade = :finalidade;");

$sql->bindParam(":usuario", $usuario);
$sql->bindParam(":finalidade", $finalidade);

$resultado = $sql->execute();

if ($resultado) {
    echo json_encode([
        "status" => "success",
        "message" => "Consentimento revogado com sucesso."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao revogar o consentimento."
    ]);
}