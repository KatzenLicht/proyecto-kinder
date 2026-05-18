<?php
// ============================================================
// includes/auth.php
// Manejo de sesiones y control de acceso por rol
// ============================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ------------------------------------------------------------
// Verifica que el usuario esté logueado.
// Si no, lo manda al login.
// ------------------------------------------------------------
function verificar_sesion() {
    if (!isset($_SESSION['id_usu'])) {
        header('Location: /login.php');
        exit();
    }
}

// ------------------------------------------------------------
// Verifica que el usuario tenga el rol correcto.
// $roles puede ser un string o un array de roles permitidos.
// Ejemplo: verificar_rol('admin')
//          verificar_rol(['admin', 'docente'])
// ------------------------------------------------------------
function verificar_rol($roles) {
    verificar_sesion();

    if (is_string($roles)) {
        $roles = [$roles];
    }

    if (!in_array($_SESSION['rol'], $roles)) {
        // No tiene permiso — lo manda a su dashboard correspondiente
        redirigir_por_rol();
    }
}

// ------------------------------------------------------------
// Redirige al dashboard según el rol del usuario en sesión
// ------------------------------------------------------------
function redirigir_por_rol() {
    $rol = $_SESSION['rol'] ?? '';

    switch ($rol) {
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
            header('Location: /login.php');
            break;
    }
    exit();
}

// ------------------------------------------------------------
// Devuelve el nombre del usuario en sesión
// ------------------------------------------------------------
function nombre_sesion() {
    return $_SESSION['usuario'] ?? 'Usuario';
}

// ------------------------------------------------------------
// Devuelve el rol del usuario en sesión
// ------------------------------------------------------------
function rol_sesion() {
    return $_SESSION['rol'] ?? '';
}

// ------------------------------------------------------------
// Devuelve el id del usuario en sesión
// ------------------------------------------------------------
function id_sesion() {
    return $_SESSION['id_usu'] ?? null;
}
