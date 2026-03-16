<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Tarea</title>
  <style>
    body { font-family: sans-serif; padding: 20px; }
    textarea { width: 300px; height: 80px; }
    .error { color: red; }
  </style>
</head>
<body>

<h1>Editar Tarea</h1>

<?php if (isset($error) && $error !== ''): ?>
  <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=update">
  <!-- ID Oculto para saber qué tarea actualizar -->
  <input type="hidden" name="id" value="<?php echo (int)$tarea['id']; ?>">

  <p>
    <strong>Nombre:</strong><br>
    <input type="text" name="nombre" value="<?php
      echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : htmlspecialchars($tarea['nombre']);
    ?>">
  </p>

  <p>
    <strong>Descripción:</strong><br>
    <textarea name="descripcion"><?php
      echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : htmlspecialchars($tarea['descripcion']);
    ?></textarea>
  </p>

  <p>
    <strong>Estado actual:</strong><br>
    <select name="estado">
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
  </p>

  <!-- Mantenemos el orden actual oculto para no perderlo al editar texto -->
  <input type="hidden" name="orden" value="<?php echo (int)$tarea['orden']; ?>">

  <button type="submit">Actualizar Tarea</button>
</form>

<p><a href="index.php?action=index">← Volver al tablero</a></p>

</body>
</html>
