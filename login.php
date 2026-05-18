<?php
// ============================================================
// login.php
// Página de inicio de sesión para todos los roles
// ============================================================

if (session_status() === PHP_SESSION_NONE) session_start();

// Si ya está logueado, redirige directo a su dashboard
if (isset($_SESSION['id_usu'])) {
    require_once 'includes/auth.php';
    redirigir_por_rol();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2E1G3HZCVV"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-2E1G3HZCVV');
</script>
</head>
<body class="login-page">

    <!-- Fondo decorativo con burbujas -->
    <div class="bubbles">
        <span></span><span></span><span></span>
        <span></span><span></span><span></span>
    </div>

    <div class="login-wrapper">

        <!-- Logo / título -->
        <div class="login-header">
            <div class="login-logo">🌻</div>
            <h1>Jardín de Niños UACJ</h1>
            <p>Inicia sesión para continuar</p>
        </div>

        <!-- Mensajes de error -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                <?php
                $errores = [
                    'vacio'      => 'Por favor completa todos los campos.',
                    'usuario'    => 'Usuario no encontrado.',
                    'password'   => 'Contraseña incorrecta.',
                    'inactivo'   => 'Esta cuenta no está activa.',
                ];
                echo $errores[$_GET['error']] ?? 'Error al iniciar sesión.';
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'logout'): ?>
            <div class="alert alert-success">
                Sesión cerrada correctamente.
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form action="login_proceso.php" method="POST" class="login-form">

            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input
                    type="text"
                    id="usuario"
                    name="usuario_usu"
                    placeholder="Escribe tu usuario"
                    required
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-password">
                    <input
                        type="password"
                        id="password"
                        name="password_usu"
                        placeholder="Escribe tu contraseña"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="toggle-pass" onclick="togglePassword()">Ver</button>
                </div>
            </div>

            <button type="submit" class="btn-primary btn-block">
                Ingresar
            </button>

            <a href="index.php" class="btn-back">← Regresar al inicio</a>

        </form>

        <!-- Enlace registro padres -->
        <div class="login-footer">
            <p>¿Eres padre o tutor? <a href="registro_padre.php">Regístrate aquí</a></p>
        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>
