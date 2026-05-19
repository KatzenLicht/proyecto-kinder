<?php
// ============================================================
// index.php — Página pública del Jardín de Niños UACJ
// ============================================================
if (session_status() === PHP_SESSION_NONE) session_start();

$contacto_msg   = $_GET['msg']   ?? '';
$contacto_error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardín de Niños UACJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
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
<body>

<!-- ══════════════════════════════════════════════════════════
     NAVBAR
══════════════════════════════════════════════════════════ -->
<nav class="navbar">
    <div class="navbar-brand">
        <span class="brand-emoji">🌻</span>
        Jardín de Niños UACJ
    </div>
    <ul class="navbar-links">
        <li><a href="#inicio">Inicio</a></li>
        <li><a href="#nosotros">Nosotros</a></li>
        <li><a href="#servicios">Servicios</a></li>
        <li><a href="#galeria">Galería</a></li>
        <li><a href="#ubicacion">Ubicación</a></li>
        <li><a href="#contacto">Contacto</a></li>
        <li><a href="login.php" class="btn-nav-login">Iniciar sesión</a></li>
    </ul>
</nav>

<!-- ══════════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════════ -->
<section class="hero" id="inicio">
    <div class="hero-content">
        <div class="hero-text">
            <span class="hero-tag">Ciclo escolar 2025–2026</span>
            <h1 class="hero-title">
                Bienvenidos al<br>
                <span>Jardín de Niños UACJ</span>
            </h1>
            <div class="hero-typed" id="typed-text"></div>
            <p class="hero-subtitle">
                Un espacio seguro, colorido y lleno de aprendizaje donde cada niño
                desarrolla su potencial al máximo.
            </p>
            <div class="hero-btns">
                <a href="registro_padre.php" class="btn-primary">Inscribe a tu hijo</a>
                <a href="#nosotros" class="btn-secondary">Conoce más</a>
            </div>
        </div>

        <div class="hero-visual">
            <!-- Widget del clima -->
            <div class="weather-widget" id="weather-widget">
                <div class="weather-title">☁️ Clima hoy en Ciudad Juárez</div>
                <div class="weather-icon" id="w-icon">⏳</div>
                <div class="weather-temp" id="w-temp">Cargando...</div>
                <div class="weather-desc" id="w-desc"></div>
                <div class="weather-rec"  id="w-rec"></div>
            </div>

            <!-- Tarjetas flotantes -->
            <div class="float-cards">
                <div class="float-card">
                    <div class="float-card-icon">🎨</div>
                    <div class="float-card-text">
                        <strong>Arte y Creatividad</strong>
                        <span>Actividades diarias</span>
                    </div>
                </div>
                <div class="float-card">
                    <div class="float-card-icon">📚</div>
                    <div class="float-card-text">
                        <strong>Grupos pequeños</strong>
                        <span>Atención personalizada</span>
                    </div>
                </div>
                <div class="float-card">
                    <div class="float-card-icon">🌱</div>
                    <div class="float-card-text">
                        <strong>Desarrollo integral</strong>
                        <span>Cognitivo y emocional</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     FRASE DEL DÍA
══════════════════════════════════════════════════════════ -->
<div class="quote-section">
    <p class="quote-text" id="quote-text">"Cargando frase del día..."</p>
    <p class="quote-author" id="quote-author"></p>
</div>

<!-- ══════════════════════════════════════════════════════════
     NOSOTROS
══════════════════════════════════════════════════════════ -->
<section id="nosotros">
    <div class="section">
        <span class="section-tag">Quiénes somos</span>
        <h2 class="section-title">Un jardín hecho con amor</h2>
        <p class="section-subtitle">
            El Jardín de Niños UACJ nació con la misión de ofrecer una educación inicial
            de calidad, donde cada niño se sienta querido, seguro y motivado a aprender
            a través del juego y la exploración.
        </p>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">❤️</div>
                <h3>Ambiente amoroso</h3>
                <p>Maestras comprometidas con el bienestar emocional de cada niño.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🏫</div>
                <h3>Instalaciones seguras</h3>
                <p>Espacios diseñados pensando en la seguridad y comodidad infantil.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">👨‍👩‍👧</div>
                <h3>Comunidad unida</h3>
                <p>Fomentamos la comunicación constante entre padres y maestras.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🎓</div>
                <h3>Respaldo universitario</h3>
                <p>Vinculados con la UACJ para aplicar metodologías educativas modernas.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     SERVICIOS
