<?php
require_once __DIR__ . '/Tarea.php';

class TareaController
{
  public function index(): void
  {
    // Pedimos las tareas al modelo
    $tareas = Tarea::all();

    // Cargamos la vista del tablero o listado
    require __DIR__ . '/views/tareas/index.php';
  }

  public function create(): void
  {
    $error = '';
    require __DIR__ . '/views/tareas/create.php';
  }

  public function store(): void
  {
    try {
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $descripcion = isset($_POST['descripcion']) ? (string)$_POST['descripcion'] : '';

      Tarea::create($nombre, $descripcion);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();
      require __DIR__ . '/views/tareas/create.php';
    }
  }

  public function edit(): void
  {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $tarea = Tarea::find($id);
    if ($tarea === null) {
      echo "Tarea no encontrada";
      return;
    }

    $error = '';
    require __DIR__ . '/views/tareas/edit.php';
  }

  public function update(): void
  {
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $descripcion = isset($_POST['descripcion']) ? (string)$_POST['descripcion'] : '';
      $estado = isset($_POST['estado']) ? (string)$_POST['estado'] : 'pendiente';
      $orden = isset($_POST['orden']) ? (int)$_POST['orden'] : 0;

      Tarea::update($id, $nombre, $descripcion, $estado, $orden);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $tarea = Tarea::find($id);

      require __DIR__ . '/views/tareas/edit.php';
    }
  }

  public function delete(): void
  {
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      Tarea::delete($id);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      echo "No se pudo borrar: " . $e->getMessage();
    }
  }

  public function updateEstado(): void
  {
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $nuevoEstado = isset($_POST['estado']) ? (string)$_POST['estado'] : '';

      $tarea = Tarea::find($id);
      if ($tarea) {
        Tarea::update($id, $tarea['nombre'], $tarea['descripcion'], $nuevoEstado, $tarea['orden']);
        echo json_encode(['status' => 'success']);
      }
    } catch (Exception $e) {
      echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
  }
}
