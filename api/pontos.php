<?php
// api/pontos.php

session_start(); 
$_POST['acao'] = 'buscarPontos'; // define a ação

require_once __DIR__ . '/../controller/PontoController.php';
