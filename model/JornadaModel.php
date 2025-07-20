<?php
// model/JornadaModel.php

require_once __DIR__ . '/../config.php';

class JornadaModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function salvarJornada($horaInicio, $horaAlmoco, $horaFim, $codigoUsuario)
    {
        $codigoUsuario = 1; // Depois trocar para o usuário logado

        // Verifica se já existe jornada
        $sqlVerifica = "SELECT COUNT(*) FROM jornada WHERE usuario_id = :usuario_id";
        $stmtVerifica = $this->pdo->prepare($sqlVerifica);
        $stmtVerifica->execute([':usuario_id' => $codigoUsuario]);
        $existe = $stmtVerifica->fetchColumn();

        if ($existe) {
            $sql = "UPDATE jornada 
            SET hora_inicio = :hora_inicio, 
                tempo_almoco = :tempo_almoco, 
                hora_fim = :hora_fim 
            WHERE usuario_id = :usuario_id";
        } else {
            $sql = "INSERT INTO jornada (hora_inicio, tempo_almoco, hora_fim, usuario_id) 
            VALUES (:hora_inicio, :tempo_almoco, :hora_fim, :usuario_id)";
        }

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':hora_inicio'     => $horaInicio,
            ':tempo_almoco'    => $horaAlmoco,
            ':hora_fim'        => $horaFim,
            ':usuario_id'      => $codigoUsuario
        ]);
    }

    public function buscaJornada($codigoUsuario)
    {
        $sql = $this->pdo->prepare(
            "SELECT * FROM jornada
            WHERE usuario_id = :codigousuario"
        );
        $sql->execute([':codigousuario' => $codigoUsuario]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
