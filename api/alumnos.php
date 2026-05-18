<?php
// ============================================================
// api/alumnos.php — Crear, asignar y eliminar alumnos
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';
verificar_rol(['admin', 'docente']);

$accion   = $_POST['accion'] ?? $_GET['accion'] ?? '';
$es_admin = rol_sesion() === 'admin';

switch ($accion) {

    case 'crear':
        if (!$es_admin) { header('Location: /admin/dashboard.php'); exit(); }

        $nombre    = trim($_POST['nombre_alu']    ?? '');
        $apellidos = trim($_POST['apellidos_alu'] ?? '');
        $id_gpo    = !empty($_POST['id_gpo']) ? intval($_POST['id_gpo']) : null;

        if (!$nombre || !$apellidos) {
            header('Location: /admin/dashboard.php?tab=alumnos&error=faltan_datos');
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO alumnos (id_gpo, nombre_alu, apellidos_alu) VALUES (?,?,?)");
        $stmt->execute([$id_gpo, $nombre, $apellidos]);

        header('Location: /admin/dashboard.php?tab=alumnos&msg=alumno_creado');
        exit();

    case 'asignar':
        $id_alu = intval($_POST['id_alu'] ?? 0);
        $id_gpo = !empty($_POST['id_gpo']) ? intval($_POST['id_gpo']) : null;

        if (!$id_alu) {
            header('Location: /admin/dashboard.php?tab=alumnos');
            exit();
        }

        // Si es docente, verificar que el grupo le pertenece
        if (!$es_admin) {
            $check = $conn->prepare("SELECT id_gpo FROM grupo WHERE id_gpo = ? AND id_usu = ?");
            $check->execute([$id_gpo, id_sesion()]);
            if (!$check->fetch()) {
                header('Location: /maestra/dashboard.php?tab=alumnos&error=sin_permiso');
                exit();
            }
            $redirect = '/maestra/dashboard.php?tab=alumnos&msg=alumno_asignado';
        } else {
            $redirect = '/admin/dashboard.php?tab=alumnos&msg=alumno_asignado';
        }

        $stmt = $conn->prepare("UPDATE alumnos SET id_gpo = ? WHERE id_alu = ?");
        $stmt->execute([$id_gpo, $id_alu]);

        header('Location: ' . $redirect);
        exit();

    case 'eliminar':
        if (!$es_admin) { header('Location: /admin/dashboard.php'); exit(); }

        $id = intval($_GET['id'] ?? 0);
        if (!$id) { header('Location: /admin/dashboard.php?tab=alumnos'); exit(); }

        $stmt = $conn->prepare("DELETE FROM alumnos WHERE id_alu = ?");
        $stmt->execute([$id]);

        header('Location: /admin/dashboard.php?tab=alumnos&msg=alumno_eliminado');
        exit();
}

header('Location: /admin/dashboard.php?tab=alumnos');
exit();
