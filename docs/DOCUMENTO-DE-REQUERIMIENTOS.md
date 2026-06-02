# Documento de Requerimientos

**Universidad de La Salle — Arquitectura de Software**  
**Actividad 10: Proyecto final**

| | |
|---|---|
| **Integrantes** | Marianie Vásquez Brochero |
| | Sergio Andrés Silva Carrero |

> 📄 También disponible en formato PDF: [DOCUMENTO-DE-REQUERIMIENTOS.pdf](./DOCUMENTO-DE-REQUERIMIENTOS.pdf)

---

## 1. Descripción del sistema

El sistema es una aplicación web fullstack que permite a los usuarios enviar mensajes de contacto a la Universidad de La Salle. Los mensajes son recibidos a través de un formulario web, procesados por el servidor y almacenados de forma persistente en una base de datos MySQL. La aplicación está desplegada en un servidor web público y es accesible desde cualquier dispositivo con conexión a internet.

---

## 2. Requerimientos funcionales

| ID | Requerimiento | Descripción |
|----|---------------|-------------|
| **RF-01** | Página principal | El sistema debe mostrar una página de inicio con el nombre de la institución, un mensaje de bienvenida, opciones de navegación y un botón de acceso al formulario de contacto. |
| **RF-02** | Formulario de contacto | El sistema debe presentar un formulario con los campos: nombre completo (texto), correo electrónico (email), teléfono (texto), asunto (lista desplegable: Información de programas, Admisiones, Otro) y mensaje (área de texto). |
| **RF-03** | Validación de campos | El sistema debe validar que los campos nombre, correo electrónico y mensaje estén completos antes de permitir el envío. En caso contrario, el navegador debe notificar al usuario. |
| **RF-04** | Almacenamiento en base de datos | Al enviar el formulario, el sistema debe insertar los datos en la tabla `contactos` de MySQL (nombre, email, teléfono, asunto, mensaje). |
| **RF-05** | Confirmación de envío | Tras procesar correctamente el formulario, el sistema debe mostrar una página de confirmación con el nombre del remitente. |
| **RF-06** | Navegación entre páginas | El sistema debe permitir navegar entre la página principal y el formulario mediante una barra de navegación visible en todas las páginas. |

---

## 3. Requerimientos no funcionales

| ID | Requerimiento | Descripción |
|----|---------------|-------------|
| **RNF-01** | Disponibilidad | La aplicación debe estar disponible públicamente en internet. **URL:** https://formulario-lasalle.infinityfreeapp.com |
| **RNF-02** | Usabilidad | Interfaz coherente con la identidad institucional: colores `#003087` (azul oscuro) y `#0050b3` (azul medio), tipografía legible. |
| **RNF-03** | Seguridad | Los datos del formulario deben sanitizarse con `htmlspecialchars()` antes de insertarse en la base de datos. |
| **RNF-04** | Compatibilidad | Debe funcionar en Chrome, Firefox, Safari y Brave. |
| **RNF-05** | Control de versiones | Código versionado en GitHub con historial de commits. **Repositorio:** https://github.com/sascdev/formulario-lasalle |

---

## 4. Documento de arquitectura

### Descripción

La aplicación **Formulario de Contacto — Universidad de La Salle** es un sistema web fullstack bajo el patrón **Modelo Vista Controlador (MVC)**. Permite la captura, procesamiento y persistencia de mensajes de contacto enviados por usuarios.

### 5. Patrón arquitectónico: MVC

| Capa | Archivos | Responsabilidad |
|------|----------|-----------------|
| **Vista** | `index.html`, `contacto.php` | Interfaz gráfica (HTML/CSS). El usuario interactúa solo con esta capa. Sin lógica de negocio ni acceso directo a datos. |
| **Controlador** | `procesar.php` | Recibe datos por POST, sanitiza con `htmlspecialchars()`, conecta a la BD y coordina el almacenamiento. Devuelve la respuesta al usuario. |
| **Modelo** | MySQL — tabla `contactos` | Almacenamiento persistente de los registros. |

#### Estructura de la tabla `contactos`

| Campo | Tipo |
|-------|------|
| `id` | INT, AUTO_INCREMENT, PRIMARY KEY |
| `nombre` | VARCHAR(100) |
| `email` | VARCHAR(100) |
| `telefono` | VARCHAR(20) |
| `asunto` | VARCHAR(50) |
| `mensaje` | TEXT |

### 6. Flujo de interacción

1. El usuario accede a la aplicación desde el navegador.
2. La **Vista** presenta el formulario de contacto.
3. El usuario completa y envía el formulario.
4. El **Controlador** recibe los datos vía POST.
5. El **Controlador** sanitiza los datos y ejecuta el INSERT en MySQL.
6. El **Modelo** confirma el almacenamiento exitoso.
7. El **Controlador** devuelve la vista de confirmación al usuario.

### 7. Stack tecnológico

| Área | Tecnología |
|------|------------|
| Frontend | HTML5, CSS3 |
| Backend | PHP 8.2 |
| Base de datos | MySQL 8.0 |
| Servidor local | Apache (XAMPP) |
| Hosting producción | InfinityFree |
| Control de versiones | Git / GitHub |

### 8. Estructura del proyecto

```
formulario-lasalle/
├── index.html      → Vista: página principal
├── contacto.php    → Vista: formulario de contacto
├── procesar.php    → Controlador
├── config.php      → Conexión a base de datos
├── admin.php       → Panel de administración
├── docs/           → Documentación (este archivo y PDF)
├── evidencias/     → Capturas del desarrollo
├── README.md
└── .gitignore
```

### 9. Despliegue

| Ambiente | Detalle |
|----------|---------|
| **Local** | Apache + MySQL (XAMPP), edición en Visual Studio Code |
| **Producción** | InfinityFree (Apache + MySQL) |
| **Dominio** | https://formulario-lasalle.infinityfreeapp.com |
| **Repositorio** | https://github.com/sascdev/formulario-lasalle |
| **BD en producción** | phpMyAdmin — sql113.infinityfree.com |

### 10. Decisiones de diseño

- **PHP:** integración nativa con Apache y MySQL; despliegue sencillo.
- **InfinityFree:** hosting gratuito con PHP y MySQL, sin costo para el proyecto.
- **MVC:** separación clara de responsabilidades para mantenimiento y trabajo en equipo.

---

*Universidad de La Salle — Ingeniería de Software — 2026*
