<?php
// ============================================================
// api/grupos.php — Crear y eliminar grupos
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';
verificar_rol('admin');

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {

    case 'crear':
        $id_usu = intval($_POST['id_usu']    ?? 0);
        $grupo  = trim($_POST['grupo_gpo']   ?? '');

        if (!$id_usu || !$grupo) {
            header('Location: /admin/dashboard.php?tab=grupos&error=faltan_datos');
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO grupo (id_usu, grupo_gpo) VALUES (?,?)");
        $stmt->execute([$id_usu, $grupo]);

        header('Location: /admin/dashboard.php?tab=grupos&msg=grupo_creado');
        exit();

    case 'eliminar':
        $id = intval($_GET['id'] ?? 0);
        if (!$id) { header('Location: /admin/dashboard.php?tab=grupos'); exit(); }

        $stmt = $conn->prepare("DELETE FROM grupo WHERE id_gpo = ?");
        $stmt->execute([$id]);

        header('Location: /admin/dashboard.php?tab=grupos&msg=grupo_eliminado');
        exit();
}

header('Location: /admin/dashboard.php?tab=grupos');
exit();
