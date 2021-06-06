<?php
session_start();
include_once "config.php";

$_Cfg = mysqli_query($konek, "SELECT * FROM config_antrian ORDER BY id DESC LIMIT 1");
$cfgAntrian = mysqli_fetch_assoc($_Cfg);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian</title>
</head>

<body>
    <a href="auth.php">masuk</a>
    <a href="ambil-antrian.php">ambil antrian</a>
    <a href="monitor.php">monitor</a>

</body>

</html>