<?php

class Database
{
    private static $pdo = null;

    public static function pdo()
    {
        if (self::$pdo === null) {
            $databaseUrl = getenv('DATABASE_URL');

            if ($databaseUrl) {
                // CONFIGURACIÓN RENDER (PostgreSQL)
                $db = parse_url($databaseUrl);
                
                $host   = $db['host'];
                // Si no hay puerto en la URL, usamos el 5432 por defecto
                $port   = $db['port'] ?? '5432'; 
                $user   = $db['user'];
                $pass   = $db['pass'];
                $dbname = ltrim($db['path'], '/');

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
            } else {
                // CONFIGURACIÓN LOCAL (MySQL)
                $dsn  = "mysql:host=localhost;dbname=trello;charset=utf8mb4";
                $user = 'root';
                $pass = '';
            }

            try {
                self::$pdo = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                // Esto te ayudará a ver el error real si falla
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
