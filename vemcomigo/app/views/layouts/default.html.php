<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=TITLE_PAGE?></title>
    <meta name="Description" CONTENT="<?=META_DESCRIPTION?>">
	<meta name="robots" content="<?=META_ROBOTS?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?php echo CSS_PATH?>/layouts/default.css" rel="stylesheet">
    <link rel="icon" href="/<?php echo IMG_PATH?>/layouts/favicon.png" type="image/x-icon">
    <style>
        .estilizacao_menu_lateral li{
            border: 1px solid rgba(0, 0, 0, 0.1); /* Borda suave */
            border-radius: 8px; /* Cantos arredondados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para efeito suave */
            margin: 2px; /* Espaçamento externo */
        }
    </style>
</head>
<body>
    <div class="container-fluid"> <!-- Adiciona margem horizontal -->
        <div class="row">
            <div class="col-2 login-container align-self-start border-simple h-100">
                <div class="text-center">
                    <img src="/<?php echo IMG_PATH?>/layouts/logo.png" width="90%" alt="Logomarca Camila Gomes Estudio" class="img-fluid">
                    <br><br><br>
                </div>
            
                <nav class="estilizacao_menu_lateral d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            
                            <!-- Exibe as presenças e ausências mensais  -->
                            <li class="nav-item">
                                <a class="nav-link active" href="/administradores/relatorio_presenca">PRESENÇAS X AUSÊNCIAS </a>
                            </li>
                                                     
                            <!-- Registra as presenças e ausências mensais  -->
                            <li class="nav-item">
                                <a class="nav-link active" href="/presencas/criar">REGISTRAR PRESENÇA </a>
                            </li>

                            <!--   -->
                            <li class="nav-item">
                                <a class="nav-link" href="/alunos/todos">ALUNOS</a>
                            </li>

                            <!--   -->
                            <li class="nav-item">
                                <a class="nav-link" href="/alunos/novo">CADASTRAR</a>
                            </li>

                            <!-- Sai do sistema  -->
                            <li class="nav-item">
                                <a class="nav-link" href="/administradores/sair">SAIR</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                
            </div>

            <!--  EXIBE O CONTEUDO PRINCIPAL -->
            <?php echo HTML?>
        </div>
    </div>
     <!-- jQuery (necessário para os plugins JavaScript do Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js (necessário para o funcionamento dos tooltips e popovers do Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
