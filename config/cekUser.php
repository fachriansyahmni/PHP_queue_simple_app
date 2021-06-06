<?php
if (!$_SESSION['role']) {
    header('location:../index.php');
}


$roleUser = $_SESSION['role'];

// die;
switch ($roleUser) {
    case "admin":
        $RedirectTo = "../admin/index.php";
        break;
    default:
        $RedirectTo = "../counter/index.php";
        break;
}

header('location:' . $RedirectTo);
// exit;
