<?php
// ============================================================
// api/inscribir_hijo.php
// Inscribe al hijo del padre: crea alumno y lo vincula
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';

verificar_rol('padre');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /padre/dashboard.php');
    exit();
}

$nombre    = trim($_POST['nombre_alu']    ?? '');
$apellidos = trim($_POST['apellidos_alu'] ?? '');
$id_usu    = id_sesion();

if (!$nombre || !$apellidos) {
    header('Location: /padre/dashboard.php?tab=hijo&error=faltan_datos');
    exit();
}

try {
    // 1. Crear el alumno sin grupo
    $stmt = $conn->prepare("INSERT INTO alumnos (id_gpo, nombre_alu, apellidos_alu) VALUES (NULL, ?, ?)");
    $stmt->execute([$nombre, $apellidos]);
    $id_alu = $conn->lastInsertId();

    // 2. Vincular al padre con el alumno
    $stmt = $conn->prepare("UPDATE padres SET id_alu = ? WHERE id_usu = ?");
    $stmt->execute([$id_alu, $id_usu]);

    // 3. Actualizar sesión
    $_SESSION['id_alu'] = $id_alu;

    header('Location: /padre/dashboard.php?tab=hijo&msg=inscrito');
    exit();

} catch (PDOException $e) {
    header('Location: /padre/dashboard.php?tab=hijo&error=db_error');
    exit();
}
