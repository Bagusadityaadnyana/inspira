<?php
session_start();

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login dengan pesan sukses
header('Location: index.html?logout=success');
exit;
?>
