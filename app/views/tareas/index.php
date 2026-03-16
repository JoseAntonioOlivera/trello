<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trello</title>
  <style>
    .contenedor {
      display: flex;
      gap: 20px;
    }

    .columna {
      flex: 1;
      min-height: 400px;
      background: #f4f4f4;
      padding: 10px;
    }

    .tarea {
      cursor: grab;
      background: white;
      margin: 10px 0;
      padding: 10px;
      border: 1px solid #ccc;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
</head>

<body>
  <div class="contenedor" id="padre">
    <div class="columna" id="pendiente">
      <h3>Pendientes</h3>
      <div class="tarea" data-id="<?php echo $t['id']; ?>">
        <h3>Título de la tarea 1</h3>
        <p>Texto de la tarea</p>
      </div>
    </div>
    <div class="columna" id="proceso">
      <h3>En proceso</h3>
      <div class="tarea">
        <h3>Título de la tarea 2</h3>
        <p>Texto de la tarea</p>
      </div>
    </div>
    <div class="columna" id="terminado">
      <h3>Terminadas</h3>
      <div class="tarea">
        <h3>Título de la tarea 3</h3>
        <p>Texto de la tarea</p>
      </div>
    </div>
  </div>
</body>
<script>
  $(document).ready(function() {
    document.querySelectorAll('.columna').forEach(col => {
      new Sortable(col, {
        group: 'tablero-kanban',
        animation: 150,
        onEnd: function(evt) {
          let tareaId = evt.item.getAttribute('data-id');
          let nuevoEstado = evt.to.id;
          // TODO actualizar el estado en la BD
        }
      });
    });
  });
</script>

</html>



<!-- CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    estado ENUM('pendiente', 'proceso', 'terminado') DEFAULT 'pendiente',
    orden INT DEFAULT 0, -- Para guardar la posición dentro de la columna
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); -->