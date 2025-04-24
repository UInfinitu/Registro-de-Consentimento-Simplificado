<?php
session_start();

$finalidade = [
    'nome' => $_POST['nome'],
    'desc' => $_POST['desc']
];

$acesso = curl_init('http://localhost/Registro-de-Consentimento-Simplificado/api/finalidade-coleta/criar.php');

curl_setopt($acesso, CURLOPT_RETURNTRANSFER, true);
curl_setopt($acesso, CURLOPT_POST, true);
curl_setopt($acesso, CURLOPT_POSTFIELDS, http_build_query($finalidade));

$resposta = json_decode(curl_exec($acesso));

echo var_dump($resposta);

curl_close($acesso);

header("Location: admin.php");