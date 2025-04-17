<?php

abstract class Usuario {
    // Método de listagem de finalidades
    public function listarFinalidades() {
        $endpointListar = "../api/finalidade-coleta/listar.php";
        $listaFinalidades = json_decode($endpointListar);

        return $listaFinalidades;
    }
}