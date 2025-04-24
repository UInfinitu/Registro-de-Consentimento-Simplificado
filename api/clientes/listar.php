<?php

header('Content-Type: application/json');

include "../../conexao.php";

$sql = $pdo->prepare(
        "SELECT u.idUsuario, u.nomeUsuario, u.emailUsuario, u.senhaUsuario, COUNT(c.usuario_idUsuario) AS qtdConsentimentos
        FROM usuario u
        LEFT JOIN consentimentos c
                ON u.idUsuario = c.usuario_idUsuario
        GROUP BY u.idUsuario
        ORDER BY u.idUsuario;");

$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Se não existir finalidades, o array vai estar vazio
echo json_encode($resultado);