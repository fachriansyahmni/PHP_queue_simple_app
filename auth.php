<?php
session_start();
include_once "config.php";
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == "admin") {
        header('location:admin/index.php');
        exit;
    }
    header('location:counter/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LLogin</title>
</head>

<body>
    <form action="login.php" method="POST">
        <input type="hidden" name="_token" value="<?php echo $token ?>" id="">
        <input type="text" name="username" id="" placeholder="username">
        <input type="text" name="password" id="" placeholder="password">
        <button type="submit" name="login-submit">login</button>
    </form>
</body>

</html>