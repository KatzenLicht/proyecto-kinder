<?php
// ============================================================
// maestra/dashboard.php
// Panel de control de la Maestra/Docente
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';

verificar_rol('docente');

$tab   = $_GET['tab'] ?? 'inicio';
$msg   = $_GET['msg']   ?? '';
$error = $_GET['error'] ?? '';

$id_usu = id_sesion();

// ── Nombre real de la maestra ───────────────────────────────
$stmt = $conn->prepare("SELECT maestra_per FROM personal WHERE id_usu = ?");
$stmt->execute([$id_usu]);
$personal = $stmt->fetch();
$nombre_maestra = $personal['maestra_per'] ?? nombre_sesion();

// ── Grupos que maneja esta maestra ──────────────────────────
$stmt = $conn->prepare("
    SELECT g.*, COUNT(a.id_alu) AS total_alumnos
    FROM grupo g
    LEFT JOIN alumnos a ON a.id_gpo = g.id_gpo
    WHERE g.id_usu = ?
    GROUP BY g.id_gpo
    ORDER BY g.grupo_gpo
");
$stmt->execute([$id_usu]);
$mis_grupos = $stmt->fetchAll();

// IDs de los grupos de esta maestra (para filtrar alumnos)
$ids_grupos = array_column($mis_grupos, 'id_gpo');

// ── Alumnos en mis grupos ───────────────────────────────────
$alumnos_en_grupos = [];
if (!empty($ids_grupos)) {
    $placeholders = implode(',', array_fill(0, count($ids_grupos), '?'));
    $stmt = $conn->prepare("
        SELECT a.*, g.grupo_gpo,
               pa.nombre_padre, pa.telefono_padre, pa.correo_padre
        FROM alumnos a
        JOIN grupo g ON a.id_gpo = g.id_gpo
        LEFT JOIN padres pa ON pa.id_alu = a.id_alu
        WHERE a.id_gpo IN ($placeholders)
        ORDER BY g.grupo_gpo, a.apellidos_alu
    ");
    $stmt->execute($ids_grupos);
    $alumnos_en_grupos = $stmt->fetchAll();
}

// ── Alumnos SIN grupo (para que la maestra los asigne) ──────
$alumnos_sin_grupo = $conn->query("
    SELECT a.*, pa.nombre_padre
    FROM alumnos a
    LEFT JOIN padres pa ON pa.id_alu = a.id_alu
    WHERE a.id_gpo IS NULL
    ORDER BY a.apellidos_alu
")->fetchAll();

// ── Select de mis grupos para el dropdown de asignación ─────
$mis_grupos_select = $mis_grupos; // reutilizamos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Maestra — Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2E1G3HZCVV"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-2E1G3HZCVV');
</script>
</head>
<body class="dashboard-page">

<!-- ══════════════════════════════════════════════════════════
     NAVBAR
══════════════════════════════════════════════════════════ -->
<nav class="dash-nav">
    <div class="dash-nav-brand">
        <span class="nav-emoji">🌻</span>
        <span>Jardín UACJ</span>
        <span class="nav-badge badge-docente">Maestra</span>
    </div>

    <div class="dash-nav-tabs">
        <a href="?tab=inicio"   class="nav-tab <?= $tab==='inicio'   ? 'active':'' ?>">🏠 Inicio</a>
        <a href="?tab=grupos"   class="nav-tab <?= $tab==='grupos'   ? 'active':'' ?>">📚 Mis Grupos</a>
        <a href="?tab=alumnos"  class="nav-tab <?= $tab==='alumnos'  ? 'active':'' ?>">🎒 Alumnos</a>
        <a href="?tab=singrupo" class="nav-tab <?= $tab==='singrupo' ? 'active':'' ?>">
            📋 Sin Grupo
            <?php if (count($alumnos_sin_grupo) > 0): ?>
                <span class="badge-count"><?= count($alumnos_sin_grupo) ?></span>
            <?php endif; ?>
        </a>
    </div>

    <div class="dash-nav-user">
        <span>👋 <?= htmlspecialchars($nombre_maestra) ?></span>
        <a href="../logout.php" class="btn-logout">Salir</a>
    </div>
</nav>

<!-- ══════════════════════════════════════════════════════════
     CONTENIDO
══════════════════════════════════════════════════════════ -->
<main class="dash-main">

    <!-- Mensajes -->
    <?php if ($msg): ?>
        <div class="alert alert-success">
            <?php
            $msgs = [
                'alumno_asignado' => '✅ Alumno asignado correctamente a tu grupo.',
            ];
            echo $msgs[$msg] ?? $msg;
            ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <?php
            $errs = [
                'sin_permiso' => '❌ No tienes permiso para asignar a ese grupo.',
            ];
            echo $errs[$error] ?? $error;
            ?>
        </div>
    <?php endif; ?>

    <!-- ════════════════════════════════════
         TAB: INICIO
    ════════════════════════════════════ -->
    <?php if ($tab === 'inicio'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Bienvenida, <?= htmlspecialchars($nombre_maestra) ?> 👩‍🏫</h2>

        <div class="stats-grid">
            <div class="stat-card stat-blue">
                <div class="stat-icon">📚</div>
                <div class="stat-number"><?= count($mis_grupos) ?></div>
                <div class="stat-label">Mis grupos</div>
            </div>
            <div class="stat-card stat-green">
                <div class="stat-icon">🎒</div>
                <div class="stat-number"><?= count($alumnos_en_grupos) ?></div>
                <div class="stat-label">Mis alumnos</div>
            </div>
            <div class="stat-card stat-yellow">
                <div class="stat-icon">📋</div>
                <div class="stat-number"><?= count($alumnos_sin_grupo) ?></div>
                <div class="stat-label">Sin grupo</div>
            </div>
        </div>

        <!-- Resumen de grupos -->
        <?php if (!empty($mis_grupos)): ?>
        <div class="card" style="margin-top:24px">
            <h3 style="margin-bottom:16px">📚 Resumen de mis grupos</h3>
            <div class="grupos-grid">
                <?php foreach ($mis_grupos as $g): ?>
                <div class="grupo-card">
                    <div class="grupo-nombre"><?= htmlspecialchars($g['grupo_gpo']) ?></div>
                    <div class="grupo-alumnos"><?= $g['total_alumnos'] ?> alumno(s)</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
        <div class="card" style="margin-top:24px;text-align:center;padding:40px">
            <p style="font-size:2rem">📭</p>
            <p>Aún no tienes grupos asignados. Contacta al administrador.</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- ════════════════════════════════════
         TAB: MIS GRUPOS
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'grupos'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Mis Grupos</h2>

        <?php if (empty($mis_grupos)): ?>
            <div class="card" style="text-align:center;padding:40px">
                <p>No tienes grupos asignados.</p>
            </div>
        <?php else: ?>
            <?php foreach ($mis_grupos as $g): ?>
            <div class="card" style="margin-bottom:20px">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
                    <h3>📚 <?= htmlspecialchars($g['grupo_gpo']) ?></h3>
                    <span class="badge badge-admin"><?= $g['total_alumnos'] ?> alumno(s)</span>
                </div>

                <?php
                // Alumnos de este grupo específico
                $alumnos_grupo = array_filter($alumnos_en_grupos, fn($a) => $a['id_gpo'] == $g['id_gpo']);
                ?>

                <?php if (empty($alumnos_grupo)): ?>
                    <p class="text-muted">Este grupo no tiene alumnos aún.</p>
                <?php else: ?>
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Padre/Tutor</th>
                            <th>Teléfono</th>
                            <th>Correo padre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos_grupo as $a): ?>
                        <tr>
                            <td><?= htmlspecialchars($a['nombre_alu']) ?></td>
                            <td><?= htmlspecialchars($a['apellidos_alu']) ?></td>
                            <td><?= $a['nombre_padre'] ? htmlspecialchars($a['nombre_padre']) : '<span class="text-muted">—</span>' ?></td>
                            <td><?= $a['telefono_padre'] ? htmlspecialchars($a['telefono_padre']) : '<span class="text-muted">—</span>' ?></td>
                            <td><?= $a['correo_padre'] ? htmlspecialchars($a['correo_padre']) : '<span class="text-muted">—</span>' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- ════════════════════════════════════
         TAB: TODOS MIS ALUMNOS
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'alumnos'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Todos mis alumnos</h2>

        <?php if (empty($alumnos_en_grupos)): ?>
            <div class="card" style="text-align:center;padding:40px">
                <p>No tienes alumnos en tus grupos aún.</p>
            </div>
        <?php else: ?>
        <div class="card">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Grupo</th>
                        <th>Padre/Tutor</th>
                        <th>Teléfono</th>
                        <th>Correo padre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos_en_grupos as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['nombre_alu']) ?></td>
                        <td><?= htmlspecialchars($a['apellidos_alu']) ?></td>
                        <td><span class="badge badge-docente"><?= htmlspecialchars($a['grupo_gpo']) ?></span></td>
                        <td><?= $a['nombre_padre'] ? htmlspecialchars($a['nombre_padre']) : '<span class="text-muted">—</span>' ?></td>
                        <td><?= $a['telefono_padre'] ? htmlspecialchars($a['telefono_padre']) : '<span class="text-muted">—</span>' ?></td>
                        <td><?= $a['correo_padre'] ? htmlspecialchars($a['correo_padre']) : '<span class="text-muted">—</span>' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

    <!-- ════════════════════════════════════
         TAB: ALUMNOS SIN GRUPO
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'singrupo'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Alumnos sin grupo asignado</h2>
        <p style="margin-bottom:20px;color:#666">
            Aquí puedes asignar alumnos pendientes a uno de tus grupos.
        </p>

        <?php if (empty($alumnos_sin_grupo)): ?>
            <div class="card" style="text-align:center;padding:40px">
                <p style="font-size:2rem">✅</p>
                <p>No hay alumnos sin grupo en este momento.</p>
            </div>
        <?php else: ?>
        <div class="card">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Padre/Tutor</th>
                        <th>Asignar a mi grupo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos_sin_grupo as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['nombre_alu']) ?></td>
                        <td><?= htmlspecialchars($a['apellidos_alu']) ?></td>
                        <td><?= $a['nombre_padre'] ? htmlspecialchars($a['nombre_padre']) : '<span class="text-muted">—</span>' ?></td>
                        <td>
                            <?php if (empty($mis_grupos_select)): ?>
                                <span class="text-muted">Sin grupos asignados</span>
                            <?php else: ?>
                            <form action="../api/alumnos.php" method="POST" style="display:flex;gap:6px">
                                <input type="hidden" name="accion" value="asignar">
                                <input type="hidden" name="id_alu" value="<?= $a['id_alu'] ?>">
                                <select name="id_gpo" required>
                                    <option value="">-- Mi grupo --</option>
                                    <?php foreach ($mis_grupos_select as $g): ?>
                                    <option value="<?= $g['id_gpo'] ?>">
                                        <?= htmlspecialchars($g['grupo_gpo']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn-primary btn-sm">Asignar</button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

</main>

</body>
</html>
