<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestor de tareas</title>
  <link rel="stylesheet" href="../../Trello/css/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
</head>

<body>  
   <h1 class="titulo-tablero">Mi Tablero de Tareas</h1>
  <div class="contenedor" id="padre">

    <!-- COLUMNA PENDIENTES -->
    <div class="columna" id="pendiente">
      <h3>Pendientes</h3>
      <?php foreach ($tareas as $t): ?>
         <?php if ($t['estado'] === 'pendiente') pintarTarea($t); ?>
      <?php endforeach; ?>
    </div>

    <!-- COLUMNA EN PROCESO -->
    <div class="columna" id="proceso">
      <h3>En proceso</h3>
      <?php foreach ($tareas as $t): ?>
        <?php if ($t['estado'] === 'proceso') pintarTarea($t); ?>
      <?php endforeach; ?>
    </div>

    <!-- COLUMNA TERMINADAS -->
    <div class="columna" id="terminado">
      <h3>Terminadas</h3>
      <?php foreach ($tareas as $t): ?>
        <?php if ($t['estado'] === 'terminado') pintarTarea($t); ?>
      <?php endforeach; ?>
    </div>

  </div>

  <div class="crearTarea">
    <a href="index.php?action=create" class="btn-trello">
        <span>+</span> Añadir una tarea
    </a>
</div>

</body>
<script>
  $(document).ready(function() {
    document.querySelectorAll('.columna').forEach(col => {
      new Sortable(col, {
        group: 'tablero-kanban',
        animation: 150,
        onEnd: function(evt) {
          //Capturamos de datos
          let tareaId = evt.item.getAttribute('data-id');
          let nuevoEstado = evt.to.id;

          //Llamada AJAX para cambiar estado de la tarea
          $.ajax({
            url: 'index.php?action=updateEstado',
            method: 'POST',
            data: {
              id: tareaId,
              estado: nuevoEstado
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

<?php
function pintarTarea($t) {
    ?>
    <div class="tarea" data-id="<?= $t['id'] ?>">
        <h3><?= htmlspecialchars($t['nombre']) ?></h3>
        <p><?= htmlspecialchars($t['descripcion']) ?></p>

        <div class="acciones">
            <form action="index.php?action=delete" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar?');">
                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                <button type="submit" style="border:none; background:none; cursor:pointer; font-size: 1.2rem;" title="Eliminar">🗑️</button>
            </form>
            <a href="index.php?action=edit&id=<?= $t['id'] ?>" style="text-decoration:none;" title="Editar">
                <span style="font-size: 1.2rem;">📝</span>
            </a>
        </div>
    </div>
    <?php
}
?>




<!-- CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    estado ENUM('pendiente', 'proceso', 'terminado') DEFAULT 'pendiente',
    orden INT DEFAULT 0, -- Para guardar la posición dentro de la columna
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); -->