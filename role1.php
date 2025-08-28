<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}


$role = $_SESSION['role'] ?? 'user';


switch ($role) {
    case 'admin':
        header("Location: admin.php");
        exit;

    case 'editor':
        header("Location: editor.php");
        exit;

    case 'user':
        header("Location: user4.php");
        exit;

    default:
        echo "⛔ Access Denied. Unknown role.";
        session_destroy();
        exit;
}
