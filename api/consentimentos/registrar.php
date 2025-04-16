<?php

header('Content-Type: application/json');

include "../../conexao.php";

$finalidade = htmlspecialchars($_GET["finalidade"]);
$usuario = htmlspecialchars($_GET["usuario"]);
$estado = htmlspecialchars($_GET["estado"] == true ? 1 : 0);

$sql = $pdo->prepare("INSERT INTO consentimentos (usuario_idUsuario, finalidade_idFinalidade, estado) VALUES (:usuario, :finalidade, :estado);");

$sql->bindParam(":usuario", $usuario);
$sql->bindParam(":finalidade", $finalidade);
$sql->bindParam(":estado", $estado);

$resultado = $sql->execute();

if ($resultado) {
    echo json_encode([
        "status" => "success",
        "message" => "Consentimento registrado com sucesso!"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao registrar o novo consentimento."
    ]);
}