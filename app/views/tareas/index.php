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
  <a href="index.php?action=create">Crear Nueva Tarea</a>
  <div class="contenedor" id="padre">

    <!-- COLUMNA PENDIENTES -->
    <div class="columna" id="pendiente">
      <h3>Pendientes</h3>
      <?php foreach ($tareas as $t): ?>
        <?php if ($t['estado'] === 'pendiente'): ?>
          <div class="tarea" data-id="<?php echo $t['id']; ?>">
            <h3><?php echo htmlspecialchars($t['nombre']); ?></h3>
            <p><?php echo htmlspecialchars($t['descripcion']); ?></p>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- COLUMNA EN PROCESO -->
    <div class="columna" id="proceso">
      <h3>En proceso</h3>
      <?php foreach ($tareas as $t): ?>
        <?php if ($t['estado'] === 'proceso'): ?>
          <div class="tarea" data-id="<?php echo $t['id']; ?>">
            <h3><?php echo htmlspecialchars($t['nombre']); ?></h3>
            <p><?php echo htmlspecialchars($t['descripcion']); ?></p>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- COLUMNA TERMINADAS -->
    <div class="columna" id="terminado">
      <h3>Terminadas</h3>
      <?php foreach ($tareas as $t): ?>
        <?php if ($t['estado'] === 'terminado'): ?>
          <div class="tarea" data-id="<?php echo $t['id']; ?>">
            <h3><?php echo htmlspecialchars($t['nombre']); ?></h3>
            <p><?php echo htmlspecialchars($t['descripcion']); ?></p>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
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
          // 1. Capturamos los datos correctos
          let tareaId = evt.item.getAttribute('data-id');
          let nuevoEstado = evt.to.id;

          // 2. Ejecutamos la llamada silenciosa al servidor
          $.ajax({
            url: 'index.php?action=updateEstado',
            method: 'POST',
            data: {
              id: tareaId, // Usamos la variable definida arriba
              estado: nuevoEstado // Usamos la variable definida arriba
            },
            success: function(respuesta) {
              console.log("Servidor dice: " + respuesta);
            },
            error: function() {
              console.log("Error al conectar con el servidor");
            }
          });
        } // Fin onEnd
      }); // Fin new Sortable
    }); // Fin forEach
  }); // Fin ready
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