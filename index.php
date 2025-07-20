<?php
// index.php (na raiz do projeto)

session_start();

// Defina o fuso horário padrão (ajuste conforme necessário)
date_default_timezone_set('America/Sao_Paulo');

// Carrega o autoloader manual (caso não use Composer)
require_once 'routes.php';
