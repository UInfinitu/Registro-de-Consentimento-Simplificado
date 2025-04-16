<?php

header('Content-Type: application/json');

include "../../conexao.php";

$sql = $pdo->prepare(
        "SELECT nomeFinalidade, descFinalidade
        FROM finalidade
        ORDER BY nomeFinalidade;");

$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Se não existir finalidades, o array vai estar vazio
echo json_encode($resultado);