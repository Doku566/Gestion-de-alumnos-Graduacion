<?php
$host = 'localhost';
$db = 'escuela';
$user = 'root';
$pass = '';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Función para buscar estudiantes por matrícula o nombre
    function buscarEstudiantes($pdo, $busqueda) {
        $stmt = $pdo->prepare("SELECT * FROM lista_final_2024 WHERE matricula LIKE ? OR nombre_completo LIKE ?");
        $stmt->execute(["%$busqueda%", "%$busqueda%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Función para verificar si el código ya está asignado, pero ignorar si está vacío
    function verificarCodigo($pdo, $codigo) {
        if (empty($codigo)) return false; // Ignora si el código está vacío
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM lista_final_2024 WHERE codigo = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] > 0;
    }

    // Función para asignar código y marcar asistencia
    function asignarCodigo($pdo, $matricula, $codigo) {
        // Verificar el código sólo si no está vacío
        if (!empty($codigo) && verificarCodigo($pdo, $codigo)) {
            return ['mensaje' => 'Error: Este código ya está asignado a otro estudiante.'];
        }

        $stmt = $pdo->prepare("UPDATE lista_final_2024 SET codigo = ?, asistencia = 1 WHERE matricula = ?");
        $stmt->execute([$codigo, $matricula]);
        return ['mensaje' => 'Código asignado correctamente.'];
    }

    // Función para buscar estudiante por código
    function buscarPorCodigo($pdo, $codigo) {
        $stmt = $pdo->prepare("SELECT * FROM lista_final_2024 WHERE codigo = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Función para ver asistencia de estudiantes
    function verAsistencia($pdo) {
        $stmt = $pdo->prepare("SELECT matricula, nombre_completo,carrera, grupo, asistencia, codigo FROM lista_final_2024");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Función para agregar nuevo alumno
    function agregarAlumno($pdo, $matricula, $nombre_completo, $carrera, $grupo, $codigo) {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM lista_final_2024 WHERE matricula = ?");
        $stmt->execute([$matricula]);
        
        if ($stmt->fetch(PDO::FETCH_ASSOC)['total'] > 0) {
            return ['mensaje' => 'Error: Ya existe un alumno con esa matrícula.'];
        }

        // Verificar el código sólo si no está vacío
        if (!empty($codigo) && verificarCodigo($pdo, $codigo)) {
            return ['mensaje' => 'Error: Este código ya está asignado a otro estudiante.'];
        }

        $asistencia = $codigo ? 1 : 0; 
        $stmt = $pdo->prepare("INSERT INTO lista_final_2024 (matricula, nombre_completo, carrera, grupo, codigo, asistencia) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$matricula, $nombre_completo, $carrera, $grupo, $codigo, $asistencia]);

        return ['mensaje' => 'Alumno agregado correctamente.'];
    }

    // Manejo de las diferentes acciones
    if (isset($_GET['buscar'])) {
        echo json_encode(buscarEstudiantes($pdo, $_GET['buscar']));
    } elseif (isset($_GET['verificar_codigo'])) {
        echo json_encode(['existe' => verificarCodigo($pdo, $_GET['verificar_codigo'])]);
    } elseif (isset($_GET['asignar_codigo'])) {
        echo json_encode(asignarCodigo($pdo, $_GET['asignar_codigo'], $_GET['codigo']));
    } elseif (isset($_GET['buscar_codigo'])) {
        echo json_encode(buscarPorCodigo($pdo, $_GET['buscar_codigo']));
    } elseif (isset($_GET['ver_asistencia'])) {
        echo json_encode(verAsistencia($pdo));
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_alumno'])) {
        echo json_encode(agregarAlumno($pdo, $_POST['matricula'], $_POST['nombre_completo'], $_POST['carrera'], $_POST['grupo'], $_POST['codigo'] ?? null));
    } else {
        echo json_encode(["error" => "Acción no válida."]);
    }

} catch (PDOException $e) {
    echo json_encode(["error" => "Error: " . $e->getMessage()]);
}
