<?php
session_start();

if (!isset($_SESSION['idSessao'])) {
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Área Administrativa</title>
    <link rel="shortcut icon" href="../assets/icone-logo.webp" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/padrao.css">
    <link rel="stylesheet" href="../styles/admin.css">
</head>

<body>
    <div class="d-flex">
        <!-- Navbar Vertical -->
        <nav id="navbar-vertical" class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid d-flex flex-column justify-content-between h-100">
                <div class="mb-5">
                    <img id="logo" class="navbar-brand w-100" src="../assets/logo.png">
                </div>
            
                <div class="w-100" id="navbarVerticalContent">
                    <ul class="navbar-nav flex-column w-100">
                        <li class="nav-item">
                            <a id="clientes" class="nav-link active fs-4" href="#">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a id="finalidades" class="nav-link fs-4" href="#">Finalidades</a>
                        </li>
                        <li class="nav-item">
                            <a id="consentimentos" class="nav-link fs-4" href="#">Consentimentos</a>
                        </li>
                    </ul>
                </div>
            
                <div class="mt-auto"> <!-- Coloca na parte de baixo da navbar -->
                    <a class="d-flex align-items-center text-decoration-none" id="logOut" href="logout.php">
                        <img class="img-fluid me-2" src="../assets/logout.webp" alt="Logout">
                        <span class="fs-4">LogOut</span>
                    </a>
                </div>
            </div>
        </nav>

        <main class="p-4">
            <div id="adicionar">
                <!-- Se o cadastro for feito pela área administrativa, aparece aqui -->
            </div>

            <div class="table-responsive">
                <table class="table w-100 mb-0 table-striped">
                    <thead>
                        <tr id="cabecalhos" class="text-center">
                            <!-- Cabeçalhos -->
                        </tr>
                    </thead>
                    <tbody id="corpoDados" class="text-center">
                        <!-- Dados aqui -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <script src="../js/admin.js"></script>
</body>

</html>