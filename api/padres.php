<?php
// ============================================================
// api/padres.php — Eliminar padres (solo admin)
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';
verificar_rol('admin');

$accion = $_GET['accion'] ?? '';

if ($accion === 'eliminar') {
    $id = intval($_GET['id'] ?? 0);
    if ($id) {
        // Primero eliminar el usuario vinculado
        $padre = $conn->prepare("SELECT id_usu FROM padres WHERE id_padre = ?");
        $padre->execute([$id]);
        $row = $padre->fetch();

        $stmt = $conn->prepare("DELETE FROM padres WHERE id_padre = ?");
        $stmt->execute([$id]);

        // Eliminar también el usuario de login
        if ($row) {
            $del = $conn->prepare("DELETE FROM usuarios WHERE id_usu = ?");
            $del->execute([$row['id_usu']]);
        }
    }
}

header('Location: /admin/dashboard.php?tab=padres&msg=padre_eliminado');
exit();
