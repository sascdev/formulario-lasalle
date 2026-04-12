<?php
// recibimos los datos que vienen del formulario
$nombre   = $_POST['nombre'];
$email    = $_POST['email'];
$telefono = $_POST['telefono'];
$asunto   = $_POST['asunto'];
$mensaje  = $_POST['mensaje'];

// conectamos a la base de datos que creamos en XAMPP
$conn = new mysqli("sql113.infinityfree.com", "if0_41434984", "5V7fHvzW1YMKE", "if0_41434984_lasalle");

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// guardamos los datos en la tabla contactos
$sql = "INSERT INTO contactos (nombre, email, telefono, asunto, mensaje) 
        VALUES ('$nombre', '$email', '$telefono', '$asunto', '$mensaje')";

$resultado = $conn->query($sql);
$conn->close();
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
    <?php if ($resultado): ?>
      <h2>Mensaje enviado correctamente</h2>
      <p>Gracias <?php echo $nombre; ?>, te responderemos pronto.</p>
    <?php else: ?>
      <h2>Hubo un error</h2>
      <p>No se pudo guardar el mensaje.</p>
    <?php endif; ?>
    <br>
    <a href="index.html">Volver al inicio</a>
  </div>
</body>
</html>