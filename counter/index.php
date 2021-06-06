<?php
session_start();
include_once "../config.php";
// include_once "../config/cekUser.php";
$loketId = $_SESSION['UID'];
$QgetNumberAntrian = mysqli_query($konek, "SELECT * FROM antrian WHERE loket_id = '$loketId' AND is_done = 0 ORDER BY created_at ASC LIMIT 1");
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
    <a href="../logout.php">keluar</a>
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
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form id="getQueue" action="../config/getQueue.php" method="POST">
            <div class="form-group">
                <div class="d-grid">
                    <input type="hidden" name="get" value="get" id="">
                    <button class="btn btn-block btn-primary" type="submit">nomor selanjutnya</button>
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
                        $('#nomorAntrian').text(data.number);
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