<?php
// ============================================================
// padre/dashboard.php
// Panel del Padre / Tutor
// ============================================================
require_once '../includes/db.php';
require_once '../includes/auth.php';

verificar_rol('padre');

$tab   = $_GET['tab'] ?? 'inicio';
$msg   = $_GET['msg'] ?? '';
$error = $_GET['error'] ?? '';

$id_usu = id_sesion();

// ── Datos del padre ─────────────────────────────────────────
$stmt = $conn->prepare("SELECT * FROM padres WHERE id_usu = ?");
$stmt->execute([$id_usu]);
$padre = $stmt->fetch();

// ── Datos del hijo ──────────────────────────────────────────
$hijo  = null;
$grupo = null;
$maestra = null;

if ($padre && $padre['id_alu']) {
    // Datos del alumno
    $stmt = $conn->prepare("SELECT * FROM alumnos WHERE id_alu = ?");
    $stmt->execute([$padre['id_alu']]);
    $hijo = $stmt->fetch();

    if ($hijo && $hijo['id_gpo']) {
        // Datos del grupo
        $stmt = $conn->prepare("SELECT g.*, u.id_usu as usu_id FROM grupo g JOIN usuarios u ON g.id_usu = u.id_usu WHERE g.id_gpo = ?");
        $stmt->execute([$hijo['id_gpo']]);
        $grupo = $stmt->fetch();

        // Datos de la maestra
        if ($grupo) {
            $stmt = $conn->prepare("SELECT * FROM personal WHERE id_usu = ?");
            $stmt->execute([$grupo['usu_id']]);
            $maestra = $stmt->fetch();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Padre — Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- EmailJS -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>emailjs.init("CF7-iYshUSalK5g6T");</script>
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
        <span class="nav-badge badge-padre">Padre/Tutor</span>
    </div>

    <div class="dash-nav-tabs">
        <a href="?tab=inicio"   class="nav-tab <?= $tab==='inicio'  ? 'active':'' ?>">🏠 Inicio</a>
        <a href="?tab=hijo"     class="nav-tab <?= $tab==='hijo'    ? 'active':'' ?>">👦 Mi Hijo</a>
        <a href="?tab=contacto" class="nav-tab <?= $tab==='contacto'? 'active':'' ?>">✉️ Contactar</a>
    </div>

    <div class="dash-nav-user">
        <span>👋 <?= htmlspecialchars($padre['nombre_padre'] ?? nombre_sesion()) ?></span>
        <a href="../logout.php" class="btn-logout">Salir</a>
    </div>
</nav>

<!-- ══════════════════════════════════════════════════════════
     CONTENIDO
══════════════════════════════════════════════════════════ -->
<main class="dash-main">

    <?php if ($msg === 'correo_enviado'): ?>
        <div class="alert alert-success">✅ Correo enviado correctamente.</div>
    <?php endif; ?>
    <?php if ($error === 'correo_error'): ?>
        <div class="alert alert-error">❌ No se pudo enviar el correo. Intenta de nuevo.</div>
    <?php endif; ?>

    <!-- ════════════════════════════════════
         TAB: INICIO
    ════════════════════════════════════ -->
    <?php if ($tab === 'inicio'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Bienvenido, <?= htmlspecialchars($padre['nombre_padre'] ?? '') ?> 👨‍👧</h2>

        <?php if (!$hijo): ?>
        <!-- Sin hijo inscrito -->
        <div class="card" style="text-align:center;padding:48px">
            <p style="font-size:3rem">👶</p>
            <h3>Aún no has inscrito a tu hijo</h3>
            <p style="margin:12px 0 24px;color:#666">
                Completa la inscripción para ver su información escolar.
            </p>
            <a href="?tab=hijo" class="btn-primary">Inscribir a mi hijo</a>
        </div>

        <?php else: ?>
        <!-- Resumen del hijo -->
        <div class="stats-grid">
            <div class="stat-card stat-blue">
                <div class="stat-icon">👦</div>
                <div class="stat-label" style="font-size:1rem;font-weight:700">
                    <?= htmlspecialchars($hijo['nombre_alu'].' '.$hijo['apellidos_alu']) ?>
                </div>
                <div class="stat-label">Mi hijo</div>
            </div>

            <div class="stat-card stat-green">
                <div class="stat-icon">📚</div>
                <div class="stat-number" style="font-size:1.2rem">
                    <?= $grupo ? htmlspecialchars($grupo['grupo_gpo']) : 'Sin grupo' ?>
                </div>
                <div class="stat-label">Grupo</div>
            </div>

            <div class="stat-card stat-yellow">
                <div class="stat-icon">👩‍🏫</div>
                <div class="stat-number" style="font-size:1rem">
                    <?= $maestra ? htmlspecialchars($maestra['maestra_per']) : 'Sin asignar' ?>
                </div>
                <div class="stat-label">Maestra</div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- ════════════════════════════════════
         TAB: MI HIJO
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'hijo'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Información de mi hijo</h2>

        <?php if (!$hijo): ?>
        <!-- Formulario de inscripción -->
        <div class="card form-card">
            <h3>📝 Inscribir a mi hijo</h3>
            <p style="margin-bottom:20px;color:#666">
                Ingresa los datos de tu hijo para inscribirlo al jardín.
            </p>
            <form action="../api/inscribir_hijo.php" method="POST" class="form-inline">
                <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" name="nombre_alu" placeholder="Nombre del niño" required>
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos_alu" placeholder="Apellidos del niño" required>
                </div>
                <button type="submit" class="btn-primary">Inscribir</button>
            </form>
        </div>

        <?php else: ?>
        <!-- Ficha del hijo -->
        <div class="card">
            <div class="ficha-alumno">
                <div class="ficha-avatar">👦</div>
                <div class="ficha-datos">
                    <h3><?= htmlspecialchars($hijo['nombre_alu'].' '.$hijo['apellidos_alu']) ?></h3>
                    <div class="ficha-grid">

                        <div class="ficha-item">
                            <span class="ficha-label">Grupo</span>
                            <span class="ficha-value">
                                <?php if ($grupo): ?>
                                    <span class="badge badge-docente"><?= htmlspecialchars($grupo['grupo_gpo']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">Pendiente de asignación</span>
                                <?php endif; ?>
                            </span>
                        </div>

                        <div class="ficha-item">
                            <span class="ficha-label">Maestra</span>
                            <span class="ficha-value">
                                <?= $maestra ? htmlspecialchars($maestra['maestra_per']) : '<span class="text-muted">Sin asignar</span>' ?>
                            </span>
                        </div>

                        <?php if ($maestra): ?>
                        <div class="ficha-item">
                            <span class="ficha-label">Correo maestra</span>
                            <span class="ficha-value"><?= htmlspecialchars($maestra['correo_per']) ?></span>
                        </div>
                        <div class="ficha-item">
                            <span class="ficha-label">Teléfono maestra</span>
                            <span class="ficha-value"><?= htmlspecialchars($maestra['cel_per']) ?></span>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <?php if (!$grupo): ?>
        <div class="alert alert-info" style="margin-top:16px">
            ℹ️ Tu hijo está inscrito pero aún no tiene grupo asignado. La maestra lo asignará pronto.
        </div>
        <?php endif; ?>

        <?php endif; ?>
    </div>

    <!-- ════════════════════════════════════
         TAB: CONTACTAR MAESTRA
    ════════════════════════════════════ -->
    <?php elseif ($tab === 'contacto'): ?>
    <div class="tab-content">
        <h2 class="tab-title">Contactar a la maestra</h2>

        <?php if (!$maestra): ?>
        <div class="card" style="text-align:center;padding:40px">
            <p style="font-size:2rem">📭</p>
            <p>Tu hijo aún no tiene maestra asignada.</p>
            <p style="color:#666;margin-top:8px">Cuando tenga grupo y maestra, podrás enviarle mensajes aquí.</p>
        </div>
        <?php else: ?>

        <div class="card form-card">
            <h3>✉️ Enviar mensaje a <?= htmlspecialchars($maestra['maestra_per']) ?></h3>
            <p style="margin-bottom:20px;color:#666">
                Tu mensaje llegará al correo del jardín y será atendido a la brevedad.
            </p>

            <div class="form-group">
                <label>Tu nombre</label>
                <input type="text" id="msg_nombre" value="<?= htmlspecialchars($padre['nombre_padre']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Tu correo</label>
                <input type="email" id="msg_correo" value="<?= htmlspecialchars($padre['correo_padre']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Maestra destinataria</label>
                <input type="text" id="msg_maestra" value="<?= htmlspecialchars($maestra['maestra_per']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Asunto</label>
                <input type="text" id="msg_asunto" placeholder="Ej: Consulta sobre mi hijo" required>
            </div>
            <div class="form-group">
                <label>Mensaje</label>
                <textarea id="msg_cuerpo" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>

            <button class="btn-primary" onclick="enviarCorreo()" id="btn-enviar">
                📨 Enviar mensaje
            </button>

            <div id="msg-status" style="margin-top:16px;display:none"></div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

</main>

<script>
function enviarCorreo() {
    const nombre  = document.getElementById('msg_nombre').value;
    const correo  = document.getElementById('msg_correo').value;
    const maestra = document.getElementById('msg_maestra').value;
    const asunto  = document.getElementById('msg_asunto').value.trim();
    const cuerpo  = document.getElementById('msg_cuerpo').value.trim();
    const status  = document.getElementById('msg-status');
    const btn     = document.getElementById('btn-enviar');

    if (!asunto || !cuerpo) {
        status.style.display = 'block';
        status.className = 'alert alert-error';
        status.textContent = '❌ Por favor completa el asunto y el mensaje.';
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Enviando...';

    emailjs.send("service_63vbgb6", "template_9ziqeze", {
        from_name:    nombre,
        from_email:   correo,
        to_name:      maestra,
        subject:      asunto,
        message:      cuerpo,
        reply_to:     correo
    }).then(() => {
        status.style.display = 'block';
        status.className = 'alert alert-success';
        status.textContent = '✅ Mensaje enviado correctamente.';
        btn.textContent = '📨 Enviar mensaje';
        btn.disabled = false;
        document.getElementById('msg_asunto').value = '';
        document.getElementById('msg_cuerpo').value = '';
    }).catch((err) => {
        status.style.display = 'block';
        status.className = 'alert alert-error';
        status.textContent = '❌ Error al enviar. Intenta de nuevo.';
        btn.textContent = '📨 Enviar mensaje';
        btn.disabled = false;
        console.error('EmailJS error:', err);
    });
}
</script>

</body>
</html>