══════════════════════════════════════════════════════════ -->
<section id="servicios" class="section-full section-bg">
    <div class="section">
        <span class="section-tag">Qué ofrecemos</span>
        <h2 class="section-title">Nuestros servicios</h2>
        <p class="section-subtitle">
            Programas pensados para el desarrollo integral de niños de 3 a 6 años.
        </p>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">🎨</div>
                <h3>Arte y manualidades</h3>
                <p>Estimulación de la creatividad con materiales seguros y divertidos.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🔢</div>
                <h3>Iniciación matemática</h3>
                <p>Aprendemos números, formas y patrones jugando.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">📖</div>
                <h3>Lectoescritura</h3>
                <p>Bases sólidas para la lecto-escritura desde temprana edad.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🏃</div>
                <h3>Educación física</h3>
                <p>Actividades motrices que promueven salud y coordinación.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🎵</div>
                <h3>Música y movimiento</h3>
                <p>Canciones, ritmos y baile para estimular el cerebro.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🌿</div>
                <h3>Valores y naturaleza</h3>
                <p>Enseñamos respeto al medio ambiente y a los demás.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     GALERÍA
══════════════════════════════════════════════════════════ -->
<section id="galeria">
    <div class="section">
        <span class="section-tag">Momentos</span>
        <h2 class="section-title">Galería de actividades</h2>
        <p class="section-subtitle">Un vistazo a la vida en nuestro jardín.</p>

        <!-- Carrusel -->
        <div class="carousel-wrapper">
            <div class="carousel-track" id="carouselTrack">
                <div class="carousel-slide">
                    <img src="assets/img/arte_manualidades.jpg" alt="">
                    <div class="carousel-slide-label">Arte y Manualidades</div>
                </div>
                <div class="carousel-slide">
                    <img src="assets/img/lectura_aprendizaje.jpg" alt="">
                    <div class="carousel-slide-label">Lectura y Aprendizaje</div>
                </div>
                <div class="carousel-slide">
                    <img src="assets/img/educacion_fisica.webp" alt="">
                    <div class="carousel-slide-label">Educación Física</div>
                </div>
                <div class="carousel-slide">
                    <img src="assets/img/musica_movimiento.webp" alt="">
                    <div class="carousel-slide-label">Música y Movimiento</div>
                </div>
                <div class="carousel-slide">
                    <img src="assets/img/valores_naturaleza.webp" alt="">
                    <div class="carousel-slide-label">Valores y Naturaleza</div>
                </div>
            </div>

        </div>

        <!-- Puntos indicadores -->
        <div class="carousel-dots" id="carouselDots"></div>
        <p style="margin-top:16px;font-size:0.85rem;color:var(--gray)"></p>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     UBICACIÓN
══════════════════════════════════════════════════════════ -->
<section id="ubicacion" class="map-section">
    <div class="map-info">
        <div class="map-iframe">
            <!-- UACJ-IADA/IIT Ciudad Juárez -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3397.3!2d-106.4244!3d31.7219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75d8b1f2f7f6f%3A0x1!2sUACJ+IADA+IIT!5e0!3m2!1ses!2smx!4v1"
                allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <div class="map-details">
            <span class="section-tag">Dónde estamos</span>
            <h2 class="section-title" style="margin-top:8px">Visítanos</h2>

            <div class="map-detail-item">
                <div class="map-detail-icon"></div>
                <div>
                    <strong>Dirección</strong>
                    <span>Av. del Charro 450, Col. Partido Romero,<br>Ciudad Juárez, Chihuahua</span>
                </div>
            </div>
            <div class="map-detail-item">
                <div class="map-detail-icon"></div>
                <div>
                    <strong>Horario</strong>
                    <span>Lunes a viernes: 7:30 AM – 2:00 PM</span>
                </div>
            </div>
            <div class="map-detail-item">
                <div class="map-detail-icon"></div>
                <div>
                    <strong>Teléfono</strong>
                    <span>(656) 688-4800</span>
                </div>
            </div>
            <div class="map-detail-item">
                <div class="map-detail-icon"></div>
                <div>
                    <strong>Correo</strong>
                    <span>alumno196614@gmail.com</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     CONTACTO + TARJETA DE PRESENTACIÓN
