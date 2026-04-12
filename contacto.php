<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulario de Contacto — Universidad de La Salle</title>
  <!-- estilos del formulario -->
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

    /* caja del formulario */
    .formulario {
      max-width: 500px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 8px;
    }

    .formulario h2 {
      color: #003087;
      margin-bottom: 20px;
    }

    /* campos del formulario */
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      font-size: 0.9em;
    }

    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 0.95em;
    }

    button {
      background-color: #003087;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    .footer {
      background-color: #003087;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 60px;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>Universidad de La Salle</h1>
  </div>

  <div class="nav">
    <a href="index.html">Inicio</a>
    <a href="contacto.php">Contacto</a>
  </div>

  <div class="formulario">
    <h2>Formulario de Contacto</h2>

    <!-- el formulario envia los datos a procesar.php -->
    <form action="procesar.php" method="POST">

<<<<<<< HEAD
      <label for="nombre">Nombre:</label>
      <input id="nombre" type="text" name="nombre" placeholder="Tu nombre completo" required>

      <label for="email">Correo electrónico:</label>
      <input id="email" type="email" name="email" placeholder="correo@ejemplo.com" required>

      <label for="telefono">Teléfono:</label>
      <input id="telefono" type="tel" name="telefono" placeholder="Ej: 300 000 0000">

      <label for="asunto">Asunto:</label>
      <select id="asunto" name="asunto">
=======
      <label>Nombre:</label>
      <input type="text" name="nombre" placeholder="Tu nombre completo" required>

      <label>Correo electrónico:</label>
      <input type="email" name="email" placeholder="correo@ejemplo.com" required>

      <label>Teléfono:</label>
      <input type="tel" name="telefono" placeholder="Ej: 300 000 0000">

      <label>Asunto:</label>
      <select name="asunto">
>>>>>>> equipo/main
        <option value="informacion">Información de programas</option>
        <option value="admisiones">Admisiones</option>
        <option value="otro">Otro</option>
      </select>

      <label for="mensaje">Mensaje:</label>
      <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje..." required></textarea>

      <button type="submit">Enviar</button>

    </form>
  </div>

  <div class="footer">
    <p>Universidad de La Salle - 2026</p>
    <p>Elaborado por: Sergio A. Silva y Juliet Marianie Vásquez B.</p>
  </div>

</body>
</html>