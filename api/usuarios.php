<?php
// ============================================================
// api/usuarios.php — Crear y eliminar usuarios
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';
verificar_rol('admin');

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {

    case 'crear':
        $usuario  = trim($_POST['usuario_usu'] ?? '');
        $password = trim($_POST['password_usu'] ?? '');
        $rol      = trim($_POST['rol'] ?? '');

        if (!$usuario || !$password || !$rol) {
            header('Location: /admin/dashboard.php?tab=usuarios&error=faltan_datos');
            exit();
        }

        // Verificar si ya existe
        $check = $conn->prepare("SELECT id_usu FROM usuarios WHERE usuario_usu = ?");
        $check->execute([$usuario]);
        if ($check->fetch()) {
            header('Location: /admin/dashboard.php?tab=usuarios&error=usuario_existe');
            exit();
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario_usu, password_usu, rol) VALUES (?,?,?)");
        $stmt->execute([$usuario, $hash, $rol]);

        header('Location: /admin/dashboard.php?tab=usuarios&msg=usuario_creado');
        exit();

    case 'eliminar':
        $id = intval($_GET['id'] ?? 0);
        if (!$id) { header('Location: /admin/dashboard.php?tab=usuarios'); exit(); }

        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id_usu = ? AND usuario_usu != 'admin'");
        $stmt->execute([$id]);

        header('Location: /admin/dashboard.php?tab=usuarios&msg=usuario_eliminado');
        exit();
}

header('Location: /admin/dashboard.php?tab=usuarios');
exit();
