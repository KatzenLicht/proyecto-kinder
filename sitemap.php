<?php
// ============================================================
// sitemap.php — Mapa del sitio integrado en la app
// ============================================================
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa del Sitio — Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2E1G3HZCVV"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-2E1G3HZCVV');</script>
</head>
<body style="background:var(--gray-light);min-height:100vh;padding:40px 20px;font-family:'Nunito',sans-serif">

<div style="max-width:900px;margin:0 auto">

    <!-- Header -->
    <div style="text-align:center;margin-bottom:40px">
        <a href="index.php" style="font-size:2rem;text-decoration:none">🌻</a>
        <h1 style="font-size:2rem;font-weight:800;color:#3D3D3D;margin:8px 0 4px">Mapa del Sitio</h1>
        <p style="color:#6B7A8D">Jardín de Niños UACJ — Todas las páginas del sistema</p>
    </div>

    <!-- Página pública -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:20px">
        <h2 style="font-size:1.1rem;font-weight:800;color:#3D3D3D;margin-bottom:16px;display:flex;align-items:center;gap:8px">
            🌐 Página Pública
        </h2>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:10px">
            <li><a href="index.php#inicio"    style="color:#3AAEE0;font-weight:600;text-decoration:none">🏠 Inicio — Hero principal</a></li>
            <li><a href="index.php#nosotros"  style="color:#3AAEE0;font-weight:600;text-decoration:none">💛 Quiénes somos</a></li>
            <li><a href="index.php#servicios" style="color:#3AAEE0;font-weight:600;text-decoration:none">✨ Servicios del kínder</a></li>
            <li><a href="index.php#galeria"   style="color:#3AAEE0;font-weight:600;text-decoration:none">📸 Galería / Carrusel</a></li>
            <li><a href="index.php#ubicacion" style="color:#3AAEE0;font-weight:600;text-decoration:none">📍 Ubicación y mapa</a></li>
            <li><a href="index.php#contacto"  style="color:#3AAEE0;font-weight:600;text-decoration:none">✉️ Contacto y tarjeta de identidad</a></li>
        </ul>
    </div>

    <!-- Acceso -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:20px">
        <h2 style="font-size:1.1rem;font-weight:800;color:#3D3D3D;margin-bottom:16px">🔐 Acceso al Sistema</h2>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:10px">
            <li><a href="login.php"          style="color:#3AAEE0;font-weight:600;text-decoration:none">🔑 Iniciar sesión</a></li>
            <li><a href="registro_padre.php"  style="color:#3AAEE0;font-weight:600;text-decoration:none">👨‍👧 Registro de padre/tutor</a></li>
            <li><a href="logout.php"          style="color:#3AAEE0;font-weight:600;text-decoration:none">🚪 Cerrar sesión</a></li>
        </ul>
    </div>

    <!-- Admin -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:20px">
        <h2 style="font-size:1.1rem;font-weight:800;color:#3D3D3D;margin-bottom:16px">👤 Panel Administrador</h2>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:10px">
            <li><a href="admin/dashboard.php?tab=inicio"   style="color:#3AAEE0;font-weight:600;text-decoration:none">🏠 Dashboard — Inicio</a></li>
            <li><a href="admin/dashboard.php?tab=usuarios"  style="color:#3AAEE0;font-weight:600;text-decoration:none">👤 Gestión de usuarios</a></li>
            <li><a href="admin/dashboard.php?tab=personal"  style="color:#3AAEE0;font-weight:600;text-decoration:none">👩‍🏫 Gestión de personal</a></li>
            <li><a href="admin/dashboard.php?tab=grupos"    style="color:#3AAEE0;font-weight:600;text-decoration:none">📚 Gestión de grupos</a></li>
            <li><a href="admin/dashboard.php?tab=alumnos"   style="color:#3AAEE0;font-weight:600;text-decoration:none">🎒 Gestión de alumnos</a></li>
            <li><a href="admin/dashboard.php?tab=padres"    style="color:#3AAEE0;font-weight:600;text-decoration:none">👨‍👧 Gestión de padres</a></li>
        </ul>
    </div>

    <!-- Maestra -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:20px">
        <h2 style="font-size:1.1rem;font-weight:800;color:#3D3D3D;margin-bottom:16px">👩‍🏫 Panel Maestra</h2>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:10px">
            <li><a href="maestra/dashboard.php?tab=inicio"   style="color:#3AAEE0;font-weight:600;text-decoration:none">🏠 Dashboard — Inicio</a></li>
            <li><a href="maestra/dashboard.php?tab=grupos"   style="color:#3AAEE0;font-weight:600;text-decoration:none">📚 Mis grupos</a></li>
            <li><a href="maestra/dashboard.php?tab=alumnos"  style="color:#3AAEE0;font-weight:600;text-decoration:none">🎒 Mis alumnos</a></li>
            <li><a href="maestra/dashboard.php?tab=singrupo" style="color:#3AAEE0;font-weight:600;text-decoration:none">📋 Alumnos sin grupo</a></li>
        </ul>
    </div>

    <!-- Padre -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:20px">
        <h2 style="font-size:1.1rem;font-weight:800;color:#3D3D3D;margin-bottom:16px">👨‍👧 Panel Padre/Tutor</h2>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:10px">
            <li><a href="padre/dashboard.php?tab=inicio"   style="color:#3AAEE0;font-weight:600;text-decoration:none">🏠 Dashboard — Inicio</a></li>
            <li><a href="padre/dashboard.php?tab=hijo"     style="color:#3AAEE0;font-weight:600;text-decoration:none">👦 Información de mi hijo</a></li>
            <li><a href="padre/dashboard.php?tab=contacto" style="color:#3AAEE0;font-weight:600;text-decoration:none">✉️ Contactar maestra</a></li>
        </ul>
    </div>

    <!-- Otros -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:32px">
        <h2 style="font-size:1.1rem;font-weight:800;color:#3D3D3D;margin-bottom:16px">📄 Páginas del proyecto</h2>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:10px">
            <li><a href="identidad.php" style="color:#3AAEE0;font-weight:600;text-decoration:none">🎨 Página de identidad</a></li>
            <li><a href="api/alumnos.php" style="color:#3AAEE0;font-weight:600;text-decoration:none">🔌 API JSON — Alumnos</a></li>
            <li><a href="https://github.com/KatzenLicht/proyecto-kinder" target="_blank" style="color:#3AAEE0;font-weight:600;text-decoration:none">🐙 Repositorio GitHub</a></li>
        </ul>
    </div>

    <div style="text-align:center">
        <a href="index.php" style="background:#6BC5F8;color:white;padding:12px 28px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-block">
            ← Volver al inicio
        </a>
    </div>

</div>

</body>
</html>
