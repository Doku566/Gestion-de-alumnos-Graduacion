const WebSocket = require('ws');
const mysql = require('mysql2');

// Configuraciones del servidor
const host = '0.0.0.0'; // Escuchar en todas las interfaces de red
const port = 9090;

// Crear el servidor WebSocket
const wss = new WebSocket.Server({ host, port });

// Conexión a la base de datos MySQL
const db = mysql.createConnection({
    host: 'localhost', // Mantén esto como 'localhost' para la conexión a la base de datos
    user: 'root', // Cambia esto si tienes un usuario diferente
    password: '', // Cambia esto si tienes una contraseña
    database: 'escuela' // Nombre de tu base de datos
});

// Conectar a la base de datos
db.connect((err) => {
    if (err) {
        console.error('Error conectando a la base de datos:', err);
        process.exit(1); // Terminar el servidor si no hay conexión
    } else {
        console.log('Conectado a la base de datos MySQL.');
    }
});

// Manejar conexiones entrantes
wss.on('connection', (ws) => {
    console.log('Nuevo cliente conectado');

    // Manejar mensajes del cliente
    ws.on('message', (message) => {
        let data;
        try {
            data = JSON.parse(message); // Intentar parsear el mensaje
        } catch (e) {
            console.error('Mensaje inválido recibido:', message);
            ws.send(JSON.stringify({ error: 'Mensaje inválido' }));
            return;
        }

        // Validar si se envió el código
        if (data.codigo) {
            // Buscar estudiante por código
            db.query('SELECT * FROM Prueba1 WHERE codigo = ?', [data.codigo], (err, results) => {
                if (err) {
                    console.error('Error en la consulta:', err);
                    ws.send(JSON.stringify({ error: 'Error en la consulta de la base de datos' }));
                    return;
                }

                // Enviar el resultado a todos los clientes conectados
                const estudiante = results.length > 0 ? results[0] : null;
                broadcast(JSON.stringify(estudiante || { error: 'Estudiante no encontrado' }));
            });
        } else {
            ws.send(JSON.stringify({ error: 'Código no proporcionado' }));
        }
    });

    // Manejar desconexiones
    ws.on('close', () => {
        console.log('Cliente desconectado');
    });

    // Manejar errores de WebSocket
    ws.on('error', (err) => {
        console.error('Error en WebSocket:', err);
    });
});

// Función para enviar datos a todos los clientes conectados
function broadcast(message) {
    wss.clients.forEach((client) => {
        if (client.readyState === WebSocket.OPEN) {
            client.send(message);
        }
    });
}

console.log(`Servidor WebSocket escuchando en ws://${host}:${port}`);
