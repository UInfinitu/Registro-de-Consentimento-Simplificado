<?php

header('Content-Type: application/json');

include "../../conexao.php";

if (isset($_GET["id"])){ // Visualização de consentimentos de um único usuário
    $id = htmlspecialchars($_GET["id"]);

    $sql = $pdo->prepare(
            "SELECT f.nomeFinalidade, f.descFinalidade, c.estado 
            FROM finalidade f 
            INNER JOIN consentimento c 
                ON f.idFinalidade = c.finalidade_idFinalidade 
            WHERE c.usuario_idUsuario = :id
            ORDER BY f.nomeFinalidade;");
    
    $sql->bindParam(":id", $id);
} else { // Visualização de consentimentos de todos os usuários
    $sql = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, c.estado 
        FROM finalidade f 
        INNER JOIN consentimento c 
            ON f.idFinalidade = c.finalidade_idFinalidade
        ORDER BY f.nomeFinalidade;");
}

$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Se não tiver consentimentos, o array vai estar vazio
echo json_encode($resultado);