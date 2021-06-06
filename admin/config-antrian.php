<?php
session_start();
include_once "../config.php";
// include "../config/cekUser.php";

$_getConfigAntrian = mysqli_query($konek, "SELECT * FROM config_antrian ORDER BY id DESC LIMIT 1");
if (mysqli_num_rows($_getConfigAntrian) > 0) {
    $ConfigAntrian = mysqli_fetch_assoc($_getConfigAntrian);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Antrian Terbaru</th>
                            <td><?= $ConfigAntrian['current_queue']; ?></td>
                        </tr>
                        <tr>
                            <th>Antrian Sebelumnya</th>
                            <td><?= $ConfigAntrian['last_queue']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="">Reset Antrian Menjadi</label>
                            <input type="number" min="0" name="antrian_ke" value="1" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>

</html>