<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['akses'] !== 'departemen') {
    header("Location: ../../unauthorized.php");
    exit();
}
