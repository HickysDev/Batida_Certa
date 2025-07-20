<?php
// api/pontos.php

session_start(); // se necessário
$_POST['acao'] = 'buscarPontos'; // define a ação que você quer

require_once __DIR__ . '/../controller/PontoController.php';
// O próprio controller executará a ação correta com base no switch
