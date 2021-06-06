<?php
session_start();
include_once "config.php";

if (isset($_POST['login-submit'])) {
    if (!isset($_POST['username']) && !isset($_POST['password'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

    if ($username == null || $password == null) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $User = mysqli_query($konek, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($User) > 0) {
        $getDataUser = mysqli_fetch_assoc($User);
        if ($password == $getDataUser['password']) {

            $_SESSION['role'] = $getDataUser['role'];
            $_SESSION['UID'] = $getDataUser['id'];

            if ($_SESSION['role'] == "admin") {
                echo "admin";
                header('location:admin/index.php');
                exit;
            }
            header('location:counter/index.php');
            exit;
        }
    } else {
        $pesan_eror = "User tidak di temukan!";
    }


    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
