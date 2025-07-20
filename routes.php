<?php
// routes.php

// Recupera o parâmetro da URL, ex: index.php?page=ponto
$page = isset($_GET['page']) ? $_GET['page'] : 'ponto';

// Define os caminhos para os controllers e views
switch ($page) {
    case 'ponto':
        require_once 'controller/PontoController.php';
        $controller = new PontoController();
        $controller->index();
        break;

/*     case 'jornada':
        require_once 'controller/JornadaController.php';
        $controller = new JornadaController();
        $controller->configuracao();
        break; */

    default:
        echo "Página não encontrada.";
        break;
}
