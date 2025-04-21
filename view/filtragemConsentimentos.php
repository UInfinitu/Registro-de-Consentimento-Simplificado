<?php
session_start();

$_SESSION['ordem'] = $_GET['order'];

header("Location: cliente.php");