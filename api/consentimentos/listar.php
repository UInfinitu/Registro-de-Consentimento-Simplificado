<?php

header('Content-Type: application/json');

include "../../conexao.php";

if (isset($_GET["id"])) { // Visualização de consentimentos de um único usuário
    $id = htmlspecialchars($_GET["id"]);

    $sqlAsc = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, c.estado 
        FROM finalidade f 
        INNER JOIN consentimentos c 
            ON f.idFinalidade = c.finalidade_idFinalidade 
        WHERE c.usuario_idUsuario = :id
        ORDER BY f.nomeFinalidade ASC;"
    );
    
    $sqlDesc = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, c.estado 
        FROM finalidade f 
        INNER JOIN consentimentos c 
            ON f.idFinalidade = c.finalidade_idFinalidade 
        WHERE c.usuario_idUsuario = :id
        ORDER BY f.nomeFinalidade DESC;"
    );
    
    $sqlMaiorTaxaConsentimento = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, COUNT(c.finalidade_idFinalidade) AS quantidade
        FROM finalidade f
        INNER JOIN consentimentos c
            ON f.idFinalidade = c.finalidade_idFinalidade
        WHERE c.estado = 1 AND c.usuario_idUsuario = :id
        GROUP BY f.nomeFinalidade, f.descFinalidade
        ORDER BY quantidade DESC;"
    );
        
    $sqlMenorTaxaConsentimento = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, COUNT(c.finalidade_idFinalidade) AS quantidade
        FROM finalidade f
        INNER JOIN consentimentos c
            ON f.idFinalidade = c.finalidade_idFinalidade
        WHERE c.estado = 1 AND c.usuario_idUsuario = :id
        GROUP BY f.nomeFinalidade, f.descFinalidade
        ORDER BY quantidade ASC;"
    );
    
    $sqlAsc->bindParam(":id", $id);
    $sqlDesc->bindParam(":id", $id);
    $sqlMaiorTaxaConsentimento->bindParam(":id", $id);
    $sqlMenorTaxaConsentimento->bindParam(":id", $id);
} else { // Visualização de consentimentos de todos os usuários
    $sqlAsc = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, c.estado 
        FROM finalidade f 
        INNER JOIN consentimentos c 
            ON f.idFinalidade = c.finalidade_idFinalidade
        ORDER BY f.nomeFinalidade ASC;"
    );

    $sqlDesc = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, c.estado 
        FROM finalidade f 
        INNER JOIN consentimentos c 
            ON f.idFinalidade = c.finalidade_idFinalidade
        ORDER BY f.nomeFinalidade DESC;"
    );

    $sqlMaiorTaxaConsentimento = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, COUNT(c.finalidade_idFinalidade) AS quantidade
        FROM finalidade f
        INNER JOIN consentimentos c
            ON f.idFinalidade = c.finalidade_idFinalidade
        WHERE c.estado = 1
        GROUP BY f.nomeFinalidade, f.descFinalidade
        ORDER BY quantidade DESC;"
    );
    
    $sqlMenorTaxaConsentimento = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, COUNT(c.finalidade_idFinalidade) AS quantidade
        FROM finalidade f
        INNER JOIN consentimentos c
            ON f.idFinalidade = c.finalidade_idFinalidade
        WHERE c.estado = 1
        GROUP BY f.nomeFinalidade, f.descFinalidade
        ORDER BY quantidade ASC;"
    );
}
if (isset($_GET["busca"])) {
    $sqlAscBusca->execute();
    $sqlDescBusca->execute();
    $sqlMaiorTaxaConsentimentoBusca->execute();
    $sqlMenorTaxaConsentimentoBusca->execute();

    $resultado = [
        'crescente' => $sqlAscBusca->fetchAll(PDO::FETCH_ASSOC),
        'decrescente' => $sqlDescBusca->fetchAll(PDO::FETCH_ASSOC),
        'maior_taxa' => $sqlMaiorTaxaConsentimentoBusca->fetchAll(PDO::FETCH_ASSOC),
        'menor_taxa' => $sqlMenorTaxaConsentimentoBusca->fetchAll(PDO::FETCH_ASSOC)
    ];
} else {
    $sqlAsc->execute();
    $sqlDesc->execute();
    $sqlMaiorTaxaConsentimento->execute();
    $sqlMenorTaxaConsentimento->execute();
    
    $resultado = [
        'crescente' => $sqlAsc->fetchAll(PDO::FETCH_ASSOC),
        'decrescente' => $sqlDesc->fetchAll(PDO::FETCH_ASSOC),
        'maior_taxa' => $sqlMaiorTaxaConsentimento->fetchAll(PDO::FETCH_ASSOC),
        'menor_taxa' => $sqlMenorTaxaConsentimento->fetchAll(PDO::FETCH_ASSOC)
    ];
}

// Se não tiver consentimentos, o array vai estar vazio
echo json_encode($resultado);