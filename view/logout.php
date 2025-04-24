<?php
session_start();

unset($_SESSION["id"]);
unset($_SESSION["nome"]);
unset($_SESSION["email"]);
unset($_SESSION["senha"]);
unset($_SESSION["idSessao"]);

header("Location: home.php");