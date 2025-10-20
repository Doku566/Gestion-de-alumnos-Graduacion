# 📘 Documentación del Proyecto: Gestión de Asistencia y Asignación de Código

## 📝 Descripción del Proyecto
Este sistema permite a los usuarios:
- Agregar nuevos alumnos.
- Ver la asistencia por grupo.
- Buscar alumnos por código.
- Comunicación en tiempo real mediante **Websockets**.

El proyecto se ha desarrollado utilizando tecnologías web como **HTML**, **CSS**, **JavaScript**, y **PHP**, con la ayuda de **Bootstrap** para la interfaz de usuario. Además, se utiliza **jsPDF** para generar PDF de la lista de asistencia.

---

## 📁 Estructura del Proyecto

/Gestion-de-Alumnos 
├── bootstrap-5.3.3-dist/ # Archivos de Bootstrap 
├── img/ # Imágenes usadas en el proyecto 
├── jquery/ # Archivos de jQuery 
├── jsPDF-2.5.2/ # Librería jsPDF 
├── jsPDF-AutoTable-3.8.4/ # Librería jsPDF AutoTable 
├── node_modules/ # Dependencias de Node.js 
├── popper/ # Popper.js para el manejo de popups 
├── Alumnos_de_Ingreso_Tardio.html 
├── Doc.html 
├── Presentador.html 
├── README.md # Documentación del proyecto 
├── buscar_estudiante.html 
├── buscar_por_codigo.html 
├── correcciones.html 
├── index.html 
├── index.php # Lógica de backend en PHP 
├── package-lock.json # Lockfile de dependencias de Node.js 
├── package.json # Configuración de Node.js 
├── server.js # Servidor Node.js para Websockets 
└── ver_asistencia.html



---

## ✅ Requisitos

- Servidor web con soporte PHP (Apache, Nginx, etc.).
- Entorno local como XAMPP/WAMP/MAMP.
- Base de datos MySQL o similar.
- Extensión de PHP para Websockets (Ratchet o Swoole).
- Node.js para la parte de Websockets (`server.js`).

---

## ⚙️ Instalación

### 1. Descargar y configurar el servidor
Coloca el proyecto en la carpeta pública de tu servidor (por ejemplo, `htdocs` en XAMPP).

### 2. Crear la base de datos
Crea una base de datos y una tabla llamada `alumnos` con los siguientes campos:

- `matricula`
- `nombre_completo`
- `carrera`
- `grupo`
- `codigo` (opcional)
- `asistencia` (booleano)

### 3. Configurar conexión a la base de datos
En `index.php`, ajusta los datos de conexión: host, usuario, contraseña y nombre de base de datos.

### 4. Configurar Websockets
Instala y configura **Ratchet** o **Swoole** para la comunicación en tiempo real. Asegúrate de tener **Node.js** instalado para usar el archivo `server.js`.

---

## 🧩 Funcionalidades

### ➕ Agregar Alumnos
Desde `agregar_alumno.html`, se pueden registrar nuevos alumnos mediante un formulario con AJAX.

### 📊 Ver Asistencia por Grupo
Desde `ver_asistencia.html`, se muestra la lista de alumnos presentes en un grupo y se puede exportar en PDF usando **jsPDF**.

### 🔍 Buscar por Código
En `buscar_por_codigo.html`, se puede ingresar un código para buscar la información del alumno correspondiente.

### 🧑‍🏫 Modo Presentador
Desde `presentador.html`, los cambios de asistencia se reflejan en tiempo real gracias a Websockets, permitiendo la interacción instantánea entre los usuarios.

---

## 🔧 Cambios Realizados

- Se implementaron Websockets para actualizaciones en tiempo real.
- Mejoras en la interfaz con **Bootstrap**.
- Optimización de peticiones AJAX.
- Integración de **jsPDF** para la generación de PDF de asistencia.

---

## 💻 Tecnologías Utilizadas

### Frontend
- HTML5
- CSS3
- JavaScript
- jQuery
- Bootstrap 5.3.3

### Backend
- PHP
- MySQL (o compatible)
- Websockets (Ratchet o Swoole)
- Node.js para el servidor Websocket

### Librerías
- **jsPDF** para la generación de PDFs.
- **jsPDF-AutoTable** para la creación de tablas dentro de PDFs.

---

## 🛠️ Mantenimiento

- Actualiza frecuentemente la base de datos con nuevos alumnos y asistencias.
- Verifica el correcto funcionamiento del sistema de Websockets y Node.js.
- Realiza pruebas periódicas para mantener el rendimiento del sistema.

---

## ❗ Posibles Problemas y Soluciones

### 🔌 Problemas de Conexión a la Base de Datos
- Asegúrate de que el servidor de base de datos esté activo.
- Verifica que las credenciales en `index.php` sean correctas.
- Confirma que la tabla `alumnos` exista.

### 🔄 Problemas con Websockets
- Comprueba que la extensión Websockets esté instalada y habilitada en PHP.
- Asegúrate de que el servidor Websocket (`server.js`) esté ejecutándose.
- Verifica configuraciones de firewall.

### ⚠️ Problemas con Solicitudes AJAX
- Usa la consola del navegador para identificar errores de JavaScript.
- Asegúrate de que las rutas PHP sean correctas.
- Verifica el código PHP en busca de errores.

---
Aqui se encuentra un Demo Visual de como es  https://doku566.github.io/Gestion-de-alumnos-Graduacion/


