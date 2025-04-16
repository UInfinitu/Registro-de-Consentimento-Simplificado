<?php

$tipo_banco = "mysql";
$servidor = "localhost";
$porta = 3307;
$banco = "rcs";
$usuario = "root";
$senha = "1234";

$dsn = "$tipo_banco:host=$servidor;dbname=$banco;port=$porta";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}
