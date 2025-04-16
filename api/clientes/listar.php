<?php

header('Content-Type: application/json');

include "../../conexao.php";

$sql = $pdo->prepare(
        "SELECT nomeUsuario, emailUsuario
        FROM usuario
        ORDER BY nomeUsuario;");

$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Se não existir finalidades, o array vai estar vazio
echo json_encode($resultado);