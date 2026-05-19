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
        // Primero obtener el usuario vinculado antes de borrar al padre
        $padre = $conn->prepare("SELECT id_usu FROM padres WHERE id_padre = ?");
        $padre->execute([$id]);
        $row = $padre->fetch();

        // Eliminar al padre de la tabla padres
        $stmt = $conn->prepare("DELETE FROM padres WHERE id_padre = ?");
        $stmt->execute([$id]);

        // Eliminar también el usuario de login si existía la vinculación
        if ($row && $row['id_usu']) {
            $del = $conn->prepare("DELETE FROM usuarios WHERE id_usu = ?");
            $del->execute([$row['id_usu']]);
        }

        // CORREGIDO: Redirección con mensaje solo si se procesó la eliminación exitosamente
        header('Location: ../admin/dashboard.php?tab=padres&msg=padre_eliminado');
        exit();
    }
}

// CORREGIDO: Redirección limpia (sin mensaje de éxito falso) si se entra aquí por error o faltan parámetros
header('Location: ../admin/dashboard.php?tab=padres');
exit();