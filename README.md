# Gestion-de-alumnos-Graduacion
# 📘 Documentación del Proyecto: Gestión de Asistencia y Asignación de Código

## 📝 Descripción del Proyecto
Este sistema permite a los usuarios:
- Agregar nuevos alumnos.
- Ver la asistencia por grupo.
- Buscar alumnos por código.
- Comunicación en tiempo real mediante **Websockets**.

Tecnologías usadas:
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Backend**: PHP
- **Tiempo real**: Websockets (Ratchet o Swoole)

---

## 📁 Estructura del Proyecto
/Gestion de Personas ├── css/ │ └── bootstrap.min.css ├── js/ ├── index.php ├── ver_asistencia.html ├── agregar_alumno.html ├── presentador.html ├── index.html ├── buscar_estudiante.html └── buscar_por_codigo.html

---

## ✅ Requisitos
- Servidor web con soporte PHP (Apache, Nginx, etc.).
- Entorno local como XAMPP/WAMP/MAMP.
- Base de datos MySQL o similar.
- Extensión de PHP para Websockets.

---

## ⚙️ Instalación

### 1. Descargar y configurar el servidor
Coloca el proyecto en la carpeta pública de tu servidor (por ejemplo, `htdocs` en XAMPP).

### 2. Crear la base de datos
Tabla sugerida: `alumnos`

Campos:
- `matricula`
- `nombre_completo`
- `carrera`
- `grupo`
- `codigo` (opcional)
- `asistencia` (boolean)

### 3. Configurar conexión en `index.php`
Ajusta los datos de conexión (host, usuario, contraseña, nombre de BD).

### 4. Configurar Websockets
Instala y configura Ratchet o Swoole para que el servidor acepte conexiones en tiempo real.

---

## 🧩 Funcionalidades

### ➕ Agregar Alumnos
Desde `agregar_alumno.html`, se envía un formulario AJAX para registrar nuevos alumnos.

### 📊 Ver Asistencia por Grupo
Desde `ver_asistencia.html`, se consulta la asistencia por grupo y se puede exportar a PDF.

### 🔍 Buscar por Código
Desde `buscar_por_codigo.html`, se consulta un alumno por su código específico.

### 🧑‍🏫 Modo Presentador
Desde `presentador.html`, el sistema actualiza la asistencia en tiempo real gracias a Websockets.

---

## 🔧 Cambios Destacados
- Websockets en `presentador.html` para asistencia en tiempo real.
- Mejora de la UI con Bootstrap.
- Optimización de las solicitudes AJAX.

---

## 🧪 Tecnologías Utilizadas
- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP, MySQL
- **Websockets**: Ratchet o Swoole
- **Frameworks**: Bootstrap 5.3.3

---

## 🛠️ Mantenimiento
- Actualizar base de datos regularmente.
- Verificar funcionamiento de Websockets.
- Optimizar el código periódicamente.

---

## 🧩 Posibles Problemas y Soluciones

### ❌ Conexión a la Base de Datos
- Verifica que el servidor y credenciales estén correctos.
- Asegúrate de que las tablas existan.

### ❌ Websockets no funcionan
- Verifica si están instalados y habilitados.
- Asegúrate de que no hay firewalls bloqueando puertos.

### ❌ Errores AJAX
- Revisa la consola del navegador.
- Verifica rutas a los archivos PHP.
- Depura el código PHP.

---

## 🤝 Contribuciones
¡Las contribuciones son bienvenidas!  
Abre un **issue** o envía un **pull request** si deseas colaborar.

---
