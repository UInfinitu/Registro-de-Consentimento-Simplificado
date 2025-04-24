<?php
session_start();

$usuario = [
    'nome' => $_POST['nome'],
    'email' => $_POST['email'],
    'senha' => $_POST['senha']
];

$acesso = curl_init('http://localhost/Registro-de-Consentimento-Simplificado/api/clientes/criar.php');

curl_setopt($acesso, CURLOPT_RETURNTRANSFER, true);
curl_setopt($acesso, CURLOPT_POST, true);
curl_setopt($acesso, CURLOPT_POSTFIELDS, http_build_query($usuario));

$resposta = json_decode(curl_exec($acesso));

echo var_dump($resposta);

curl_close($acesso);

header("Location: admin.php");