<?php

include "finalidade.php";
include "usuario.php";

class Cliente extends Usuario{
    // Atributos
    public int $id;
    public string $nome;
    public array $consentimentos;

    // Construtor
    public function __construct(int $id, string $nome, array $consentimentos) {
        $this->id = $id;
        $this->nome = $nome;
        $this->consentimentos = $consentimentos;
    }

    // Método de listagem de consentimentos
    public function listarConsentimentos() {
        $endpointListar = "../api/consentimentos/listar.php?id=" . $this->id;
        $listaConsentimentos = json_decode($endpointListar);

        return $listaConsentimentos;
    }

    // Método para registrar novo consentimento
    public function registrarConsentimento(Finalidade $consentimento, bool $estado) {
        $endpointRegistrar = "../api/consentimentos/registrar.php?finalidade=" . $consentimento->id . "&usuario=" . $this->id . "&estado=" . $estado;
        $registroConsentimento = json_decode($endpointRegistrar);

        return $registroConsentimento;
    }

    // Método para revogar um consentimento
    public function revogarConsentimento(Finalidade $consentimento) {
        $endpointRevogar = "../api/consentimentos/revogar.php?finalidade=" . $consentimento->id . "&usuario=" . $this->id;
        $revogacaoConsentimento = json_decode($endpointRevogar);

        return $revogacaoConsentimento;
    }
}