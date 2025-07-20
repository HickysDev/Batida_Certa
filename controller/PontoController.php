<?php
// controller/PontoController.php

require_once __DIR__ . '/../model/PontoModel.php';

class PontoController
{
    private $model;

    public function __construct()
    {
        $this->model = new PontoModel();
    }

    public function index()
    {
        require_once __DIR__ . '/../view/ponto/index.php';
    }

    public function cadastrarPonto()
    {
        extract($this->extrairPost());

        $resultado = $this->model->salvarPonto($dataPonto, $tipo, $hora);

        if ($resultado === 'ok') {
            echo json_encode(['status' => 'ok', 'mensagem' => 'Ponto salvo com sucesso!']);
        } elseif ($resultado === 'duplicado') {
            echo json_encode(['status' => 'alerta', 'mensagem' => 'Já existe um ponto cadastrado desse tipo para hoje.']);
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar ponto.']);
        }
    }


    public function listarPontosPorUsuario()
    {
        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        if (!$usuario_id) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
            return;
        }

        $pontos = $this->model->getPontosPorUsuario($usuario_id);
        echo json_encode($pontos);
    }

    public function buscarPonto()
    {
        extract($this->extrairPost());

        $ponto = $this->model->buscaPonto($id);

        echo json_encode($ponto);
    }

    public function atualizarPonto()
    {
        extract($this->extrairPost());

        $success = $this->model->atualizarPonto($id, $dataPonto, $tipo, $hora);

        if ($success) {
            echo json_encode(['status' => 'ok', 'mensagem' => 'Ponto editado com sucesso!']);
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao editar ponto.']);
        }
    }

    private function extrairPost()
    {
        foreach ($_POST as $key => $value) {
            $$key = $value;
        }
        // Retorna todas as variáveis em um array compactado
        return compact(array_keys($_POST));
    }
}

// Agora o roteamento simples pra chamar a função correta conforme a ação POST
$acao = $_POST['acao'] ?? '';

$controller = new PontoController();

switch ($acao) {
    case 'cadastrarPonto':
        $controller->cadastrarPonto();
        break;

    case 'buscarPontos':
        $controller->listarPontosPorUsuario();
        break;

    case 'buscarPonto':
        $controller->buscarPonto();
        break;

    case 'atualizarPonto':
        $controller->atualizarPonto();
        break;
    default:
        $controller->index();
        break;
}
