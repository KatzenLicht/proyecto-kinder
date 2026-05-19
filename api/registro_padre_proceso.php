<?php
// ============================================================
// api/registro_padre_proceso.php
// Procesa el registro del padre: crea usuario + perfil padre
// ============================================================
ob_start();

require_once '../includes/db.php';

if (session_status() === PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../registro_padre.php');
    exit();
}

$usuario   = trim($_POST['usuario_usu']      ?? '');
$password  = trim($_POST['password_usu']     ?? '');
$confirm   = trim($_POST['password_confirm'] ?? '');
$nombre    = trim($_POST['nombre_padre']     ?? '');
$telefono  = trim($_POST['telefono_padre']   ?? '');
$correo    = trim($_POST['correo_padre']     ?? '');

// ── Validaciones ────────────────────────────────────────────
if (!$usuario || !$password || !$confirm || !$nombre || !$telefono || !$correo) {
    header('Location: ../registro_padre.php?error=faltan_datos');
    exit();
}

if ($password !== $confirm) {
    header('Location: ../registro_padre.php?error=pass_no_coincide');
    exit();
}

// Verificar si el usuario ya existe
$check = $conn->prepare("SELECT id_usu FROM usuarios WHERE usuario_usu = ?");
$check->execute([$usuario]);
if ($check->fetch()) {
    header('Location: ../registro_padre.php?error=usuario_existe');
    exit();
}

try {
    // 1. Crear usuario con rol padre
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (usuario_usu, password_usu, rol) VALUES (?, ?, 'padre')");
    $stmt->execute([$usuario, $hash]);
    $id_usu = $conn->lastInsertId();

    // 2. Crear perfil del padre (sin hijo aún)
    $stmt = $conn->prepare("INSERT INTO padres (id_usu, nombre_padre, telefono_padre, correo_padre) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id_usu, $nombre, $telefono, $correo]);

    // 3. Guardar datos en sesión temporal para que JS envíe el correo
    $_SESSION['nuevo_padre'] = [
        'nombre'  => $nombre,
        'correo'  => $correo,
        'usuario' => $usuario,
    ];

    ob_end_clean();
    // Redirigir a página de éxito que disparará EmailJS
    header('Location: ../registro_exitoso.php');
    exit();

} catch (PDOException $e) {
    header('Location: ../registro_padre.php?error=db_error');
    exit();
}
