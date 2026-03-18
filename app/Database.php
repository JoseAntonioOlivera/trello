<?php

class Database
{
    private static $pdo = null;

    public static function pdo()
    {
        if (self::$pdo === null) {
            // 1. Obtenemos la URL de Render (DATABASE_URL)
            $dbUrl = getenv('DATABASE_URL');

            if ($dbUrl) {
                // 2. Si estamos en Render, parseamos la URL de Postgres
                $conn = parse_url($dbUrl);

                $host = $conn['host'];
                $port = $conn['port'];
                $user = $conn['user'];
                $pass = $conn['pass'];
                $dbname = ltrim($conn['path'], '/');

                // 3. Cambiamos el DSN a "pgsql"
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
            } else {
                // Configuración local por si trabajas en tu PC (ajusta según necesites)
                $dsn = "mysql:host=localhost;dbname=trello;charset=utf8mb4";
                $user = 'root';
                $pass = '';
            }

            try {
                self::$pdo = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
