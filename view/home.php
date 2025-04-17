<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
    </div>
<?php endif; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/icone-logo.webp" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/home.css">
    <title>Registro de Consentimento Simplificado</title>
</head>

<body>
    <header id="cabecalho" class="container-fluid">
        <div class="row justify-content-around align-items-center py-2">
            <img id="logo" src="../assets/logo.png" alt="Logo da DPOnet" class="col-lg-2 col-md-3 col-sm-4">
            <button id="btnAcessar" class="col-lg-1 col-md-1 col-sm-1 h-50 p-3" data-bs-toggle="modal" data-bs-target="#modalLogin">Acessar</button>
        </div>
    </header>
    <main class="container-fluid">
        <div id="explicacao" class="row align-items-center">
            <div id="explicacaoTexto" class="col-12 p-5">
                <h1 class="fs-1 fw-bold text-center">Registro de Consentimento Simplificado</h1>
                <p class="lh-sm p-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quia fugit
                    temporibus officiis veniam magni quis aliquam similique nostrum, dolorum mollitia ad quasi quas.
                    Incidunt ea aliquid aut ut dicta. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi
                    qui culpa ab libero consequuntur alias corporis soluta quos at autem similique laudantium, modi, quo
                    assumenda maxime sit expedita vero neque? Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Eos minima enim voluptates reprehenderit doloremque necessitatibus nisi provident aliquam, illum
                    accusantium possimus, architecto corrupti nobis perspiciatis quae adipisci consequuntur omnis
                    officiis.</p>
            </div>
        </div>

        <div id="estatisticas" class="row col-lg-9 mx-auto align-items-center justify-content-around my-5 p-5">
            <div id="utilizacaoTxt" class="col-lg-3 col-md-6 col-12 estatisticas-item lh-1">
                <h2 class="fs-1">1mil</h2>
                <p class="fs-5">Clientes utilizando a plataforma</p>
            </div>
            <div id="finalidadesTxt" class="col-lg-3 col-md-6 col-12 estatisticas-item lh-1">
                <h2 class="fs-1">26</h2>
                <p class="fs-5">Finalidades Cadastradas</p>
            </div>
            <div id="consentimentoTxt" class="col-lg-3 col-md-6 col-12 estatisticas-item lh-1">
                <h2 class="fs-1">87%</h2>
                <p class="fs-5">Porcentagem de Consentimento</p>
            </div>
        </div>

        <div id="duvidas"
            class="row col-lg-9 col-md-10 col-sm-11 mx-auto align-items-stretch justify-content-between my-5">
            <div class="duvida col-lg-5 col-md-5 col-sm-5 text-start p-3 lh-2">
                <h2 class="mb-3">O que é uma finalidade de coleta?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, quisquam accusantium. Esse dolore
                    soluta aliquam, praesentium voluptate vitae, maxime consectetur aspernatur adipisci eum delectus
                    officia aliquid ab qui sapiente debitis.</p>
            </div>
            <div class="duvida col-lg-5 col-md-5 col-sm-5 text-end p-3 lh-2">
                <h2 class="mb-3">Por que devo consentir a coleta de meus dados?</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga corporis voluptate veniam. Voluptate
                    eius quia nemo non ipsum sit, praesentium nesciunt voluptates voluptatum expedita cum error adipisci
                    unde asperiores dolores?</p>
            </div>
        </div>
    </main>

    <footer id="rodape" class="container-fluid">
        <div class="row align-items-center p-3">
            <p class="col-12 text-center m-0">&copy; Hugo Araki Facchini - Email: hufacchini@gmail.com . Todos direitos
                reservados</p>
        </div>
    </footer>

    <div id="modalLogin" class="modal fade" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLoginLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body row align-items-center">
                    <form action="login.php" id="formLogin" method="POST" class="align-items-center">
                        <div class="form-group m-2 mb-3">
                            <label for="inputEmailLogin" class="fs-3">Email</label>
                            <input type="email" class="form-control fs-4" name="email" required id="inputEmailLogin">
                        </div>

                        <div class="form-group m-2 mb-5">
                            <label for="inputSenhaLogin" class="fs-3">Senha</label>
                            <input type="password" class="form-control fs-4" name="senha" required id="inputSenhaLogin">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn m-2 fs-4" id="btnLogar">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>