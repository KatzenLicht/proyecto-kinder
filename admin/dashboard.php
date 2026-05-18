<?php
// ============================================================
// admin/dashboard.php
// Panel de control del Administrador
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';

verificar_rol('admin');

// ── Pestaña activa ──────────────────────────────────────────
$tab = $_GET['tab'] ?? 'inicio';

// ── Mensajes de retroalimentación ──────────────────────────
$msg   = $_GET['msg']   ?? '';
$error = $_GET['error'] ?? '';

// ── Cargar datos según pestaña ──────────────────────────────

// Usuarios
$usuarios = $conn->query("SELECT * FROM usuarios ORDER BY rol, usuario_usu")->fetchAll();

// Personal
$personal = $conn->query("
    SELECT p.*, u.usuario_usu, u.rol
    FROM personal p
    JOIN usuarios u ON p.id_usu = u.id_usu
    ORDER BY p.maestra_per
")->fetchAll();

// Grupos
$grupos = $conn->query("
    SELECT g.*, u.usuario_usu,
           COUNT(a.id_alu) AS total_alumnos
    FROM grupo g
    JOIN usuarios u ON g.id_usu = u.id_usu
    LEFT JOIN alumnos a ON a.id_gpo = g.id_gpo
    GROUP BY g.id_gpo
    ORDER BY g.grupo_gpo
")->fetchAll();

// Alumnos
$alumnos = $conn->query("
    SELECT a.*, g.grupo_gpo,
           CONCAT(pa.nombre_padre) AS nombre_padre
    FROM alumnos a
    LEFT JOIN grupo g ON a.id_gpo = g.id_gpo
    LEFT JOIN padres pa ON pa.id_alu = a.id_alu
    ORDER BY a.apellidos_alu
")->fetchAll();

// Padres
$padres = $conn->query("
    SELECT pa.*, u.usuario_usu,
           CONCAT(a.nombre_alu,' ',a.apellidos_alu) AS nombre_hijo
    FROM padres pa
    JOIN usuarios u ON pa.id_usu = u.id_usu
    LEFT JOIN alumnos a ON pa.id_alu = a.id_alu
    ORDER BY pa.nombre_padre
")->fetchAll();

// Usuarios docentes disponibles para dropdowns
$docentes = $conn->query("SELECT id_usu, usuario_usu FROM usuarios WHERE rol='docente' ORDER BY usuario_usu")->fetchAll();

// Grupos disponibles para dropdown de alumnos
$grupos_select = $conn->query("SELECT id_gpo, grupo_gpo FROM grupo ORDER BY grupo_gpo")->fetchAll();

// Alumnos sin padre asignado para dropdown de padres
$alumnos_sin_padre = $conn->query("
    SELECT a.id_alu, CONCAT(a.nombre_alu,' ',a.apellidos_alu) AS nombre_completo
    FROM alumnos a
    LEFT JOIN padres p ON p.id_alu = a.id_alu
    WHERE p.id_alu IS NULL
    ORDER BY a.apellidos_alu
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin — Jardín de Niños UACJ</title>
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
        <span class="nav-badge badge-admin">Admin</span>
    </div>

    <div class="dash-nav-tabs">
        <a href="?tab=inicio"    class="nav-tab <?= $tab==='inicio'    ? 'active':'' ?>">🏠 Inicio</a>
        <a href="?tab=usuarios"  class="nav-tab <?= $tab==='usuarios'  ? 'active':'' ?>">👤 Usuarios</a>
        <a href="?tab=personal"  class="nav-tab <?= $tab==='personal'  ? 'active':'' ?>">👩‍🏫 Personal</a>
        <a href="?tab=grupos"    class="nav-tab <?= $tab==='grupos'    ? 'active':'' ?>">📚 Grupos</a>
        <a href="?tab=alumnos"   class="nav-tab <?= $tab==='alumnos'   ? 'active':'' ?>">🎒 Alumnos</a>
        <a href="?tab=padres"    class="nav-tab <?= $tab==='padres'    ? 'active':'' ?>">👨‍👧 Padres</a>
    </div>

    <div class="dash-nav-user">
        <span>👋 <?= htmlspecialchars(nombre_sesion()) ?></span>
        <a href="../logout.php" class="btn-logout">Salir</a>
    </div>
</nav>

<!-- ══════════════════════════════════════════════════════════
     CONTENIDO PRINCIPAL
══════════════════════════════════════════════════════════ -->
<main class="dash-main">

    <!-- Mensajes -->
    <?php if ($msg): ?>
        <div class="alert alert-success">
            <?php
            $msgs = [
                'usuario_creado'   => '✅ Usuario creado correctamente.',
                'usuario_eliminado'=> '✅ Usuario eliminado.',
                'personal_creado'  => '✅ Personal registrado correctamente.',
                'personal_eliminado'=>'✅ Personal eliminado.',
                'grupo_creado'     => '✅ Grupo creado correctamente.',
                'grupo_eliminado'  => '✅ Grupo eliminado.',
                'alumno_creado'    => '✅ Alumno registrado correctamente.',
                'alumno_eliminado' => '✅ Alumno eliminado.',
                'alumno_asignado'  => '✅ Alumno asignado al grupo.',
                'padre_eliminado'  => '✅ Padre eliminado.',
            ];
            echo $msgs[$msg] ?? $msg;
            ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <?php
            $errs = [
                'usuario_existe' => '❌ Ese nombre de usuario ya existe.',
                'faltan_datos'   => '❌ Por favor completa todos los campos.',
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
        <h2 class="tab-title">Panel de Administración</h2>

        <div class="stats-grid">
            <div class="stat-card stat-blue">
                <div class="stat-icon">👤</div>
                <div class="stat-number"><?= count($usuarios) ?></div>
                <div class="stat-label">Usuarios</div>
            </div>
            <div class="stat-card stat-green">
                <div class="stat-icon">👩‍🏫</div>
                <div class="stat-number"><?= count($personal) ?></div>
                <div class="stat-label">Personal</div>
            </div>
            <div class="stat-card stat-yellow">
                <div class="stat-icon">📚</div>
                <div class="stat-number"><?= count($grupos) ?></div>
                <div class="stat-label">Grupos</div>
            </div>
            <div class="stat-card stat-pink">
                <div class="stat-icon">🎒</div>
                <div class="stat-number"><?= count($alumnos) ?></div>
                <div class="stat-label">Alumnos</div>
            </div>
            <div class="stat-card stat-purple">
                <div class="stat-icon">👨‍👧</div>
                <div class="stat-number"><?= count($padres) ?></div>
                <div class="stat-label">Padres</div>
            </div>
        </div>
    </div>

    <!-- ════════════════════════════════════
         TAB: USUARIOS
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'usuarios'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Gestión de Usuarios</h2>

        <!-- Formulario crear usuario -->
        <div class="card form-card">
            <h3>➕ Crear nuevo usuario</h3>
            <form action="../api/usuarios.php" method="POST" class="form-inline">
                <input type="hidden" name="accion" value="crear">
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" name="usuario_usu" placeholder="Ej: maestra3" required>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password_usu" placeholder="Contraseña" required>
                </div>
                <div class="form-group">
                    <label>Rol</label>
                    <select name="rol" required>
                        <option value="docente">Docente</option>
                        <option value="admin">Admin</option>
                        <option value="padre">Padre</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary">Crear</button>
            </form>
        </div>

        <!-- Tabla usuarios -->
        <div class="card">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= $u['id_usu'] ?></td>
                        <td><?= htmlspecialchars($u['usuario_usu']) ?></td>
                        <td><span class="badge badge-<?= $u['rol'] ?>"><?= $u['rol'] ?></span></td>
                        <td>
                            <?php if ($u['usuario_usu'] !== 'admin'): ?>
                            <a href="../api/usuarios.php?accion=eliminar&id=<?= $u['id_usu'] ?>"
                               class="btn-danger btn-sm"
                               onclick="return confirm('¿Eliminar usuario <?= htmlspecialchars($u['usuario_usu']) ?>?')">
                               Eliminar
                            </a>
                            <?php else: ?>
                            <span class="text-muted">Protegido</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ════════════════════════════════════
         TAB: PERSONAL
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'personal'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Gestión de Personal</h2>

        <div class="card form-card">
            <h3>➕ Registrar maestra</h3>
            <form action="../api/personal.php" method="POST" class="form-inline">
                <input type="hidden" name="accion" value="crear">
                <div class="form-group">
                    <label>Usuario asignado</label>
                    <select name="id_usu" required>
                        <option value="">-- Selecciona --</option>
                        <?php foreach ($docentes as $d): ?>
                        <option value="<?= $d['id_usu'] ?>"><?= htmlspecialchars($d['usuario_usu']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nombre completo</label>
                    <input type="text" name="maestra_per" placeholder="Ej: Karla González López" required>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo_per" placeholder="correo@ejemplo.com" required>
                </div>
                <div class="form-group">
                    <label>Celular</label>
                    <input type="tel" name="cel_per" placeholder="6561234567" maxlength="12" required>
                </div>
                <button type="submit" class="btn-primary">Registrar</button>
            </form>
        </div>

        <div class="card">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($personal as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['maestra_per']) ?></td>
                        <td><?= htmlspecialchars($p['usuario_usu']) ?></td>
                        <td><?= htmlspecialchars($p['correo_per']) ?></td>
                        <td><?= htmlspecialchars($p['cel_per']) ?></td>
                        <td>
                            <a href="../api/personal.php?accion=eliminar&id=<?= $p['id_per'] ?>"
                               class="btn-danger btn-sm"
                               onclick="return confirm('¿Eliminar a <?= htmlspecialchars($p['maestra_per']) ?>?')">
                               Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ════════════════════════════════════
         TAB: GRUPOS
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'grupos'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Gestión de Grupos</h2>

        <div class="card form-card">
            <h3>➕ Crear grupo</h3>
            <form action="../api/grupos.php" method="POST" class="form-inline">
                <input type="hidden" name="accion" value="crear">
                <div class="form-group">
                    <label>Maestra responsable</label>
                    <select name="id_usu" required>
                        <option value="">-- Selecciona --</option>
                        <?php foreach ($docentes as $d): ?>
                        <option value="<?= $d['id_usu'] ?>"><?= htmlspecialchars($d['usuario_usu']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nombre del grupo</label>
                    <input type="text" name="grupo_gpo" placeholder="Ej: Grupo A" required>
                </div>
                <button type="submit" class="btn-primary">Crear</button>
            </form>
        </div>

        <div class="card">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Grupo</th>
                        <th>Maestra</th>
                        <th>Alumnos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grupos as $g): ?>
                    <tr>
                        <td><?= htmlspecialchars($g['grupo_gpo']) ?></td>
                        <td><?= htmlspecialchars($g['usuario_usu']) ?></td>
                        <td><span class="badge badge-admin"><?= $g['total_alumnos'] ?></span></td>
                        <td>
                            <a href="../api/grupos.php?accion=eliminar&id=<?= $g['id_gpo'] ?>"
                               class="btn-danger btn-sm"
                               onclick="return confirm('¿Eliminar grupo <?= htmlspecialchars($g['grupo_gpo']) ?>?')">
                               Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ════════════════════════════════════
         TAB: ALUMNOS
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'alumnos'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Gestión de Alumnos</h2>

        <div class="card form-card">
            <h3>➕ Registrar alumno</h3>
            <form action="../api/alumnos.php" method="POST" class="form-inline">
                <input type="hidden" name="accion" value="crear">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre_alu" placeholder="Nombre(s)" required>
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos_alu" placeholder="Apellidos" required>
                </div>
                <div class="form-group">
                    <label>Grupo (opcional)</label>
                    <select name="id_gpo">
                        <option value="">-- Sin grupo --</option>
                        <?php foreach ($grupos_select as $g): ?>
                        <option value="<?= $g['id_gpo'] ?>"><?= htmlspecialchars($g['grupo_gpo']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn-primary">Registrar</button>
            </form>
        </div>

        <div class="card">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Grupo</th>
                        <th>Padre/Tutor</th>
                        <th>Asignar grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['nombre_alu']) ?></td>
                        <td><?= htmlspecialchars($a['apellidos_alu']) ?></td>
                        <td>
                            <?php if ($a['grupo_gpo']): ?>
                                <span class="badge badge-docente"><?= htmlspecialchars($a['grupo_gpo']) ?></span>
                            <?php else: ?>
                                <span class="text-muted">Sin grupo</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $a['nombre_padre'] ? htmlspecialchars($a['nombre_padre']) : '<span class="text-muted">Sin padre</span>' ?></td>
                        <td>
                            <form action="../api/alumnos.php" method="POST" style="display:flex;gap:6px">
                                <input type="hidden" name="accion" value="asignar">
                                <input type="hidden" name="id_alu" value="<?= $a['id_alu'] ?>">
                                <select name="id_gpo">
                                    <option value="">Sin grupo</option>
                                    <?php foreach ($grupos_select as $g): ?>
                                    <option value="<?= $g['id_gpo'] ?>" <?= $a['id_gpo']==$g['id_gpo']?'selected':'' ?>>
                                        <?= htmlspecialchars($g['grupo_gpo']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn-primary btn-sm">Guardar</button>
                            </form>
                        </td>
                        <td>
                            <a href="../api/alumnos.php?accion=eliminar&id=<?= $a['id_alu'] ?>"
                               class="btn-danger btn-sm"
                               onclick="return confirm('¿Eliminar alumno?')">
                               Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ════════════════════════════════════
         TAB: PADRES
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'padres'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Padres y Tutores Registrados</h2>

        <div class="card">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Hijo inscrito</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($padres as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nombre_padre']) ?></td>
                        <td><?= htmlspecialchars($p['usuario_usu']) ?></td>
                        <td><?= htmlspecialchars($p['telefono_padre']) ?></td>
                        <td><?= htmlspecialchars($p['correo_padre']) ?></td>
                        <td>
                            <?php if ($p['nombre_hijo']): ?>
                                <span class="badge badge-docente"><?= htmlspecialchars($p['nombre_hijo']) ?></span>
                            <?php else: ?>
                                <span class="text-muted">Sin hijo inscrito</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="../api/padres.php?accion=eliminar&id=<?= $p['id_padre'] ?>"
                               class="btn-danger btn-sm"
                               onclick="return confirm('¿Eliminar padre/tutor?')">
                               Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

</main>

<link rel="stylesheet" href="../assets/css/styles.css">
</body>
</html>
