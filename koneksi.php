<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$debe = 'antrian';

$konek = mysqli_connect($host, $user, $pass, $debe);
if (!$konek) {
    return "cannot connect to database!";
}
