<?php
// model/PontoModel.php

require_once __DIR__ . '/../config.php';

class PontoModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function salvarPonto($data, $tipo, $hora)
    {
        $codigousuario = 1; // Trocar pelo usuário logado depois

        $sqlVerifica = "SELECT COUNT(*) FROM pontos 
                    WHERE codigousuario = :usuario AND data = :data AND tipo = :tipo";

        $stmtVerifica = $this->pdo->prepare($sqlVerifica);
        $stmtVerifica->execute([
            ':usuario' => $codigousuario,
            ':data' => $data,
            ':tipo' => $tipo
        ]);

        $existe = $stmtVerifica->fetchColumn();

        if ($existe > 0) {
            return 'duplicado'; // já existe
        }

        $sql = "INSERT INTO pontos (codigousuario, data, tipo, hora) 
            VALUES (:codigousuario, :data, :tipo, :hora)";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            ':codigousuario' => $codigousuario,
            ':data' => $data,
            ':tipo' => $tipo,
            ':hora' => $hora
        ])) {
            return 'ok';
        }

        return 'erro';
    }




    // model/PontoModel.php

    public function getPontosPorUsuario($usuario_id)
    {
        $sql = "SELECT id, data, tipo, hora FROM pontos WHERE codigousuario = :usuario ORDER BY data, hora";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuario_id]);

        $result = $stmt->fetchAll();
        $events = [];

        foreach ($result as $row) {
            // Define a cor com base no tipo
            switch ($row['tipo']) {
                case 'chegada':
                    $color = '#4CAF50';
                    $nome = 'Início do Expediente';
                    break;
                case 'saida_almoco':
                    $color = '#FF9800';
                    $nome = 'Saída do Almoço';
                    break;
                case 'volta_almoco':
                    $color = '#2196F3';
                    $nome = 'Volta do Almoço';
                    break;
                case 'saida_dia':
                    $color = '#F44336';
                    $nome = 'Fim do Expediente';
                    break;
                default:
                    $color = '#6c757d';
                    $nome = '';
            }

            $title = $nome . ' às ' . substr($row['hora'], 0, 5);

            $events[] = [
                'id' => $row['id'],
                'title' => $title,
                'start' => $row['data'] . 'T' . $row['hora'],
                'allDay' => false,
                'color' => $color
            ];
        }

        return $events;
    }


    public function buscaPonto($id)
    {
        $sql = "SELECT id,data, tipo, hora FROM pontos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarPonto($id, $data, $tipo, $hora)
    {
        $sql = "UPDATE pontos SET data = :data, tipo = :tipo, hora = :hora WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':data' => $data,
            ':tipo' => $tipo,
            ':hora' => $hora,
            ':id' => $id,
        ]);
    }
}
