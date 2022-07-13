<?php

include_once "config.php";

if (isset($_POST['panggil'])) {
    $getPanggil = mysqli_query($konek, "SELECT * FROM panggil");

    $fecth = mysqli_fetch_assoc($getPanggil);

    echo json_encode([
        "jumlah_panggil" => mysqli_num_rows($getPanggil),
        "get" => $fecth
    ]);
}



if (isset($_POST['stop'])) {
    // $idStop = $_POST['idStop'];
    $getPanggil = mysqli_query($konek, "DELETE FROM `panggil`");
    echo json_encode([
        // "id" => $idStop,
        "msg" => ""
    ]);
}
