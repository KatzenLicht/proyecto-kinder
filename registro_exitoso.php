<?php
// ============================================================
// registro_exitoso.php
// Muestra confirmación y dispara EmailJS para notificar
// ============================================================

if (session_status() === PHP_SESSION_NONE) session_start();

// Si no viene de un registro, redirigir
if (!isset($_SESSION['nuevo_padre'])) {
    header('Location: /kinderProyectoFinal/login.php');
    exit();
}

$padre   = $_SESSION['nuevo_padre'];
$nombre  = $padre['nombre'];
$correo  = $padre['correo'];
$usuario = $padre['usuario'];

// Limpiar sesión temporal
unset($_SESSION['nuevo_padre']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro exitoso — Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- EmailJS -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>emailjs.init("CF7-iYshUSalK5g6T");</script>
</head>
<body class="login-page">

    <div class="bubbles">
        <span></span><span></span><span></span>
        <span></span><span></span><span></span>
    </div>

    <div class="login-wrapper" style="text-align:center">

        <div class="login-logo" style="font-size:4rem">✅</div>
        <h1 style="margin:16px 0 8px">¡Registro exitoso!</h1>
        <p style="color:#666;margin-bottom:24px">
            Bienvenido, <strong><?= htmlspecialchars($nombre) ?></strong>.<br>
            Tu cuenta ha sido creada. Ya puedes iniciar sesión e inscribir a tu hijo.
        </p>

        <div id="email-status" style="margin-bottom:20px"></div>

        <a href="login.php" class="btn-primary" style="display:inline-block">
            Ir al inicio de sesión
        </a>

    </div>

    <script>
        // Disparar notificación por EmailJS al cargar la página
        (function() {
            emailjs.send("service_63vbgb6", "template_9ziqeze", {
                from_name:  "Sistema Jardín UACJ",
                from_email: "<?= htmlspecialchars($correo) ?>",
                to_name:    "Administrador",
                subject:    "Nuevo padre registrado: <?= htmlspecialchars($nombre) ?>",
                message:    "Se ha registrado un nuevo padre/tutor en el sistema.\n\nNombre: <?= htmlspecialchars($nombre) ?>\nUsuario: <?= htmlspecialchars($usuario) ?>\nCorreo: <?= htmlspecialchars($correo) ?>",
                reply_to:   "<?= htmlspecialchars($correo) ?>"
            }).then(function() {
                document.getElementById('email-status').innerHTML =
                    '<div class="alert alert-success">📧 Notificación enviada al administrador.</div>';
            }).catch(function(err) {
                console.warn('EmailJS:', err);
            });
        })();
    </script>

</body>
</html>
