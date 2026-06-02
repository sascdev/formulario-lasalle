<?php
require_once 'config.php';

// recibimos los datos que vienen del formulario
$nombre   = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$asunto   = isset($_POST['asunto']) ? trim($_POST['asunto']) : '';
$mensaje  = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';
$resultado = false;
$errorValidacion = '';

if ($nombre === '' || $email === '' || $mensaje === '') {
  $errorValidacion = 'Por favor completa todos los campos obligatorios.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errorValidacion = 'El correo electrónico no es válido.';
} elseif (mb_strlen($mensaje, 'UTF-8') > 500) {
  $errorValidacion = 'El mensaje no puede superar los 500 caracteres.';
}

if ($errorValidacion === '') {
  $conn = obtenerConexion();

  // guardamos los datos en la tabla contactos (consulta preparada)
  $stmt = $conn->prepare(
    "INSERT INTO contactos (nombre, email, telefono, asunto, mensaje) VALUES (?, ?, ?, ?, ?)"
  );
  $stmt->bind_param("sssss", $nombre, $email, $telefono, $asunto, $mensaje);
  $resultado = $stmt->execute();
  $stmt->close();
  $conn->close();
}

$nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mensaje enviado</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      text-align: center;
      padding: 60px 20px;
    }
    .caja {
      background: white;
      max-width: 400px;
      margin: auto;
      padding: 30px;
      border-radius: 8px;
    }
    a {
      color: #003087;
    }
  </style>
</head>
<body>
  <div class="caja">
    <?php if ($errorValidacion !== ''): ?>
      <h2>Faltan datos por corregir</h2>
      <p><?php echo htmlspecialchars($errorValidacion, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php elseif ($resultado): ?>
      <h2>Mensaje enviado correctamente</h2>
      <p>Gracias <?php echo $nombreSeguro; ?>, te responderemos pronto.</p>
    <?php else: ?>
      <h2>Hubo un error</h2>
      <p>No se pudo guardar el mensaje.</p>
    <?php endif; ?>
    <br>
    <a href="index.html">Volver al inicio</a>
  </div>
</body>
</html>