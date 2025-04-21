<?php
session_start();

$usuario = [
    'id' => $_POST['id'],
    'nome' => $_POST['nome'],
    'email' => $_POST['email'],
    'senha' => $_POST['senha']
];

// Inicializa a sessão cURL
$acesso = curl_init('http://localhost/Registro-de-Consentimento-Simplificado/api/clientes/modificar.php');

// Configura as opções
curl_setopt($acesso, CURLOPT_RETURNTRANSFER, true);
curl_setopt($acesso, CURLOPT_POST, true);
curl_setopt($acesso, CURLOPT_POSTFIELDS, http_build_query($usuario));

// Executa a requisição
$resposta = json_decode(curl_exec($acesso));

echo var_dump($resposta);

// Verifica se houve erro
$_SESSION['msg'] = $resposta->message;
$_SESSION['status'] = $resposta->status;

// Fecha a sessão cURL
curl_close($acesso);

$_SESSION['nome'] = $_POST['nome'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['senha'] = $_POST['senha'];

header("Location: cliente.php");