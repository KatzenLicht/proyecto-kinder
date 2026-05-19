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
        // CORREGIDO: Ruta relativa en caso de no ser admin
        if (!$es_admin) { header('Location: ../admin/dashboard.php'); exit(); }

        $nombre    = trim($_POST['nombre_alu']    ?? '');
        $apellidos = trim($_POST['apellidos_alu'] ?? '');
        $id_gpo    = !empty($_POST['id_gpo']) ? intval($_POST['id_gpo']) : null;

        if (!$nombre || !$apellidos) {
            // CORREGIDO: Ruta relativa
            header('Location: ../admin/dashboard.php?tab=alumnos&error=faltan_datos');
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO alumnos (id_gpo, nombre_alu, apellidos_alu) VALUES (?,?,?)");
        $stmt->execute([$id_gpo, $nombre, $apellidos]);

        // CORREGIDO: Ruta relativa
        header('Location: ../admin/dashboard.php?tab=alumnos&msg=alumno_creado');
        exit();

    case 'asignar':
        $id_alu = intval($_POST['id_alu'] ?? 0);
        $id_gpo = !empty($_POST['id_gpo']) ? intval($_POST['id_gpo']) : null;

        if (!$id_alu) {
            // CORREGIDO: Se calcula a dónde regresar si falta el ID
            $fallback = $es_admin ? '../admin/dashboard.php?tab=alumnos' : '../maestra/dashboard.php?tab=alumnos';
            header('Location: ' . $fallback);
            exit();
        }

        // Si es docente, verificar que el grupo le pertenece
        if (!$es_admin) {
            $check = $conn->prepare("SELECT id_gpo FROM grupo WHERE id_gpo = ? AND id_usu = ?");
            $check->execute([$id_gpo, id_sesion()]);
            if (!$check->fetch()) {
                // CORREGIDO: Ruta relativa a la carpeta de la maestra
                header('Location: ../maestra/dashboard.php?tab=alumnos&error=sin_permiso');
                exit();
            }
            // CORREGIDO: Ruta relativa para maestras
            $redirect = '../maestra/dashboard.php?tab=alumnos&msg=alumno_asignado';
        } else {
            // CORREGIDO: Ruta relativa para admins
            $redirect = '../admin/dashboard.php?tab=alumnos&msg=alumno_asignado';
        }

        $stmt = $conn->prepare("UPDATE alumnos SET id_gpo = ? WHERE id_alu = ?");
        $stmt->execute([$id_gpo, $id_alu]);

        header('Location: ' . $redirect);
        exit();

    case 'eliminar':
        // CORREGIDO: Ruta relativa
        if (!$es_admin) { header('Location: ../admin/dashboard.php'); exit(); }

        $id = intval($_GET['id'] ?? 0);
        // CORREGIDO: Ruta relativa
        if (!$id) { header('Location: ../admin/dashboard.php?tab=alumnos'); exit(); }

        $stmt = $conn->prepare("DELETE FROM alumnos WHERE id_alu = ?");
        $stmt->execute([$id]);

        // CORREGIDO: Ruta relativa
        header('Location: ../admin/dashboard.php?tab=alumnos&msg=alumno_eliminado');
        exit();
}

// CORREGIDO: Ruta por defecto calculada según el rol
$default_redirect = $es_admin ? '../admin/dashboard.php?tab=alumnos' : '../maestra/dashboard.php?tab=alumnos';
header('Location: ' . $default_redirect);
exit();