══════════════════════════════════════════════════════════ -->
<section id="contacto" class="contact-section">
    <div class="contact-two-col">

        <!-- ── Columna izquierda: Tarjeta de presentación ── -->
        <div class="id-card">

            <!-- Foto y datos -->
            <div class="id-top">
                <div class="id-avatar">
                    <img src="assets/img/yo.jpg" alt="" style="border-radius: 50%;">
                </div>
                <h3 class="id-nombre">Julian Lagunes</h3>
                <p class="id-carrera">Diseño Digital de Medios Interactivos</p>
                <p class="id-escuela">Universidad Autónoma de Ciudad Juárez</p>
                <span class="id-badge">Desarrollador Web · 2026</span>
            </div>

            <!-- Paleta de colores -->
            <div class="id-paleta">
                <p class="id-paleta-titulo">Paleta de colores</p>
                <div class="id-paleta-grid">
                    <div class="id-color" style="background:#6BC5F8"><span>#6BC5F8</span><small>Azul cielo</small></div>
                    <div class="id-color" style="background:#7EDDA0"><span>#7EDDA0</span><small>Verde menta</small></div>
                    <div class="id-color" style="background:#FFE082;color:#555"><span>#FFE082</span><small>Amarillo</small></div>
                    <div class="id-color" style="background:#FFB3C6;color:#555"><span>#FFB3C6</span><small>Rosa pálido</small></div>
                    <div class="id-color" style="background:#C9B8F0"><span>#C9B8F0</span><small>Lavanda</small></div>
                    <div class="id-color" style="background:#3D3D3D"><span>#3D3D3D</span><small>Texto</small></div>
                </div>
            </div>

            <!-- QR codes -->
            <div class="id-qr-section">
                <p class="id-paleta-titulo">Escanea y visítanos</p>
                <div class="id-qr-row">
                    <div class="id-qr-item">
                        <img id="qr-github" src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=https://github.com/KatzenLicht/proyecto-kinder"
                             alt="QR GitHub" class="id-qr-img" loading="lazy">
                        <small>GitHub</small>
                    </div>
                    <div class="id-qr-item">
                        <img id="qr-awardspace" src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=http://proyecto-kinder.atwebpages.com"
                             alt="QR AwardSpace" class="id-qr-img" loading="lazy">
                        <small>Sitio Web</small>
                    </div>
                </div>
            </div>

        </div>

        <!-- ── Columna derecha: Formulario de contacto ── -->
        <div class="contact-right">
            <span class="section-tag">Escríbenos</span>
            <h2 class="section-title" style="margin-top:8px">¿Tienes alguna pregunta?</h2>
            <p>Estamos aquí para ayudarte. Escríbenos y te respondemos a la brevedad.</p>

            <?php if ($contacto_msg === 'enviado'): ?>
            <div class="alert alert-success" style="margin-top:20px">✅ Mensaje enviado correctamente.</div>
            <?php endif; ?>

            <div class="contact-form">
                <div class="form-group">
                    <label>Tu nombre</label>
                    <input type="text" id="c-nombre" placeholder="Nombre completo" required>
                </div>
                <div class="form-group" style="margin-top:14px">
                    <label>Tu correo</label>
                    <input type="email" id="c-correo" placeholder="correo@ejemplo.com" required>
                </div>
                <div class="form-group" style="margin-top:14px">
                    <label>Mensaje</label>
                    <textarea id="c-mensaje" rows="4" placeholder="¿En qué podemos ayudarte?"></textarea>
                </div>
                <button class="btn-primary btn-block" style="margin-top:20px"
                        onclick="enviarContacto()" id="btn-contacto">
                    Enviar mensaje
                </button>
                <div id="contacto-status" style="margin-top:12px;display:none"></div>
            </div>
        </div>

    </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════════════════ -->
