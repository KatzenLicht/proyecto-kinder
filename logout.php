<?php
// ============================================================
// logout.php
// Destruye la sesión y redirige al login
// ============================================================

if (session_status() === PHP_SESSION_NONE) session_start();

session_unset();
session_destroy();

header('Location: login.php?msg=logout');
exit();
