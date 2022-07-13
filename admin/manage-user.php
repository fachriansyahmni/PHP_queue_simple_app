<?php
session_start();
include_once "../config.php";

$getAllLokets = mysqli_query($konek, "SELECT * FROM `users` WHERE `role` != 'admin'");
$Lokets = mysqli_query($konek, "SELECT * FROM `lokets`");

if (mysqli_num_rows($getAllLokets) > 0) {
    $Loketers = mysqli_fetch_all($getAllLokets);
}

if (mysqli_num_rows($Lokets) > 0) {
    $rsltLokets = mysqli_fetch_all($Lokets);
}

if (isset($_POST['updatedatauser'])) {
    $idUser = htmlspecialchars($_GET['userid'], ENT_QUOTES);
    $nameEdit = $_POST['name_e'];
    $loketId = $_POST['loket_e'];
    $checkUser = mysqli_query($konek, "SELECT * FROM `users` WHERE `id` = $idUser");
    if (mysqli_num_rows($checkUser) > 0) {
        $up = mysqli_query($konek, "UPDATE `users` SET `name` = '$nameEdit', `loket_id` = '$loketId' WHERE `users`.`id` = $idUser ");
        header("location:manage-user.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>

<body>
    <?php
    include_once 'compent-sidebar.php';
    ?>

    <main class="mt-5">
        <div class="container">
            <div class="card">
                <?php
                if (isset($_GET['edituser'])) {
                    $idUser = htmlspecialchars($_GET['userid'], ENT_QUOTES);
                    $getDataUser = mysqli_query($konek, "SELECT * FROM users WHERE id = $idUser");
                    $rslt = mysqli_fetch_assoc($getDataUser);
                ?>
                    <div class="card-body mb-3">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="usernameEdit" class="form-label">Username</label>
                                <input type="text" class="form-control" id="usernameEdit" readonly disabled value="<?= $rslt["username"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nameEdit" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nameEdit" name="name_e" value="<?= $rslt["name"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="loketEdit" class="form-label">Loket</label>
                                <select name="loket_e" id="loketEdit" class="form-control">
                                    <option value="0" disabled></option>
                                    <?php
                                    foreach ($rsltLokets as $sloket) {
                                    ?>
                                        <option value="<?= $sloket[0] ?>" <?= ($rslt["loket_id"] == $sloket[0]) ? "selected" : "" ?>><?= $sloket[2];  ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="updatedatauser">update</button>
                        </form>
                    </div>
                <?php
                }
                ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width=10px>NO</th>
                                <th>USERNAME</th>
                                <th>NAMA</th>
                                <th>LOKET</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($Loketers)) {
                                foreach ($Loketers as $index => $loketer) {
                            ?>
                                    <tr>
                                        <td><?= $index + 1  ?></td>
                                        <td><?= $loketer[2];  ?></td>
                                        <td><?= $loketer[1];  ?></td>
                                        <td>
                                            <?= $loketer[5];  ?>
                                        </td>
                                        <td>
                                            <form method="GET">
                                                <input type="hidden" value="<?= $loketer[0] ?>" name="userid">
                                                <button class="btn btn-info" type="submit" name="edituser">edit</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>

</html>