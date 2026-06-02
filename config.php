<?php
// Configuración de base de datos (InfinityFree / XAMPP local)
define('DB_HOST', 'sql113.infinityfree.com');
define('DB_USER', 'if0_41434984');
define('DB_PASS', '5V7fHvzW1YMKE');
define('DB_NAME', 'if0_41434984_lasalle');

// Contraseña para entrar al panel de administración (cámbiala en producción)
define('ADMIN_PASSWORD', 'lasalle2026');

function obtenerConexion(): mysqli
{
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
  }

  $conn->set_charset('utf8mb4');
  return $conn;
}
