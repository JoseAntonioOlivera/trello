<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Tarea | Trello</title>
  <!-- Ruta al CSS (ajusta los ../ según tu estructura real) -->
  <link rel="stylesheet" href="/trello/css/style.css">
</head>
<body class="body-formulario">

<div class="contenedor-formulario">
  <div class="tarjeta-form shadow">
    <h1>📝 Editar Tarea</h1>

    <?php if (isset($error) && $error !== ''): ?>
      <div class="alerta-error">
        ⚠️ <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=update">
      <!-- ID Oculto -->
      <input type="hidden" name="id" value="<?php echo (int)$tarea['id']; ?>">
      <!-- Orden Oculto -->
      <input type="hidden" name="orden" value="<?php echo (int)$tarea['orden']; ?>">

      <div class="campo">
        <label>Nombre de la tarea</label>
        <input type="text" name="nombre" value="<?php
          echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : htmlspecialchars($tarea['nombre']);
        ?>" required>
      </div>

      <div class="campo">
        <label>Descripción / Notas</label>
        <textarea name="descripcion"><?php
          echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : htmlspecialchars($tarea['descripcion']);
        ?></textarea>
      </div>

      <div class="campo">
        <label>Estado de la columna</label>
        <select name="estado" class="select-trello">
          <?php 
            $estadoActual = isset($_POST['estado']) ? $_POST['estado'] : $tarea['estado'];
            $opciones = ['pendiente', 'proceso', 'terminado'];
            foreach ($opciones as $opcion):
          ?>
            <option value="<?php echo $opcion; ?>" <?php echo ($estadoActual == $opcion) ? 'selected' : ''; ?>>
              <?php echo ucfirst($opcion); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="acciones-form">
        <button type="submit" class="btn-guardar">Actualizar Tarea</button>
        <a href="index.php?action=index" class="btn-cancelar">Volver al tablero</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
