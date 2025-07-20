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
        $sql = "INSERT INTO pontos (codigousuario, data, tipo, hora) VALUES (:codigousuario, :data, :tipo, :hora)";
        $stmt = $this->pdo->prepare($sql);

        $codigousuario = 1; // Troque pelo usuário logado depois

        return $stmt->execute([
            ':codigousuario' => $codigousuario,
            ':data' => $data,
            ':tipo' => $tipo,
            ':hora' => $hora
        ]);
    }


    // model/PontoModel.php

    public function getPontosPorUsuario($usuario_id)
    {
        $sql = "SELECT id,data, tipo, hora FROM pontos WHERE codigousuario = :usuario ORDER BY data, hora";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuario_id]);

        $result = $stmt->fetchAll();

        $events = [];

        foreach ($result as $row) {
            // Ajuste o título e o formato da data conforme seu padrão
            $title = ucfirst($row['tipo']) . ' às ' . $row['hora'];
            $events[] = [
                'id' => $row['id'],
                'title' => $title,
                'start' => $row['data'] . 'T' . $row['hora'],
                'allDay' => false,
                'color' => '#28a745' // verde, por exemplo
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
