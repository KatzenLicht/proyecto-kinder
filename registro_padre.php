<?php
// ============================================================
// registro_padre.php - LIMPIO Y CORREGIDO PARA AWARDSPACE
// ============================================================

if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_SESSION['id_usu'])) {
    require_once 'includes/auth.php';
    redirigir_por_rol();
}

$error = $_GET['error'] ?? '';
$msg   = $_GET['msg']   ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Padre/Tutor — Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>emailjs.init("CF7-iYshUSalK5g6T");</script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2E1G3HZCVV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-2E1G3HZCVV');
    </script>
</head>
<body class="login-page">

    <div class="bubbles">
        <span></span><span></span><span></span>
        <span></span><span></span><span></span>
    </div>

    <div class="login-wrapper" style="max-width:520px">

        <div class="login-header">
            <div class="login-logo">👨‍👧</div>
            <h1>Registro de Padre / Tutor</h1>
            <p>Crea tu cuenta para inscribir a tu hijo</p>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-error">
            <?php
            $errores = [
                'faltan_datos'     => '❌ Por favor completa todos los campos.',
                'usuario_existe'   => '❌ Ese nombre de usuario ya está en uso.',
                'pass_no_coincide' => '❌ Las contraseñas no coinciden.',
                'db_error'         => '❌ Error al guardar. Intenta de nuevo.',
            ];
            echo $errores[$error] ?? '❌ Error al registrarse.';
            ?>
        </div>
        <?php endif; ?>

        <form action="api/registro_padre_proceso.php" method="POST" class="login-form">

            <p style="font-weight:700;margin-bottom:4px;color:#555">👤 Datos de tu cuenta</p>

            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="usuario_usu" placeholder="Ej: papa_juan" required autocomplete="username">
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <div class="input-password">
                    <input type="password" name="password_usu" id="pass1" placeholder="Mínimo 6 caracteres" required>
                    <button type="button" class="toggle-pass" onclick="togglePass('pass1')">Ver</button>
                </div>
            </div>

            <div class="form-group">
                <label>Confirmar contraseña</label>
                <div class="input-password">
                    <input type="password" name="password_confirm" id="pass2" placeholder="Repite tu contraseña" required>
                    <button type="button" class="toggle-pass" onclick="togglePass('pass2')">Ver</button>
                </div>
            </div>

            <hr style="margin:20px 0;border:none;border-top:1px solid #eee">

            <p style="font-weight:700;margin-bottom:4px;color:#555">📋 Tus datos personales</p>

            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" name="nombre_padre" placeholder="Ej: Juan Pérez García" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" name="telefono_padre" placeholder="Ej: 6561234567" maxlength="12" required>
            </div>

            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="correo_padre" placeholder="correo@ejemplo.com" required>
            </div>

            <button type="submit" class="btn-primary btn-block">Crear cuenta</button>
            <a href="login.php" class="btn-back">← Ya tengo cuenta</a>

        </form>
    </div>

    <script>
        function togglePass(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>