<footer class="footer">
    <p>
        <strong>Jardín de Niños UACJ</strong> &nbsp;|&nbsp;
        Av. del Charro 450, Ciudad Juárez, Chih. &nbsp;|&nbsp;
        <a href="mailto:alumno196614@gmail.com">alumno196614@gmail.com</a>
    </p>

    <!-- Redes Sociales -->
    <div class="footer-social">
        <a href="https://facebook.com" target="_blank" class="social-btn" title="Facebook">
            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
            Facebook
        </a>
        <a href="https://instagram.com" target="_blank" class="social-btn" title="Instagram">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            Instagram
        </a>
        <a href="https://wa.me/6561234567" target="_blank" class="social-btn" title="WhatsApp">
            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.125.557 4.126 1.533 5.859L.057 23.547a.5.5 0 00.609.61l5.805-1.525A11.95 11.95 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.891 0-3.667-.5-5.208-1.378l-.374-.217-3.878 1.018 1.037-3.786-.234-.389A9.96 9.96 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/></svg>
            WhatsApp
        </a>
        <a href="sitemap.php" class="social-btn" title="Mapa del sitio">
            Site Map
        </a>
        <a href="identidad.php" class="social-btn" title="Identidad del proyecto">
            Identidad
        </a>
    </div>

    <p style="margin-top:16px;font-size:0.82rem">
        © <?= date('Y') ?> Jardín de Niños UACJ. Todos los derechos reservados.
        &nbsp;|&nbsp; <a href="login.php">Acceso personal</a>
        &nbsp;|&nbsp; <a href="https://github.com/KatzenLicht/proyecto-kinder" target="_blank">GitHub</a>
    </p>
</footer>

<!-- ══════════════════════════════════════════════════════════
     SCRIPTS
══════════════════════════════════════════════════════════ -->
<script>
// ── Typing effect ──────────────────────────────────────────
const frases = ["Aprendiendo jugando 🎮", "Creciendo con amor ❤️", "Explorando el mundo 🌍", "¡Inscríbete hoy! 🌟"];
let fi = 0, ci = 0, borrando = false;
const el = document.getElementById('typed-text');
function tipear() {
    const f = frases[fi];
    el.textContent = borrando ? f.substring(0, ci--) : f.substring(0, ci++);
    if (!borrando && ci > f.length)  { borrando = true; setTimeout(tipear, 1400); return; }
    if (borrando  && ci < 0)         { borrando = false; fi = (fi+1) % frases.length; setTimeout(tipear, 400); return; }
    setTimeout(tipear, borrando ? 40 : 90);
}
tipear();

// ── API Clima — OpenWeatherMap ─────────────────────────────
const OW_KEY  = '534109ae10d203099c1eacaa7d1a677e';
const iconMap = {
    '01d':'☀️','01n':'🌙','02d':'⛅','02n':'⛅',
    '03d':'☁️','03n':'☁️','04d':'☁️','04n':'☁️',
    '09d':'🌧️','09n':'🌧️','10d':'🌦️','10n':'🌦️',
    '11d':'⛈️','11n':'⛈️','13d':'❄️','13n':'❄️','50d':'🌫️','50n':'🌫️'
};

fetch(`https://api.openweathermap.org/data/2.5/weather?q=Ciudad+Juarez,MX&appid=${OW_KEY}&units=metric&lang=es`)
    .then(r => {
        if (!r.ok) throw new Error('Error ' + r.status);
        return r.json();
    })
    .then(d => {
        const temp = Math.round(d.main.temp);
        const desc = d.weather[0].description;
        const icon = iconMap[d.weather[0].icon] || '🌤️';
        const rec  = temp < 10 ? '🧥 Hace frío — trae chamarra al niño'
                   : temp < 18 ? '🌬️ Fresco — considera un suéter'
                   : temp < 28 ? '✅ Buen clima para ir a clases'
                   : '🥵 Mucho calor — hidratación importante';

        document.getElementById('w-icon').textContent = icon;
        document.getElementById('w-temp').textContent = temp + '°C';
        document.getElementById('w-desc').textContent = desc.charAt(0).toUpperCase() + desc.slice(1);
        document.getElementById('w-rec').textContent  = rec;
    })
    .catch(() => {
        document.getElementById('w-icon').textContent = '🌤️';
        document.getElementById('w-temp').textContent = '—°C';
        document.getElementById('w-desc').textContent = 'No disponible ahora';
        document.getElementById('w-rec').textContent  = 'Consulta el clima antes de salir';
    });

