<?php
// config.php

class Database
{
    private static $conn;

    public static function getConnection()
    {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO(
                    "mysql:host=localhost;dbname=batida_certa;charset=utf8mb4",
                    "root",
                    "",
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die("Erro na conexão com banco: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
