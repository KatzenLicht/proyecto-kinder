# 🌻 Jardín de Niños UACJ — Sistema Web

Proyecto académico desarrollado para la materia de Programacion Integral.
Sistema de gestión escolar para un jardín de niños con roles de Administrador, Maestra y Padre/Tutor.

---

## 🌐 Sitio en línea

**URL:** [http://proyecto-kinder.atwebpages.com](http://proyecto-kinder.atwebpages.com)

---

## 📋 Descripción

Aplicación web completa que incluye:

- **Página pública** con información del kínder, galería, mapa, clima en tiempo real y formulario de contacto
- **Sistema de login** con redirección automática por rol
- **Panel de Administrador** — gestión completa de usuarios, personal, grupos, alumnos y padres
- **Panel de Maestra** — visualización de sus grupos y alumnos, asignación de alumnos sin grupo
- **Panel de Padre/Tutor** — inscripción de hijo, información de grupo y maestra, contacto por correo
- **Registro de padres** con notificación automática por correo

---

## 👥 Roles del sistema

| Rol | Usuario de prueba | Contraseña |
|-----|-------------------|------------|
| Administrador | `admin` | `admin123` |
| Docente | Crear desde panel admin | (la que se asigne) |
| Padre/Tutor | Registro propio | (la que se registre) |

---

## 🛠️ Tecnologías utilizadas

| Tecnología | Uso |
|------------|-----|
| PHP 8.2 | Backend, sesiones, lógica de negocio |
| MySQL / MariaDB | Base de datos |
| HTML5 + CSS3 | Estructura y estilos |
| JavaScript (ES6) | Interactividad del frontend |
| EmailJS | Envío de correos sin backend de correo |
| OpenWeatherMap API | Clima en tiempo real de Ciudad Juárez |
| ZenQuotes API | Frase motivacional del día |
| Google Maps Embed | Geolocalización del kínder |
| Google Fonts (Nunito) | Tipografía |

---

## 📁 Estructura de archivos

```
kinderProyectoFinal/
│
├── index.php                     ← Página pública principal
├── login.php                     ← Formulario de inicio de sesión
├── login_proceso.php             ← Validación de credenciales
├── logout.php                    ← Cierre de sesión
├── registro_padre.php            ← Formulario de registro de padres
├── registro_exitoso.php          ← Confirmación de registro + EmailJS
├── kinder_actualizado.sql        ← Base de datos completa
│
├── includes/
│   ├── db.php                    ← Conexión PDO a MySQL
│   └── auth.php                  ← Control de sesiones y roles
│
├── admin/
│   └── dashboard.php             ← Panel del administrador
│
├── maestra/
│   └── dashboard.php             ← Panel de la maestra
│
├── padre/
│   └── dashboard.php             ← Panel del padre/tutor
│
├── api/
│   ├── usuarios.php              ← CRUD usuarios
│   ├── personal.php              ← CRUD personal docente
│   ├── grupos.php                ← CRUD grupos
│   ├── alumnos.php               ← CRUD alumnos + asignación
│   ├── padres.php                ← Eliminar padres
│   └── inscribir_hijo.php        ← Inscripción de alumno por padre
│
└── assets/
    └── css/
        └── styles.css            ← Estilos globales del proyecto
```

---

## 🗄️ Base de datos

**Nombre:** `kinder`

| Tabla | Descripción |
|-------|-------------|
| `usuarios` | Cuentas de acceso (admin, docente, padre) |
| `personal` | Datos del personal docente |
| `grupo` | Grupos de clase asignados a maestras |
| `alumnos` | Alumnos del kínder (grupo nullable) |
| `padres` | Datos de padres/tutores vinculados a usuario y alumno |

---

## 🔌 APIs integradas

### OpenWeatherMap
- **Endpoint:** `api.openweathermap.org/data/2.5/weather`
- **Función:** Muestra el clima actual de Ciudad Juárez con recomendación para padres
- **Fallback:** Muestra mensaje genérico si la API no responde

### ZenQuotes
- **Endpoint:** `zenquotes.io/api/today`
- **Función:** Frase motivacional del día en la página principal
- **Fallback:** 5 frases educativas predefinidas si la API no responde

---

## 📧 Correos automáticos (EmailJS)

| Evento | Destinatario |
|--------|-------------|
| Registro de nuevo padre | dev.lagunes@gmail.com |
| Mensaje de padre a maestra | dev.lagunes@gmail.com |
| Formulario de contacto público | dev.lagunes@gmail.com |

**Service ID:** `service_63vbgb6`
**Template ID:** `template_9ziqeze`

---

## ⚙️ Instalación local (XAMPP)

1. Clona o copia la carpeta `kinderProyectoFinal` en `C:\xampp\htdocs\`
2. Importa `kinder_actualizado.sql` en phpMyAdmin
3. Abre `includes/db.php` y verifica:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'kinder');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```
4. Entra a `http://localhost/kinderProyectoFinal/`

---

## ☁️ Instalación en AwardSpace

1. Sube todos los archivos por FTP a la carpeta `public_html/`
2. Crea la base de datos desde el panel de AwardSpace
3. Importa el SQL desde phpMyAdmin de AwardSpace
4. Actualiza `includes/db.php` con las credenciales de AwardSpace:
   ```php
   define('DB_HOST', 'mysql.atwebpages.com');
   define('DB_NAME', 'tu_nombre_bd');
   define('DB_USER', 'tu_usuario_bd');
   define('DB_PASS', 'tu_password_bd');
   ```
5. Cambia todas las rutas `/kinderProyectoFinal/` por `/` en:
   - `includes/auth.php`
   - `login_proceso.php`
   - Todos los archivos en `api/`

---

## 👨‍💻 Desarrollado por

**Julian de Jesus Lagunes Aleman**
Universidad Autónoma de Ciudad Juárez (UACJ)
Materia: Desarrollo Web — 2025
