<?php

include "finalidade.php";
include "usuario.php";

class Cliente extends Usuario{
    // Atributos
    public int $id;
    public string $nome;

    // Construtor
    public function __construct(int $id, string $nome) {
        $this->id = $id;
        $this->nome = $nome;
    }

    // Método de listagem de consentimentos
    public function listarConsentimentos() {
        $endpointListar = "http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/listar.php?id=" . $this->id;
        $listaConsentimentos = json_decode($endpointListar);

        return $listaConsentimentos;
    }

    // Método para registrar novo consentimento
    public function registrarConsentimento(Finalidade $consentimento) {
        $endpointRegistrar = "http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/registrar.php?finalidade=" . $consentimento->id . "&usuario=" . $this->id;
        $registroConsentimento = json_decode($endpointRegistrar);

        return $registroConsentimento;
    }

    // Método para revogar um consentimento
    public function revogarConsentimento(Finalidade $consentimento) {
        $endpointRevogar = "http://localhost/Registro-de-Consentimento-Simplificado/api/consentimentos/revogar.php?finalidade=" . $consentimento->id . "&usuario=" . $this->id;
        $revogacaoConsentimento = json_decode($endpointRevogar);

        return $revogacaoConsentimento;
    }
}