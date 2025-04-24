<?php

header('Content-Type: application/json');

include "../../conexao.php";

$finalidade = htmlspecialchars($_GET["finalidade"]);
$usuario = htmlspecialchars($_GET["usuario"]);
$dataAtual = date('Y-m-d');

$sql = $pdo->prepare("INSERT INTO consentimentos (usuario_idUsuario, finalidade_idFinalidade, dataConcessao) VALUES (:usuario, :finalidade, :data);");

$sql->bindParam(":usuario", $usuario);
$sql->bindParam(":finalidade", $finalidade);
$sql->bindParam(":data", $dataAtual);

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