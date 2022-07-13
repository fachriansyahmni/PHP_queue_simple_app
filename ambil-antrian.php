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
    <title>Ambil Nomor Antrian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex flex-column text-center justify-content-center">
                    <h2>Nomor Antrian Anda</h2>
                    <strong id="numberQueue" style="font-size: 120pt; font-weight: 700;"><?= $cfgAntrian['current_queue']  ?></strong>
                </div>
            </div>
            <div class="card-body">
                <button id="getNumberBtn" class="btn btn-lg btn-outline-info btn-block w-100" type="button" onclick="update()">Ambil Nomor Antrian</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        var component = $('#numberQueue');

        function update() {
            $('#getNumberBtn').prop('disabled', true);
            $('#getNumberBtn').text("waiting...");
            takeQueue();
        }

        function takeQueue() {
            $.ajax({
                url: 'config/takeQueue.php',
                type: 'post',
                data: {
                    get: "get"
                },
                dataType: 'json',
                success: function(data) {
                    if (data.hasil === true) {
                        setTimeout(function() {
                            $('#getNumberBtn').text("Ambil Nomor Antrian");
                            $('#getNumberBtn').prop('disabled', false);

                            toastr.success(data.msg);
                            var getNumber = parseInt(component.text());
                            component.text(data.number);
                            $('#numberQueue').css('color', 'red');
                        }, 1000);
                        setTimeout(function() {
                            $('#numberQueue').css('color', 'black');
                        }, 3000);
                    } else
                    if (data.hasil === false) {
                        toastr.error(data.msg);
                    }
                }
            });
        }
    </script>
</body>

</html>