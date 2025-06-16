<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['akses'] !== 'admin') {
    header("Location: ../../unauthorized.php");
    exit();
}
