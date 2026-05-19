<?php
// ============================================================
// identidad.php — Página de identidad visual del proyecto
// ============================================================
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identidad Visual — Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2E1G3HZCVV"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-2E1G3HZCVV');</script>
</head>
<body style="background:var(--gray-light);font-family:'Nunito',sans-serif;color:#3D3D3D">

<!-- Navbar simple -->
<nav style="background:white;padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 12px rgba(0,0,0,0.07);position:sticky;top:0;z-index:100">
    <div style="display:flex;align-items:center;gap:10px;font-size:1.1rem;font-weight:800">
        <span style="font-size:1.5rem">🌻</span>
        Jardín de Niños UACJ
    </div>
    <a href="index.php" style="background:#6BC5F8;color:white;padding:8px 20px;border-radius:50px;font-weight:700;text-decoration:none;font-size:0.9rem">
        ← Volver al inicio
    </a>
</nav>

<div style="max-width:1000px;margin:0 auto;padding:48px 24px">

    <!-- ══ Encabezado ══════════════════════════════════════════ -->
    <div style="text-align:center;margin-bottom:48px">
        <span style="background:#FFE082;color:#7A4F00;padding:6px 18px;border-radius:50px;font-size:0.85rem;font-weight:700">
            Identidad Visual
        </span>
        <h1 style="font-size:2.2rem;font-weight:900;margin:16px 0 8px">
            Jardín de Niños UACJ
        </h1>
        <p style="color:#6B7A8D;font-size:1rem">
            Guía de identidad visual del proyecto — Diseño Digital de Medios Interactivos · UACJ 2025
        </p>
    </div>

    <!-- ══ Ficha del desarrollador ═════════════════════════════ -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:28px;display:flex;gap:28px;align-items:center;flex-wrap:wrap">
        <div style="background:linear-gradient(135deg,#6BC5F8,#7EDDA0);width:90px;height:90px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:3rem;flex-shrink:0">
            <img src="assets/img/yo.jpg" alt="" style="border-radius: 50%;">
        </div>
        <div style="flex:1;min-width:200px">
            <h2 style="font-size:1.4rem;font-weight:800;margin-bottom:4px">Julian Lagunes</h2>
            <p style="color:#6B7A8D;margin-bottom:4px;font-size:0.95rem">Diseño Digital de Medios Interactivos</p>
            <p style="color:#6B7A8D;font-size:0.9rem">Universidad Autónoma de Ciudad Juárez · 2025</p>
            <div style="display:flex;gap:8px;margin-top:12px;flex-wrap:wrap">
                <span style="background:#EBF7FF;color:#1A6A9A;padding:4px 14px;border-radius:50px;font-size:0.8rem;font-weight:700">Desarrollador Web</span>
                <span style="background:#EDFFF4;color:#1A7A42;padding:4px 14px;border-radius:50px;font-size:0.8rem;font-weight:700">PHP · MySQL · JS</span>
                <span style="background:#FFF0F8;color:#7A0050;padding:4px 14px;border-radius:50px;font-size:0.8rem;font-weight:700">Diseño UI/UX</span>
            </div>
        </div>

        <!-- QR en la ficha -->
        <div style="display:flex;gap:20px;flex-wrap:wrap;justify-content:center">
            <div style="text-align:center">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=https://github.com/KatzenLicht/proyecto-kinder"
                     alt="QR GitHub"
                     style="border:2px solid #E8ECF0;border-radius:8px;padding:4px;background:white;width:120px;height:120px">
                <p style="font-size:0.78rem;font-weight:700;color:#6B7A8D;margin-top:6px">GitHub</p>
            </div>
            <div style="text-align:center">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=http://proyecto-kinder.atwebpages.com"
                     alt="QR AwardSpace"
                     style="border:2px solid #E8ECF0;border-radius:8px;padding:4px;background:white;width:120px;height:120px">
                <p style="font-size:0.78rem;font-weight:700;color:#6B7A8D;margin-top:6px">Sitio Web</p>
            </div>
        </div>
    </div>

    <!-- ══ Paleta de colores ════════════════════════════════════ -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:28px">
        <h2 style="font-size:1.2rem;font-weight:800;margin-bottom:6px">Paleta de colores</h2>
        <p style="color:#6B7A8D;font-size:0.9rem;margin-bottom:24px">Colores suaves y modernos que transmiten alegría, confianza y seguridad infantil.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:16px">

            <?php
            $colores = [
                ['#6BC5F8', 'Azul Cielo',    'Primario — navbar, botones principales', 'white'],
                ['#3AAEE0', 'Azul Oscuro',   'Hover y estados activos',                'white'],
                ['#7EDDA0', 'Verde Menta',   'Secundario — acentos positivos',         'white'],
                ['#4FC47A', 'Verde Oscuro',  'Hover elementos verdes',                 'white'],
                ['#FFE082', 'Amarillo Suave','Highlights, badges, alertas',            '#555'],
                ['#FFB3C6', 'Rosa Pálido',   'Detalles decorativos',                   '#555'],
                ['#C9B8F0', 'Lavanda',       'Badges de padre/tutor',                  'white'],
                ['#FAFAFA', 'Blanco Hueso',  'Fondo general',                          '#3D3D3D'],
                ['#F0F4F8', 'Gris Claro',    'Fondo de secciones alternas',            '#3D3D3D'],
                ['#3D3D3D', 'Gris Carbón',   'Texto principal',                        'white'],
                ['#6B7A8D', 'Gris Medio',    'Texto secundario y descripciones',       'white'],
                ['#FF6B7A', 'Rojo Suave',    'Alertas de error y botones eliminar',    'white'],
            ];
            foreach ($colores as $c):
            ?>
            <div style="border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08)">
                <div style="background:<?= $c[0] ?>;height:80px;display:flex;align-items:center;justify-content:center">
                    <span style="color:<?= $c[3] ?>;font-size:0.85rem;font-weight:800"><?= $c[0] ?></span>
                </div>
                <div style="padding:10px 12px;background:white">
                    <p style="font-weight:800;font-size:0.88rem;margin-bottom:2px"><?= $c[1] ?></p>
                    <p style="font-size:0.75rem;color:#6B7A8D;line-height:1.3"><?= $c[2] ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- ══ Tipografía ══════════════════════════════════════════ -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:28px">
        <h2 style="font-size:1.2rem;font-weight:800;margin-bottom:6px">Tipografía</h2>
        <p style="color:#6B7A8D;font-size:0.9rem;margin-bottom:24px">Fuente principal: <strong>Nunito</strong> — Google Fonts. Letras redondeadas, moderna y amigable para educación infantil.</p>

        <div style="display:flex;flex-direction:column;gap:20px">
            <div style="display:flex;align-items:baseline;gap:20px;flex-wrap:wrap;padding:16px;background:#F8FAFC;border-radius:10px">
                <span style="font-size:2.8rem;font-weight:900;color:#3D3D3D">Aa</span>
                <div>
                    <p style="font-weight:800;margin-bottom:2px">Nunito Black 900</p>
                    <p style="color:#6B7A8D;font-size:0.85rem">Títulos principales y héroe</p>
                </div>
            </div>
            <div style="display:flex;align-items:baseline;gap:20px;flex-wrap:wrap;padding:16px;background:#F8FAFC;border-radius:10px">
                <span style="font-size:2rem;font-weight:700;color:#3D3D3D">Aa</span>
                <div>
                    <p style="font-weight:700;margin-bottom:2px">Nunito Bold 700</p>
                    <p style="color:#6B7A8D;font-size:0.85rem">Subtítulos y encabezados de sección</p>
                </div>
            </div>
            <div style="display:flex;align-items:baseline;gap:20px;flex-wrap:wrap;padding:16px;background:#F8FAFC;border-radius:10px">
                <span style="font-size:1.2rem;font-weight:600;color:#3D3D3D">Aa</span>
                <div>
                    <p style="font-weight:600;margin-bottom:2px">Nunito SemiBold 600</p>
                    <p style="color:#6B7A8D;font-size:0.85rem">Labels, botones y texto de navegación</p>
                </div>
            </div>
            <div style="display:flex;align-items:baseline;gap:20px;flex-wrap:wrap;padding:16px;background:#F8FAFC;border-radius:10px">
                <span style="font-size:1rem;font-weight:400;color:#3D3D3D">Aa</span>
                <div>
                    <p style="font-weight:400;margin-bottom:2px">Nunito Regular 400</p>
                    <p style="color:#6B7A8D;font-size:0.85rem">Texto de párrafos y descripciones</p>
                </div>
            </div>
        </div>

        <!-- Muestra del abecedario -->
        <div style="margin-top:24px;padding:20px;background:#F8FAFC;border-radius:10px">
            <p style="font-size:1.3rem;font-weight:700;color:#3D3D3D;letter-spacing:2px;margin-bottom:8px">
                A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
            </p>
            <p style="font-size:1.1rem;color:#6B7A8D;letter-spacing:1px">
                a b c d e f g h i j k l m n o p q r s t u v w x y z
            </p>
            <p style="font-size:1.1rem;color:#6B7A8D;margin-top:4px">
                0 1 2 3 4 5 6 7 8 9 ! @ # $ % & * ( )
            </p>
        </div>
    </div>

    <!-- ══ Logo / Isotipo ══════════════════════════════════════ -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:28px">
        <h2 style="font-size:1.2rem;font-weight:800;margin-bottom:6px">Logo e Isotipo</h2>
        <p style="color:#6B7A8D;font-size:0.9rem;margin-bottom:24px">El girasol representa crecimiento, alegría y energía — valores del kínder.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:20px">
            <!-- Fondo blanco -->
            <div style="border:2px solid #E8ECF0;border-radius:10px;padding:28px;text-align:center">
                <div style="font-size:4rem;margin-bottom:12px">🌻</div>
                <p style="font-weight:800;font-size:1rem">Jardín de Niños</p>
                <p style="color:#6BC5F8;font-weight:800">UACJ</p>
                <p style="font-size:0.75rem;color:#6B7A8D;margin-top:8px">Fondo blanco</p>
            </div>
            <!-- Fondo azul -->
            <div style="background:#6BC5F8;border-radius:10px;padding:28px;text-align:center">
                <div style="font-size:4rem;margin-bottom:12px">🌻</div>
                <p style="font-weight:800;font-size:1rem;color:white">Jardín de Niños</p>
                <p style="color:rgba(255,255,255,0.8);font-weight:800">UACJ</p>
                <p style="font-size:0.75rem;color:rgba(255,255,255,0.7);margin-top:8px">Fondo primario</p>
            </div>
            <!-- Fondo oscuro -->
            <div style="background:#3D3D3D;border-radius:10px;padding:28px;text-align:center">
                <div style="font-size:4rem;margin-bottom:12px">🌻</div>
                <p style="font-weight:800;font-size:1rem;color:white">Jardín de Niños</p>
                <p style="color:#6BC5F8;font-weight:800">UACJ</p>
                <p style="font-size:0.75rem;color:rgba(255,255,255,0.5);margin-top:8px">Fondo oscuro</p>
            </div>
            <!-- Gradiente -->
            <div style="background:linear-gradient(135deg,#6BC5F8,#7EDDA0);border-radius:10px;padding:28px;text-align:center">
                <div style="font-size:4rem;margin-bottom:12px">🌻</div>
                <p style="font-weight:800;font-size:1rem;color:white">Jardín de Niños</p>
                <p style="color:rgba(255,255,255,0.85);font-weight:800">UACJ</p>
                <p style="font-size:0.75rem;color:rgba(255,255,255,0.7);margin-top:8px">Fondo gradiente</p>
            </div>
        </div>
    </div>

    <!-- ══ Componentes UI ══════════════════════════════════════ -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:28px">
        <h2 style="font-size:1.2rem;font-weight:800;margin-bottom:6px">Componentes de interfaz</h2>
        <p style="color:#6B7A8D;font-size:0.9rem;margin-bottom:24px">Elementos visuales reutilizables del sistema.</p>

        <!-- Botones -->
        <p style="font-weight:700;margin-bottom:12px;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;color:#6B7A8D">Botones</p>
        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:24px">
            <button class="btn-primary">Primario</button>
            <button class="btn-secondary">Secundario</button>
            <button class="btn-danger">Eliminar</button>
            <button class="btn-primary btn-sm">Pequeño</button>
        </div>

        <!-- Badges -->
        <p style="font-weight:700;margin-bottom:12px;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;color:#6B7A8D">Badges / Etiquetas</p>
        <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px">
            <span class="badge badge-admin">admin</span>
            <span class="badge badge-docente">docente</span>
            <span class="badge badge-padre">padre</span>
            <span class="nav-badge badge-admin">Admin</span>
            <span class="nav-badge badge-docente">Maestra</span>
            <span class="nav-badge badge-padre">Padre</span>
        </div>

        <!-- Alertas -->
        <p style="font-weight:700;margin-bottom:12px;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;color:#6B7A8D">Alertas</p>
        <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:24px">
            <div class="alert alert-success">✅ Operación realizada correctamente.</div>
            <div class="alert alert-error">❌ Ocurrió un error. Intenta de nuevo.</div>
            <div class="alert alert-info">ℹ️ Tu hijo está pendiente de asignación de grupo.</div>
        </div>

        <!-- Inputs -->
        <p style="font-weight:700;margin-bottom:12px;font-size:0.9rem;text-transform:uppercase;letter-spacing:0.5px;color:#6B7A8D">Campos de formulario</p>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px">
            <div class="form-group">
                <label>Campo de texto</label>
                <input type="text" placeholder="Escribe aquí...">
            </div>
            <div class="form-group">
                <label>Selector</label>
                <select>
                    <option>Opción 1</option>
                    <option>Opción 2</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ══ Tecnologías ═════════════════════════════════════════ -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:48px">
        <h2 style="font-size:1.2rem;font-weight:800;margin-bottom:6px">Stack tecnológico</h2>
        <p style="color:#6B7A8D;font-size:0.9rem;margin-bottom:24px">Tecnologías utilizadas en el desarrollo del proyecto.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px">
            <?php
            $techs = [
                ['🐘', 'PHP 8.2',          'Backend y lógica del servidor',  '#EBF7FF', '#1A6A9A'],
                ['🗄️', 'MySQL',            'Base de datos relacional',        '#EDFFF4', '#1A7A42'],
                ['🌐', 'HTML5',            'Estructura del contenido',        '#FFF5EB', '#7A3A00'],
                ['🎨', 'CSS3',             'Estilos y diseño visual',         '#F3F0FF', '#4A0080'],
                ['⚡', 'JavaScript',       'Interactividad del frontend',     '#FFFBEB', '#7A5500'],
                ['📧', 'EmailJS',          'Envío de correos electrónicos',   '#FFF0F4', '#7A0028'],
                ['☁️', 'OpenWeatherMap',   'API del clima en tiempo real',    '#EBF7FF', '#1A6A9A'],
                ['💬', 'ZenQuotes',        'API de frases motivacionales',    '#EDFFF4', '#1A7A42'],
                ['📍', 'Google Maps',      'Geolocalización embebida',        '#FFF5EB', '#7A3A00'],
                ['📊', 'Google Analytics', 'Analítica web',                   '#FFF0F4', '#7A0028'],
                ['🌍', 'AwardSpace',       'Hosting y subdominio gratuito',   '#F3F0FF', '#4A0080'],
                ['🐙', 'GitHub',           'Control de versiones',            '#FFFBEB', '#7A5500'],
            ];
            foreach ($techs as $t):
            ?>
            <div style="background:<?= $t[3] ?>;border-radius:10px;padding:16px;display:flex;flex-direction:column;gap:6px">
                <span style="font-size:1.8rem"><?= $t[0] ?></span>
                <p style="font-weight:800;font-size:0.9rem;color:<?= $t[4] ?>"><?= $t[1] ?></p>
                <p style="font-size:0.78rem;color:<?= $t[4] ?>;opacity:0.8;line-height:1.3"><?= $t[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer de la página -->
    <div style="text-align:center;margin-bottom:40px">
        <a href="index.php" style="background:#6BC5F8;color:white;padding:12px 32px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-block;margin-right:12px">
            Inicio
        </a>
        <a href="sitemap.php" style="background:#F0F4F8;color:#3D3D3D;padding:12px 32px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-block">
            Site Map
        </a>
        <a href="modelo_erp.php" style="background:#F0F4F8;color:#3D3D3D;padding:12px 32px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-block">
            Modelo ER
        </a>
        <a href="api/datos.php" style="background:#F0F4F8;color:#3D3D3D;padding:12px 32px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-block">
            API Gestión
        </a>
    </div>

</div>
</body>
</html>
