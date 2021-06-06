<?php
include_once "../config.php";
function errorMsg()
{
    return json_encode([
        "hasil" => false,
        'msg' => "Not Valid!"
    ]);
}


if (isset($_POST['get'])) {

    $_getConfigAntrian = mysqli_query($konek, "SELECT * FROM config_antrian ORDER BY id DESC LIMIT 1");
    if (mysqli_num_rows($_getConfigAntrian) > 0) {
        $ConfigAntrian = mysqli_fetch_assoc($_getConfigAntrian);
        $idConfig = $ConfigAntrian['id'];
        $lastNumber = $ConfigAntrian['current_queue'];
        $newNumber = $ConfigAntrian['current_queue'] + 1;

        $updateConfig = mysqli_query($konek, "UPDATE `config_antrian` SET `current_queue` = '$newNumber', `last_queue` = '$lastNumber' WHERE `config_antrian`.`id` = $idConfig;");
        if ($updateConfig) {
            $datum = new DateTime();
            $startTime = $datum->format('Y-m-d H:i:s');
            $hash = bin2hex(random_bytes(6));

            $insetToAntrian = mysqli_query($konek, "INSERT INTO antrian (uniqueid, nomor, loket_id, is_done, call_at,created_at) 
            VALUES ('$hash', '$newNumber', NULL, '0', NULL,'$startTime')");

            if ($insetToAntrian) {
                echo json_encode([
                    "hasil" => true,
                    'msg' => "Berhasil",
                    'number' => $newNumber
                ]);
            } else {
                errorMsg();
            }
        } else {
            errorMsg();
        }
    } else {
        errorMsg();
    }
} else {
    errorMsg();
}
