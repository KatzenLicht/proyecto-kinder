<?php
// ============================================================
// api/datos.php — API JSON propia del sistema
// Devuelve datos públicos del kínder en formato JSON
// URL de gestión: /api/datos.php o /api/datos.php?tipo=alumnos
// ============================================================

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once '../includes/db.php';

$tipo = $_GET['tipo'] ?? 'general';

try {
    switch ($tipo) {

        case 'alumnos':
            $stmt = $conn->query("
                SELECT a.id_alu, a.nombre_alu, a.apellidos_alu,
                       COALESCE(g.grupo_gpo, 'Sin grupo') AS grupo
                FROM alumnos a
                LEFT JOIN grupo g ON a.id_gpo = g.id_gpo
                ORDER BY a.apellidos_alu
            ");
            echo json_encode([
                'status' => 'ok',
                'tipo'   => 'alumnos',
                'total'  => $stmt->rowCount(),
                'data'   => $stmt->fetchAll()
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            break;

        case 'grupos':
            $stmt = $conn->query("
                SELECT g.id_gpo, g.grupo_gpo,
                       p.maestra_per AS maestra,
                       COUNT(a.id_alu) AS total_alumnos
                FROM grupo g
                LEFT JOIN personal p ON p.id_usu = g.id_usu
                LEFT JOIN alumnos a  ON a.id_gpo = g.id_gpo
                GROUP BY g.id_gpo
                ORDER BY g.grupo_gpo
            ");
            echo json_encode([
                'status' => 'ok',
                'tipo'   => 'grupos',
                'total'  => $stmt->rowCount(),
                'data'   => $stmt->fetchAll()
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            break;

        case 'personal':
            $stmt = $conn->query("
                SELECT p.id_per, p.maestra_per, p.correo_per,
                       u.usuario_usu
                FROM personal p
                JOIN usuarios u ON p.id_usu = u.id_usu
                ORDER BY p.maestra_per
            ");
            echo json_encode([
                'status' => 'ok',
                'tipo'   => 'personal',
                'total'  => $stmt->rowCount(),
                'data'   => $stmt->fetchAll()
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            break;

        default: // general
            $alumnos  = $conn->query("SELECT COUNT(*) FROM alumnos")->fetchColumn();
            $grupos   = $conn->query("SELECT COUNT(*) FROM grupo")->fetchColumn();
            $personal = $conn->query("SELECT COUNT(*) FROM personal")->fetchColumn();
            $padres   = $conn->query("SELECT COUNT(*) FROM padres")->fetchColumn();
            $sin_grupo = $conn->query("SELECT COUNT(*) FROM alumnos WHERE id_gpo IS NULL")->fetchColumn();

            echo json_encode([
                'status'  => 'ok',
                'tipo'    => 'general',
                'sistema' => 'Jardín de Niños UACJ',
                'version' => '1.0',
                'data'    => [
                    'total_alumnos'      => (int)$alumnos,
                    'total_grupos'       => (int)$grupos,
                    'total_personal'     => (int)$personal,
                    'total_padres'       => (int)$padres,
                    'alumnos_sin_grupo'  => (int)$sin_grupo,
                ],
                'endpoints' => [
                    'general'  => '/api/datos.php',
                    'alumnos'  => '/api/datos.php?tipo=alumnos',
                    'grupos'   => '/api/datos.php?tipo=grupos',
                    'personal' => '/api/datos.php?tipo=personal',
                ]
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            break;
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error al consultar datos']);
}
