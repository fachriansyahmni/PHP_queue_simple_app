<?php
session_start();
include_once "../config.php";

$getAllLokets = mysqli_query($konek, "SELECT * FROM `lokets`");

if (mysqli_num_rows($getAllLokets) > 0) {
    $Lokets = mysqli_fetch_all($getAllLokets);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Loket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>

<body>
    <?php
    include_once 'compent-sidebar.php';
    ?>
    <main class="mt-5">
        <div class="container">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width=10px>NO</th>
                                <th>NAMA</th>
                                <th>ALIAS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($Lokets)) {
                                foreach ($Lokets as $index => $loket) {
                            ?>
                                    <tr>
                                        <td><?= $index + 1  ?></td>
                                        <td><?= $loket[2];  ?></td>
                                        <td><?= $loket[3];  ?></td>
                                        <td>
                                            <form method="POST">
                                                <button class="btn" type="submit">edit</button>
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