# Formulario de Contacto — Universidad de La Salle
Aplicación web desarrollada como parte de la ACTIVIDAD 4: Taller práctico, ambientes en el desarrollo de producto, para Ingeniería de Software G-01.

## Descripción
Sitio web con página principal y formulario de contacto que permite a los usuarios enviar mensajes que quedan guardados en una base de datos MySQL.

## Tecnologías utilizadas
- HTML y CSS
- PHP
- MySQL
- XAMPP (servidor local Apache)

## Estructura del proyecto
- `index.html` — Página principal
- `contacto.php` — Formulario de contacto
- `procesar.php` — Procesamiento y guardado en base de datos
- `config.php` — Configuración de base de datos y contraseña de administración
- `admin.php` — Panel para ver y eliminar mensajes guardados
- `docs/DOCUMENTO-DE-REQUERIMIENTOS.pdf` — Documento de requerimientos del sistema

## Repositorio en GitHub
Código fuente y historial de cambios: [github.com/sascdev/formulario-lasalle](https://github.com/sascdev/formulario-lasalle)

### Uso básico de Git en este proyecto
1. Clonar: `git clone https://github.com/sascdev/formulario-lasalle.git`
2. Ver estado: `git status`
3. Guardar cambios: `git add .` → `git commit -m "descripción clara del cambio"` → `git push`

## Ambiente de desarrollo
- **Editor de código:** Visual Studio Code
- **Servidor local:** XAMPP (Apache)
- **Base de datos local:** MySQL Workbench

## Ambiente de pruebas y despliegue
- **Hosting:** InfinityFree
- **Base de datos en producción:** MySQL en InfinityFree
- **Panel de administración de BD:** phpMyAdmin
- **Dominio público:** https://formulario-lasalle.infinityfreeapp.com

## Evidencias
Capturas de pantalla del ambiente de desarrollo y pruebas disponibles en la carpeta [`/evidencias`](./evidencias):

1. XAMPP con Apache corriendo
2. MySQL Workbench con la tabla contactos y datos guardados
3. phpMyAdmin de InfinityFree con la base de datos en producción
4. Página principal de la aplicación
5. Formulario de contacto
6. Confirmación de mensaje enviado correctamente

## Panel de administración (eliminar mensajes)
1. Abre `admin.php` en el navegador (por ejemplo: `https://formulario-lasalle.infinityfreeapp.com/admin.php`).
2. Ingresa la contraseña definida en `config.php` (`ADMIN_PASSWORD`, por defecto `lasalle2026`).
3. En la tabla, usa el botón **Eliminar** del mensaje que quieras borrar (pide confirmación antes de borrar).

## Dominio público
🌐 https://formulario-lasalle.infinityfreeapp.com

## Integrantes - Grupo 1
- Sergio A. Silva Carrero
- Juliet Marianie Vásquez B.

## Ingeniería de Software - G_01
Universidad de La Salle — 2026
