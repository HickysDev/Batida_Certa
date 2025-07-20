<?php
// view/layout/head.php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Batida Certa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%231f6cb0'><path d='M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z'/><path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z'/></svg>" type="image/svg+xml">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

    <!-- Seu CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a class="navbar-brand d-flex align-items-center" href="index.php?page=ponto">
                <i class="bi bi-clock-fill me-2"></i>
                <span>Batida Certa</span>
            </a>

            <div class="d-flex align-items-center">
                <button class="navbar-toggler me-2 d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Botão modo escuro mobile -->
                <a href="#" class="nav-link text-white d-lg-none p-0 botaoModoEscuro" title="Alternar modo claro/escuro">
                    <i class="bi bi-moon-fill fs-4"></i>
                </a>
            </div>

            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" id="modalJornadaBtn">Configurar Jornada</a>
                    </li>
                    <li class="nav-item separador d-none d-lg-block">|</li> <!-- Barra só no desktop -->
                    <li class="nav-item d-none d-lg-block"> <!-- Botão só no desktop -->
                        <a href="#" class="nav-link botaoModoEscuro" title="Alternar modo claro/escuro">
                            <i class="bi bi-moon-fill"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Modal -->
    <div class="modal fade" id="modalJornada" tabindex="-1" aria-labelledby="modalJornadaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formBaterPonto">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalJornadaLabel">Configurar Jornada de Trabalho</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="horaEntrada" class="form-label">Hora de entrada</label>
                            <input type="time" class="form-control" id="horaEntrada" name="horaEntrada" required>
                        </div>
                        <div class="mb-3">
                            <label for="horaAlmoco" class="form-label">Tempo de almoço</label>
                            <input type="time" class="form-control" id="horaAlmoco" name="horaAlmoco" required>
                        </div>
                        <div class="mb-3">
                            <label for="horaSaida" class="form-label">Hora de saída</label>
                            <input type="time" class="form-control" id="horaSaida" name="horaSaida" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="btnSalvarJornada" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>