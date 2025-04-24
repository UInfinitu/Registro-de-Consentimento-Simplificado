<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();

include "../classes/cliente.php";
include "../conexao.php";

$usuario = new Cliente($_SESSION['id'], $_SESSION["nome"]);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Área do Cliente</title>
    <link rel="shortcut icon" href="../assets/icone-logo.webp" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/padrao.css">
    <link rel="stylesheet" href="../styles/cliente.css">
</head>

<body>
    <?php if (isset($_SESSION['msg'])): ?>
        <div id="alerta" class="row justify-content-center">
            <?php if ($_SESSION['status'] === 'success'): ?>
                <div class="col-4 alert alert-success row justify-content-between">
                    <?php
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                    ?>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            <?php else: ?>
                <div class="col-4 alert alert-danger row justify-content-between">
                    <?php
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                    ?>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <header class="container-fluid mb-5">
        <div class="gradiente row justify-content-evenly align-items-center p-2">
            <a href="#" id="seusConsentimentos" class="opcoes col-3 text-center fs-4">Seus Consentimentos</a>
            <img id="iconeLogo" class="col-3" src="../assets/icone-logo.webp" alt="Icone da logo da DPOnet">
            <a href="#" id="historico" class="opcoes col-3 text-center fs-4">Histórico</a>
        </div>
    </header>

    <main class="container-fluid">
        <!-- Parte de Edição de Cliente -->
        <form method="POST" action="alterarUsuario.php" id="edicaoUsuario" class="row col-8 mx-auto justify-content-evenly align-items-center mb-5 p-2 d-flex">

            <img id="iconeUsuario" class="col-auto" src="../assets/user.png" alt="Icone de usuário"
                style="max-width: 50px;">

            <input type="text" id="idUsuario" name="id" value="<?= $usuario->id ?>" style="display: none;">

            <div class="input-group col">
                <input type="text" class="alteracaoBloqueada form-control fs-5" name="nome" id="inputNomeAlteracao" placeholder="Nome" value="<?= $usuario->nome ?>"
                    required readonly>
                <a href="#" class="editarUsuario input-group-text">
                    <img id="imgEditarUsuario" src="../assets/editar.png" alt="Simbolo para edição de usuário">
                </a>
            </div>

            <div class="input-group col">
                <input type="email" class="alteracaoBloqueada form-control fs-5" name="email" id="inputEmailAlteracao" placeholder="Email" value="<?= $_SESSION['email'] ?>"
                    required readonly>
                <a href="#" class="editarUsuario input-group-text">
                    <img id="imgEditarUsuario" src="../assets/editar.png" alt="Simbolo para edição de usuário">
                </a>
            </div>

            <div class="input-group col">
                <input type="password" class="alteracaoBloqueada form-control fs-5" name="senha" id="inputSenhaAlteracao" value="<?= $_SESSION['senha'] ?>"
                    placeholder="Senha" required readonly>
                <a href="#" id="visualizarSenha" class="input-group-text">
                    <img id="imgVisualizarSenha" src="../assets/senha-oculta.webp"
                        alt="Simbolo para mostrar que a senha está oculta">
                </a>
                <a href="#" class="editarUsuario input-group-text">
                    <img id="imgEditarUsuario" src="../assets/editar.png" alt="Simbolo para edição de usuário">
                </a>
            </div>

            <button id="btnAlterarUsuario" class="col-1 btn btn-primary">Enviar Alterações</button>

        </form>

        <!-- Parte de visualização dos consentimentos do usuário -->
        <div id="conteudo" class="row col-9 mx-auto justify-content-center align-items-center mb-5 p-4">
            <!-- Filtros de ordenação e barra de busca -->
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-7">
                    <h4>Ordenar por</h4>
                    <button class="filtros btn btn-primary" data-order="crescente">A-Z</button>
                    <button class="filtros btn btn-primary" data-order="decrescente">Z-A</button>
                    <button class="filtros btn btn-primary" data-order="maior_taxa">Maior taxa de Consentimento</button>
                    <button class="filtros btn btn-primary" data-order="menor_taxa">Menor taxa de Consentimento</button>
                </div>
            </div>

            <div id="consentimentos" class="row gy-3 justify-content-center">
                <!-- Onde o JS vai gerar os consentimentos -->
            </div>
        </div>

        <!-- Modal para adicionar novo consentimento -->
        <div id="modalAdcConsentimento" class="modal fade surgirBaixo" tabindex="-1" aria-labelledby="modalAdicionarLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAdicionarLabel">Adicionar Consentimentos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body container-fluid align-items-center">
                        <!-- Onde aparecerá todas as finalidades que o usuário não tem consentimento -->
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <script src="../js/cliente.js"></script>
</body>

</html>