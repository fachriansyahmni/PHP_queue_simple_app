<?php
require_once "koneksi.php";
setlocale(LC_TIME, 'id');
date_default_timezone_set('Asia/Jakarta');

define("APP_NAME", "Antrian App");
define("ISBLOCKED", false);

$title = APP_NAME;

if (ISBLOCKED) {
    header('location:blocked.php');
    exit;
}
