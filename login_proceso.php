<?php
// ============================================================
// login_proceso.php
// Valida credenciales y crea la sesión del usuario
// ============================================================

ob_start();

if (session_status() === PHP_SESSION_NONE) session_start();

require_once 'includes/db.php';

// Solo acepta POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit();
}

$usuario  = trim($_POST['usuario_usu'] ?? '');
$password = trim($_POST['password_usu'] ?? '');

// Validar que no estén vacíos
if (empty($usuario) || empty($password)) {
    header('Location: login.php?error=vacio');
    exit();
}

try {
    // Buscar usuario en la BD
    $stmt = $conn->prepare("SELECT id_usu, usuario_usu, password_usu, rol FROM usuarios WHERE usuario_usu = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    // Usuario no existe
    if (!$user) {
        header('Location: login.php?error=usuario');
        exit();
    }

    // Contraseña incorrecta
    if (!password_verify($password, $user['password_usu'])) {
        header('Location: login.php?error=password');
        exit();
    }

    // ✅ Credenciales correctas — crear sesión
    session_regenerate_id(true);

    $_SESSION['id_usu']  = $user['id_usu'];
    $_SESSION['usuario'] = $user['usuario_usu'];
    $_SESSION['rol']     = $user['rol'];

    // Si es docente, guardar también su id_per para consultas rápidas
    if ($user['rol'] === 'docente') {
        $stmt2 = $conn->prepare("SELECT id_per, maestra_per FROM personal WHERE id_usu = ?");
        $stmt2->execute([$user['id_usu']]);
        $personal = $stmt2->fetch();
        if ($personal) {
            $_SESSION['id_per']      = $personal['id_per'];
            $_SESSION['nombre_real'] = $personal['maestra_per'];
        }
    }

    // Si es padre, guardar su id_padre y el alumno vinculado
    if ($user['rol'] === 'padre') {
        $stmt3 = $conn->prepare("SELECT id_padre, nombre_padre, id_alu FROM padres WHERE id_usu = ?");
        $stmt3->execute([$user['id_usu']]);
        $padre = $stmt3->fetch();
        if ($padre) {
            $_SESSION['id_padre']    = $padre['id_padre'];
            $_SESSION['nombre_real'] = $padre['nombre_padre'];
            $_SESSION['id_alu']      = $padre['id_alu'];
        }
    }

    // Redirigir según rol
    ob_end_clean();
    switch ($user['rol']) {
        case 'admin':
            header('Location: /admin/dashboard.php');
            break;
        case 'docente':
            header('Location: /maestra/dashboard.php');
            break;
        case 'padre':
            header('Location: /padre/dashboard.php');
            break;
        default:
            header('Location: login.php?error=usuario');
            break;
    }
    exit();

} catch (PDOException $e) {
    header('Location: login.php?error=usuario');
    exit();
}
