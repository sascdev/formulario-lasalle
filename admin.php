<?php
session_start();
require_once 'config.php';

$aviso = '';
$error = '';

// Cerrar sesión
if (isset($_POST['accion']) && $_POST['accion'] === 'logout') {
  session_destroy();
  header('Location: admin.php');
  exit;
}

// Iniciar sesión
if (isset($_POST['accion']) && $_POST['accion'] === 'login') {
  $clave = isset($_POST['clave']) ? $_POST['clave'] : '';
  if ($clave === ADMIN_PASSWORD) {
    $_SESSION['admin'] = true;
    header('Location: admin.php');
    exit;
  }
  $error = 'Contraseña incorrecta.';
}

$logueado = !empty($_SESSION['admin']);

// Eliminar un mensaje por ID
if ($logueado && isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
  $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

  if ($id > 0) {
    $conn = obtenerConexion();
    $stmt = $conn->prepare('DELETE FROM contactos WHERE id = ?');
    $stmt->bind_param('i', $id);
    if ($stmt->execute() && $stmt->affected_rows > 0) {
      $aviso = 'Mensaje eliminado correctamente.';
    } else {
      $error = 'No se encontró el mensaje o ya fue eliminado.';
    }
    $stmt->close();
    $conn->close();
  } else {
    $error = 'Identificador de mensaje no válido.';
  }
}

$mensajes = [];
if ($logueado) {
  $conn = obtenerConexion();
  $resultado = $conn->query(
    'SELECT id, nombre, email, telefono, asunto, mensaje FROM contactos ORDER BY id DESC'
  );
  if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
      $mensajes[] = $fila;
    }
    $resultado->free();
  }
  $conn->close();
}

function esc($texto): string
{
  return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrar mensajes — Universidad de La Salle</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f2f2f2;
    }
    .header {
      background-color: #003087;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .nav {
      background-color: #0050b3;
      padding: 10px 20px;
    }
    .nav a {
      color: white;
      text-decoration: none;
      margin-right: 15px;
    }
    .contenedor {
      max-width: 960px;
      margin: 30px auto;
      padding: 0 20px 40px;
    }
    .caja {
      background: white;
      padding: 25px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    h2 { color: #003087; margin-top: 0; }
    label { display: block; font-weight: bold; margin-bottom: 6px; }
    input[type="password"] {
      width: 100%;
      max-width: 320px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 12px;
    }
    button, .btn {
      background-color: #003087;
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.95em;
    }
    .btn-eliminar {
      background-color: #b00020;
    }
    .btn-secundario {
      background-color: #6c757d;
    }
    .aviso {
      background: #e6f4ea;
      color: #1e4620;
      padding: 12px;
      border-radius: 4px;
      margin-bottom: 15px;
    }
    .error {
      background: #fdecea;
      color: #611a15;
      padding: 12px;
      border-radius: 4px;
      margin-bottom: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.9em;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
      vertical-align: top;
    }
    th {
      background-color: #003087;
      color: white;
    }
    tr:nth-child(even) { background-color: #f9f9f9; }
    .mensaje-celda {
      max-width: 220px;
      word-break: break-word;
    }
    .vacio {
      color: #666;
      text-align: center;
      padding: 20px;
    }
    .footer {
      background-color: #003087;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 40px;
    }
    .acciones-superior {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>Universidad de La Salle</h1>
    <p>Panel de administración</p>
  </div>

  <div class="nav">
    <a href="index.html">Inicio</a>
    <a href="contacto.php">Contacto</a>
    <a href="admin.php">Administrar mensajes</a>
  </div>

  <div class="contenedor">

    <?php if (!$logueado): ?>

      <div class="caja">
        <h2>Ingresar al panel</h2>
        <p>Solo personal autorizado puede ver y eliminar mensajes del formulario.</p>
        <?php if ($error !== ''): ?>
          <div class="error"><?php echo esc($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="admin.php">
          <input type="hidden" name="accion" value="login">
          <label for="clave">Contraseña:</label>
          <input id="clave" type="password" name="clave" required>
          <button type="submit">Entrar</button>
        </form>
      </div>

    <?php else: ?>

      <div class="caja">
        <div class="acciones-superior">
          <h2>Mensajes recibidos (<?php echo count($mensajes); ?>)</h2>
          <form method="POST" action="admin.php" style="display:inline;">
            <input type="hidden" name="accion" value="logout">
            <button type="submit" class="btn-secundario">Cerrar sesión</button>
          </form>
        </div>

        <?php if ($aviso !== ''): ?>
          <div class="aviso"><?php echo esc($aviso); ?></div>
        <?php endif; ?>
        <?php if ($error !== ''): ?>
          <div class="error"><?php echo esc($error); ?></div>
        <?php endif; ?>

        <?php if (count($mensajes) === 0): ?>
          <p class="vacio">No hay mensajes guardados en la base de datos.</p>
        <?php else: ?>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Asunto</th>
                <th>Mensaje</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($mensajes as $m): ?>
                <tr>
                  <td><?php echo (int) $m['id']; ?></td>
                  <td><?php echo esc($m['nombre']); ?></td>
                  <td><?php echo esc($m['email']); ?></td>
                  <td><?php echo esc($m['telefono']); ?></td>
                  <td><?php echo esc($m['asunto']); ?></td>
                  <td class="mensaje-celda"><?php echo esc($m['mensaje']); ?></td>
                  <td>
                    <form method="POST" action="admin.php"
                          onsubmit="return confirm('¿Seguro que deseas eliminar este mensaje?');">
                      <input type="hidden" name="accion" value="eliminar">
                      <input type="hidden" name="id" value="<?php echo (int) $m['id']; ?>">
                      <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>

    <?php endif; ?>

  </div>

  <div class="footer">
    <p>Universidad de La Salle - 2026</p>
  </div>

</body>
</html>
