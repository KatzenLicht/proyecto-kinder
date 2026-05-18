<?php
// ============================================================
// api/personal.php — Crear y eliminar personal docente
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';
verificar_rol('admin');

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {

    case 'crear':
        $id_usu  = intval($_POST['id_usu']      ?? 0);
        $nombre  = trim($_POST['maestra_per']   ?? '');
        $correo  = trim($_POST['correo_per']    ?? '');
        $celular = trim($_POST['cel_per']       ?? '');

        if (!$id_usu || !$nombre || !$correo || !$celular) {
            header('Location: /admin/dashboard.php?tab=personal&error=faltan_datos');
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO personal (id_usu, maestra_per, correo_per, cel_per) VALUES (?,?,?,?)");
        $stmt->execute([$id_usu, $nombre, $correo, $celular]);

        header('Location: /admin/dashboard.php?tab=personal&msg=personal_creado');
        exit();

    case 'eliminar':
        $id = intval($_GET['id'] ?? 0);
        if (!$id) { header('Location: /admin/dashboard.php?tab=personal'); exit(); }

        $stmt = $conn->prepare("DELETE FROM personal WHERE id_per = ?");
        $stmt->execute([$id]);

        header('Location: /admin/dashboard.php?tab=personal&msg=personal_eliminado');
        exit();
}

header('Location: /admin/dashboard.php?tab=personal');
exit();
