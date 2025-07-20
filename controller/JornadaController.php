<?php
// controller/JornadaController.php

require_once __DIR__ . '/../model/JornadaModel.php';

$jornada = new JornadaModel();

foreach ($_POST as $key => $value) {
    $$key = $value;
}

switch ($acao) {
    case 'cadastrarJornada':
        $success = $jornada->salvarJornada($horaInicio, $horaAlmoco, $horaFim, 1);

        if ($success) {
            $retorno = (['status' => 'ok', 'mensagem' => 'Jornada cadastrada com sucesso!']);
        } else {
            $retorno = (['status' => 'erro', 'mensagem' => 'Erro ao cadastrar jornada.']);
        }

        break;

    case 'buscaJornada':
        $retorno = $jornada->buscaJornada($codigoUsuario);

        break;    

    default:
        break;
}

echo json_encode($retorno);
