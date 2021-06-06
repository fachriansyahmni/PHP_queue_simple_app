<?php
session_start();
include_once "../config.php";
// include_once "../config/cekUser.php";
if (!isset($_SESSION['UID'])) {
    header('location:../index.php');
}


$uid = $_SESSION['UID'];
$UserData = mysqli_query($konek, "SELECT * FROM users WHERE id = $uid");
$getUserData = mysqli_fetch_assoc($UserData);
$loketid = $getUserData['loket_id'];
$LoketData = mysqli_query($konek, "SELECT * FROM `lokets` WHERE `id` = $loketid");

$getData = mysqli_fetch_assoc($LoketData);
$toLoket = $getData['aliases'];
$QgetNumberAntrian = mysqli_query($konek, "SELECT * FROM antrian WHERE loket_id = '$toLoket' AND is_done = 0 ORDER BY created_at ASC LIMIT 1");
if (mysqli_num_rows($QgetNumberAntrian) > 0) {
    $getNumberAntrian = mysqli_fetch_assoc($QgetNumberAntrian);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a href="../logout.php" class="btn btn-outline-danger">keluar</a>
            </div>
        </div>
    </nav>
    <div class="container mb-5 mt-5">
        <div class="card card-body">
            <div class="d-flex flex-column align-center text-center">
                <h1>Nomor Antrian</h1>
                <strong class="h1" id="nomorAntrian">
                    <?php if (isset($getNumberAntrian)) {
                        echo $getNumberAntrian["nomor"];
                    } else {
                        echo "-";
                    }  ?>
                </strong>
                <?php if (isset($getNumberAntrian)) {
                ?>
                    <form action="sendAudio.php" id="formSendAudio" method="POST">
                        <input type="text" name="nomor_antrian" id="inputNomorAntrian" hidden value="<?= $getNumberAntrian["nomor"] ?>">
                        <button class="btn btn-primary" type="submit">Panggil</button>
                    </form>
                <?php
                } ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form id="getQueue" action="../config/getQueue.php" method="POST">
            <div class="form-group">
                <div class="d-grid">
                    <input type="hidden" name="get" value="get" id="">
                    <button class="btn btn-block btn-info" type="submit">nomor selanjutnya</button>
                </div>
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $('#getQueue').submit(function(event) {
            event.preventDefault();
            var urlpost = $("#getQueue").attr('action');
            $.ajax({
                url: urlpost,
                type: 'post',
                data: $('#getQueue').serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.hasil === true) {
                        toastr.success(data.msg);
                        $.ajax({
                            url: 'sendAudio.php',
                            type: 'post',
                            data: {
                                nomor_antrian: data.number
                            },
                            dataType: 'json',
                            success: function(data) {}
                        });
                        $('#nomorAntrian').removeAttr('hidden');
                        $('#inputNomorAntrian').val(data.number);
                        $('#nomorAntrian').text(data.number);
                        $('#nomorAntrian').attr('hidden');
                    } else
                    if (data.hasil === false) {
                        toastr.error(data.msg);
                    }
                }
            });
        });
    </script>
</body>

</html>