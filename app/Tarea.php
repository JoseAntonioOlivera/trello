<?php
require_once __DIR__ . '/Database.php';

class Tarea
{
  public static function all(): array
  {
    $sql = "SELECT id, nombre, descripcion, estado, orden, fecha_creacion FROM tareas ORDER BY orden ASC";
    $stmt = Database::pdo()->query($sql);
    // En Postgres es buena práctica especificar FETCH_ASSOC
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function find(int $id): ?array
  {
    $sql = "SELECT id, nombre, descripcion, estado, orden, fecha_creacion FROM tareas WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row : null;
  }

  public static function create(string $nombre, string $descripcion): void
  {
    $nombre = trim($nombre);
    if ($nombre === '') {
      throw new Exception("El nombre de la tarea es obligatorio.");
    }

    // El SQL es idéntico a MySQL
    $sql = "INSERT INTO tareas (nombre, descripcion, estado, orden) VALUES (:nombre, :descripcion, 'pendiente', 0)";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':nombre' => $nombre,
      ':descripcion' => $descripcion
    ]);
  }

  public static function update(int $id, string $nombre, string $descripcion, string $estado, int $orden): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $nombre = trim($nombre);
    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    }

    $sql = "UPDATE tareas SET nombre = :nombre, descripcion = :descripcion, estado = :estado, orden = :orden WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':nombre' => $nombre,
      ':descripcion' => $descripcion,
      ':estado' => $estado,
      ':orden' => $orden
    ]);
  }

  public static function delete(int $id): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $sql = "DELETE FROM tareas WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
  }
}