// ── API Frase del día — con múltiples intentos ─────────────
// Frase de respaldo siempre visible mientras carga
const frasesFallback = [
    { q: 'La educación es el arma más poderosa para cambiar el mundo.', a: 'Nelson Mandela' },
    { q: 'El juego es el trabajo de la infancia.', a: 'Jean Piaget' },
    { q: 'Cada niño es un artista. El problema es cómo seguir siendo artista al crecer.', a: 'Pablo Picasso' },
    { q: 'Dime y lo olvido, enséñame y lo recuerdo, involúcrame y lo aprendo.', a: 'Benjamin Franklin' },
    { q: 'La imaginación es más importante que el conocimiento.', a: 'Albert Einstein' },
];

// Mostrar frase de respaldo inmediatamente
const fb = frasesFallback[Math.floor(Math.random() * frasesFallback.length)];
document.getElementById('quote-text').textContent   = '"' + fb.q + '"';
document.getElementById('quote-author').textContent = '— ' + fb.a;

// Intentar cargar frase real desde ZenQuotes via proxy
fetch('https://corsproxy.io/?' + encodeURIComponent('https://zenquotes.io/api/today'))
    .then(r => { if (!r.ok) throw new Error(); return r.json(); })
    .then(d => {
        if (d && d[0] && d[0].q) {
            document.getElementById('quote-text').textContent   = '"' + d[0].q + '"';
            document.getElementById('quote-author').textContent = '— ' + d[0].a;
        }
    })
    .catch(() => {
        // Ya se muestra la frase de respaldo — no hacer nada
    });

// ── Formulario de contacto público — EmailJS ───────────────
function enviarContacto() {
    const nombre  = document.getElementById('c-nombre').value.trim();
    const correo  = document.getElementById('c-correo').value.trim();
    const mensaje = document.getElementById('c-mensaje').value.trim();
    const status  = document.getElementById('contacto-status');
    const btn     = document.getElementById('btn-contacto');

    if (!nombre || !correo || !mensaje) {
        status.style.display = 'block';
        status.className = 'alert alert-error';
        status.textContent = '❌ Por favor completa todos los campos.';
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Enviando...';

    emailjs.send("service_63vbgb6", "template_9ziqeze", {
        from_name:  nombre,
        from_email: correo,
        to_name:    "Jardín de Niños UACJ",
        subject:    "Contacto desde la página web",
        message:    mensaje,
        reply_to:   correo
    }).then(() => {
        status.style.display = 'block';
        status.className = 'alert alert-success';
        status.textContent = '✅ Mensaje enviado. Te responderemos pronto.';
        btn.textContent = '📨 Enviar mensaje';
        btn.disabled = false;
        document.getElementById('c-nombre').value  = '';
        document.getElementById('c-correo').value  = '';
        document.getElementById('c-mensaje').value = '';
    }).catch(() => {
        status.style.display = 'block';
        status.className = 'alert alert-error';
        status.textContent = '❌ Error al enviar. Intenta de nuevo.';
        btn.textContent = 'Enviar mensaje';
        btn.disabled = false;
    });
}

// ── QR Codes automáticos ───────────────────────────────────
const qrGithub     = 'https://github.com/KatzenLicht/proyecto-kinder';
const qrAwardspace = 'http://proyecto-kinder.atwebpages.com/proyectofinal/index.php';
const qrSize       = '150x150';

document.getElementById('qr-github').src =
    `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}&data=${encodeURIComponent(qrGithub)}&color=3D3D3D&bgcolor=FAFAFA`;

document.getElementById('qr-awardspace').src = 
    `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}&data=${encodeURIComponent(qrAwardspace)}&color=3D3D3D&bgcolor=FAFAFA`;


(function() {
    const track  = document.getElementById('carouselTrack');
    const slides = track.querySelectorAll('.carousel-slide');
    const dotsEl = document.getElementById('carouselDots');
    let current  = 0;
    const total  = slides.length;

    // Crear puntos indicadores
    slides.forEach((_, i) => {
        const d = document.createElement('button');
        d.className = 'carousel-dot' + (i === 0 ? ' active' : '');
        dotsEl.appendChild(d);
    });

    function irA(idx) {
        current = ((idx % total) + total) % total;
        track.style.transform = `translateX(-${current * 100}%)`;
        dotsEl.querySelectorAll('.carousel-dot').forEach((d, i) =>
            d.classList.toggle('active', i === current));
    }

    // Avanza solo cada 3 segundos en bucle infinito
    setInterval(() => irA(current + 1), 3000);
})();
</script>

</body>
</html>