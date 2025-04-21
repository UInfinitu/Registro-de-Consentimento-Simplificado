<?php

include "finalidade.php";
include "usuario.php";

class Administrador extends Usuario {
    // Método para criação de finalidade
    public function criarFinalidade(string $nome, string $desc) {
        $endpointCriar = "http://localhost/Registro-de-Consentimento-Simplificado/api/finalidade-coleta/criar.php";
        $finalidade = [
            "nome" => $nome,
            "desc" => $desc
        ];

        $conecta = curl_init($endpointCriar);

        curl_setopt($conecta, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($conecta, CURLOPT_POST, true);
        curl_setopt($conecta, CURLOPT_POSTFIELDS, http_build_query($finalidade));

        $resposta = curl_exec($conecta);
        curl_close($conecta);

        $criacaoFinalidade = json_decode($resposta);
        return $criacaoFinalidade;
    }

    // Método para modificar uma finalidade
    public function modificarFinalidade(int $id, string $novoNome, string $novaDesc) {
        $endpointModificar = "http://localhost/Registro-de-Consentimento-Simplificado/api/finalidade-coleta/modificar.php?id=" . $id;
        $finalidade = [
            "nome" => $novoNome,
            "desc" => $novaDesc
        ];

        $conecta = curl_init($endpointModificar);

        curl_setopt($conecta, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($conecta, CURLOPT_POST, true);
        curl_setopt($conecta, CURLOPT_POSTFIELDS, http_build_query($finalidade));

        $resposta = curl_exec($conecta);
        curl_close($conecta);

        $modificacaoFinalidade = json_decode($resposta);
        return $modificacaoFinalidade;
    }

    // Método para remover finalidade
    public function removerFinalidade(int $id) {
        $endpointRemover = "http://localhost/Registro-de-Consentimento-Simplificado/api/finalidade-coleta/remover.php?id=" . $id;
        $remocaoFinalidade = json_decode($endpointRemover);

        return $remocaoFinalidade;
    }

    // Método para listar todos os usuários
    public function listarClientes() {
        $endpointListarClientes = "http://localhost/Registro-de-Consentimento-Simplificado/api/clientes/listar.php";
        $listaClientes = json_decode($endpointListarClientes);

        return $listaClientes;
    }

    // Método para verificar todos os consentimentos de todos os usuários
    public function consentimentoUsuarios() {
        $endpointListar = "http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php";
        $listaConsentimentos = json_decode($endpointListar);

        return $listaConsentimentos;
    }
}