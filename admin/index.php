<?php
session_start();
include_once "../config.php";
// include "../config/cekUser.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <a href="manage-user.php">manage user</a>
    <a href="config-antrian.php">konfigurasi antrian</a>
    <a href="../logout.php">keluar</a>
</body>

</html>