<!doctype html>
<html lang="es-ES">

<head>
  <meta charset="utf-8">
  <title>Crear Nueva Tarea</title>
  <link rel="stylesheet" href="/trello/css/style.css">
</head>

<body class="body-formulario">

  <div class="contenedor-formulario">
    <div class="tarjeta-form shadow">
      <h1>Añadir Nueva Tarea</h1>

      <?php if (isset($error) && $error !== ''): ?>
        <div class="alerta-error">
          ⚠️ <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <form method="post" action="index.php?action=store">
        <div class="campo">
          <label>Nombre de la tarea</label>
          <input type="text" name="nombre"
            value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>"
            placeholder="Ej: Comprar paparajotes" required>
        </div>

        <div class="campo">
          <label>Descripción / Notas</label>
          <textarea name="descripcion"
            placeholder="Añade una descripción más detallada..."><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?></textarea>
        </div>

        <div class="acciones-form">
          <button type="submit" class="btn-guardar">Guardar en Pendientes</button>
          <a href="index.php?action=index" class="btn-cancelar">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>
