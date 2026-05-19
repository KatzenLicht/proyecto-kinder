<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo E-R — Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2E1G3HZCVV"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-2E1G3HZCVV');</script>
    <!-- Mermaid -->
    <script type="module">
        import mermaid from 'https://esm.sh/mermaid@11/dist/mermaid.esm.min.mjs';
        const dark = matchMedia('(prefers-color-scheme: dark)').matches;
        await document.fonts.ready;
        mermaid.initialize({
            startOnLoad: false,
            theme: 'base',
            fontFamily: "'Nunito', sans-serif",
            themeVariables: {
                darkMode: dark,
                fontSize: '14px',
                fontFamily: "'Nunito', sans-serif",
                lineColor: '#6B7A8D',
                textColor: '#3D3D3D',
                primaryColor: '#EBF7FF',
                primaryBorderColor: '#6BC5F8',
            },
        });

        const { svg } = await mermaid.render('erd-svg', `erDiagram
            usuarios {
                int id_usu PK
                varchar usuario_usu
                varchar password_usu
                enum rol
            }
            personal {
                int id_per PK
                int id_usu FK
                varchar maestra_per
                varchar correo_per
                varchar cel_per
            }
            grupo {
                int id_gpo PK
                int id_usu FK
                varchar grupo_gpo
            }
            alumnos {
                int id_alu PK
                int id_gpo FK
                varchar nombre_alu
                varchar apellidos_alu
            }
            padres {
                int id_padre PK
                int id_usu FK
                int id_alu FK
                varchar nombre_padre
                varchar telefono_padre
                varchar correo_padre
            }
            usuarios ||--o| personal : "tiene perfil"
            usuarios ||--o{ grupo : "maneja"
            usuarios ||--o| padres : "es padre"
            grupo ||--o{ alumnos : "contiene"
            alumnos ||--o| padres : "tiene tutor"
        `);

        document.getElementById('erd-container').innerHTML = svg;
        document.querySelector('#erd-container svg').style.width = '100%';
    </script>
</head>
<body style="background:#F0F4F8;font-family:'Nunito',sans-serif;color:#3D3D3D">

<!-- Navbar -->
<nav style="background:white;padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 12px rgba(0,0,0,0.07);position:sticky;top:0;z-index:100">
    <div style="display:flex;align-items:center;gap:10px;font-size:1.1rem;font-weight:800">
        <span style="font-size:1.5rem">🌻</span>
        Jardín de Niños UACJ
    </div>
    <div style="display:flex;gap:12px">
        <a href="identidad.php" style="background:#F0F4F8;color:#3D3D3D;padding:8px 18px;border-radius:50px;font-weight:700;text-decoration:none;font-size:0.9rem">🎨 Identidad</a>
        <a href="index.php"     style="background:#6BC5F8;color:white;padding:8px 20px;border-radius:50px;font-weight:700;text-decoration:none;font-size:0.9rem">← Inicio</a>
    </div>
</nav>

<div style="max-width:1000px;margin:0 auto;padding:48px 24px">

    <!-- Encabezado -->
    <div style="text-align:center;margin-bottom:40px">
        <span style="background:#D0F0FF;color:#00527A;padding:6px 18px;border-radius:50px;font-size:0.85rem;font-weight:700">
            Base de datos
        </span>
        <h1 style="font-size:2rem;font-weight:900;margin:16px 0 8px">Modelo Entidad-Relación</h1>
        <p style="color:#6B7A8D">Estructura de la base de datos <strong>kinder</strong> — Jardín de Niños UACJ</p>
    </div>

    <!-- Diagrama E-R -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:28px">
        <div id="erd-container" style="width:100%;overflow-x:auto"></div>
    </div>

    <!-- Descripción de relaciones -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:28px">
        <h2 style="font-size:1.2rem;font-weight:800;margin-bottom:20px">🔗 Relaciones del modelo</h2>

        <div style="display:flex;flex-direction:column;gap:14px">
            <?php
            $relaciones = [
                ['usuarios → personal', 'Un usuario docente puede tener un registro de personal asociado con su nombre real, correo y celular.', '1:1'],
                ['usuarios → grupo',    'Un usuario docente puede manejar uno o varios grupos de clase.', '1:N'],
                ['usuarios → padres',   'Un usuario con rol padre tiene exactamente un registro de padre/tutor.', '1:1'],
                ['grupo → alumnos',     'Un grupo puede contener muchos alumnos. Un alumno puede estar sin grupo (NULL).', '1:N'],
                ['alumnos → padres',    'Un alumno puede tener un padre/tutor registrado en el sistema.', '1:1'],
            ];
            foreach ($relaciones as $r):
            ?>
            <div style="display:flex;align-items:flex-start;gap:16px;padding:16px;background:#F8FAFC;border-radius:10px">
                <span style="background:#EBF7FF;color:#1A6A9A;padding:4px 12px;border-radius:50px;font-size:0.78rem;font-weight:700;white-space:nowrap;margin-top:2px">
                    <?= $r[2] ?>
                </span>
                <div>
                    <p style="font-weight:700;margin-bottom:2px;font-size:0.9rem"><?= $r[0] ?></p>
                    <p style="color:#6B7A8D;font-size:0.85rem"><?= $r[1] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Tablas resumen -->
    <div style="background:white;border-radius:14px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.08);margin-bottom:40px">
        <h2 style="font-size:1.2rem;font-weight:800;margin-bottom:20px">📋 Tablas de la BD</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:14px">
            <?php
            $tablas = [
                ['usuarios', '4 campos', 'Cuentas de acceso al sistema', '#EBF7FF', '#1A6A9A'],
                ['personal', '5 campos', 'Datos del personal docente',   '#EDFFF4', '#1A7A42'],
                ['grupo',    '3 campos', 'Grupos de clase',              '#FFF5EB', '#7A3A00'],
                ['alumnos',  '4 campos', 'Alumnos del kínder',           '#FFF0F8', '#7A0050'],
                ['padres',   '6 campos', 'Padres y tutores',             '#F3F0FF', '#4A0080'],
            ];
            foreach ($tablas as $t):
            ?>
            <div style="background:<?= $t[3] ?>;border-radius:10px;padding:18px">
                <p style="font-weight:800;color:<?= $t[4] ?>;margin-bottom:4px"><?= $t[0] ?></p>
                <p style="font-size:0.78rem;color:<?= $t[4] ?>;opacity:0.8;margin-bottom:4px"><?= $t[1] ?></p>
                <p style="font-size:0.78rem;color:<?= $t[4] ?>;opacity:0.7"><?= $t[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div style="text-align:center;margin-bottom:40px">
        <a href="index.php" style="background:#6BC5F8;color:white;padding:12px 32px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-block;margin-right:12px">
            Inicio
        </a>
        <a href="identidad.php" style="background:#F0F4F8;color:#3D3D3D;padding:12px 32px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-block">
            Identidad
        </a>
        <a href="sitemap.php" style="background:#F0F4F8;color:#3D3D3D;padding:12px 32px;border-radius:50px;font-weight:700;text-decoration:none;display:inline-block">
            Site Map
        </a>
    </div>

</div>
</body>
</html>
