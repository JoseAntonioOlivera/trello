<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Crear Nueva Tarea</title>
  <style>
    body { font-family: sans-serif; padding: 20px; }
    textarea { width: 300px; height: 100px; }
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>

<h1>Añadir Tarea al Tablero</h1>

<!-- Si el controlador detecta un error (nombre vacío, etc.), lo muestra aquí -->
<?php if (isset($error) && $error !== ''): ?>
  <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=store">
  <p>
    <strong>Nombre de la tarea:</strong><br>
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" placeholder="Ej: Comprar paparajotes">
  </p>
  
  <p>
    <strong>Descripción / Notas:</strong><br>
    <textarea name="descripcion" placeholder="Detalles de la tarea..."><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?></textarea>
  </p>

  <!-- El estado y el orden se asignan automáticamente en el modelo como 'pendiente' y '0' -->
  
  <button type="submit">Guardar en Pendientes</button>
</form>

<p><a href="index.php?action=index">← Volver al tablero</a></p>

</body>
</html>
