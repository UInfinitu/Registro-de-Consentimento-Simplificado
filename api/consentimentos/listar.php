<?php

header('Content-Type: application/json');

include "../../conexao.php";

if (isset($_GET["id"])) { // Visualização de consentimentos de um único usuário
    $id = htmlspecialchars($_GET["id"]);

    $sql = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, c.estado
        FROM finalidade f
        INNER JOIN consentimentos c
            ON f.idFinalidade = c.finalidade_idFinalidade
        WHERE c.usuario_idUsuario = :id;"
    );

    $sql->bindParam(":id", $id);
} else { // Visualização de consentimentos de todos os usuários

    $sql = $pdo->prepare(
        "SELECT f.nomeFinalidade, f.descFinalidade, c.estado
        FROM finalidade f
        INNER JOIN consentimentos c
            ON f.idFinalidade = c.finalidade_idFinalidade;"
    );
}
/* if (isset($_GET["busca"])) {
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
} */

$sql->execute();

$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

// Se não tiver consentimentos, o array vai estar vazio
echo json_encode($resultado);