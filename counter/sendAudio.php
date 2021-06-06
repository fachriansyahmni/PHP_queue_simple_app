<?php
session_start();
include_once "../config.php";
$uid = $_SESSION['UID'];

$UserData = mysqli_query($konek, "SELECT * FROM users WHERE id = $uid");
$getUserData = mysqli_fetch_assoc($UserData);
$loketid = $getUserData['loket_id'];
$LoketData = mysqli_query($konek, "SELECT * FROM `lokets` WHERE `id` = $loketid");

$getData = mysqli_fetch_assoc($LoketData);
$toLoket = $getData['aliases'];

$nomor_antrian = $_POST['nomor_antrian'];

$datum = new DateTime();
$startTime = $datum->format('Y-m-d H:i:s');
$Panggil = mysqli_query($konek, "INSERT INTO `panggil` (`urut`, `loket`, `waktu`) VALUES ('$nomor_antrian', '$toLoket', '$startTime')");
header('location:' . $_SERVER['HTTP_REFERER']);
