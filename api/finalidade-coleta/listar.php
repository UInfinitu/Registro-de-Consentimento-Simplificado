<?php

header('Content-Type: application/json');

include "../../conexao.php";

$sql = $pdo->prepare(
        "SELECT f.idFinalidade, f.nomeFinalidade, f.descFinalidade, COUNT(c.finalidade_idFinalidade) AS qtdConsentimentos
        FROM finalidade f
        LEFT JOIN consentimentos c
                ON c.finalidade_idFinalidade = f.idFinalidade
        GROUP BY f.idFinalidade
        ORDER BY f.idFinalidade;");

$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Se não existir finalidades, o array vai estar vazio
echo json_encode($resultado);