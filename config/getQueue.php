<?php
session_start();
include_once "../config.php";
if (isset($_POST['get'])) {
    $uid = $_SESSION['UID'];
    $UserData = mysqli_query($konek, "SELECT * FROM users WHERE id = $uid");
    $getUserData = mysqli_fetch_assoc($UserData);
    $loketid = $getUserData['loket_id'];
    $LoketData = mysqli_query($konek, "SELECT * FROM `lokets` WHERE `id` = $loketid");

    $getData = mysqli_fetch_assoc($LoketData);
    $toLoket = $getData['aliases'];

    // validasi
    $isExist = mysqli_query($konek, "SELECT * FROM antrian WHERE loket_id = '$toLoket' AND is_done = 0 ORDER BY created_at ASC LIMIT 1");
    if (mysqli_num_rows($isExist) > 0) {
        $existQueue = mysqli_fetch_assoc($isExist);
        $existQueueId = $existQueue["id"];
        $updateexistAntrian = mysqli_query($konek, "UPDATE `antrian` SET `is_done` = '1' WHERE `antrian`.`id` = $existQueueId");
    }
    $getQueue = mysqli_query($konek, "SELECT * FROM antrian WHERE loket_id IS NULL AND is_done = 0 ORDER BY created_at ASC LIMIT 1");
    if (mysqli_num_rows($getQueue) > 0) {
        $DataQueue = mysqli_fetch_assoc($getQueue);
        $queueId = $DataQueue["id"];

        $datum = new DateTime();
        $startTime = $datum->format('Y-m-d H:i:s');
        $updateAntrian = mysqli_query($konek, "UPDATE antrian SET `loket_id` = '$toLoket', `call_at` = '$startTime' WHERE id = $queueId");

        if ($updateAntrian) {
            echo json_encode([
                "hasil" => true,
                'msg' => "berhasil",
                'number' => $DataQueue["nomor"]
            ]);
        } else {
            echo json_encode([
                "hasil" => false,
                'msg' => "error"
            ]);
        }
    } else {
        echo json_encode([
            "hasil" => false,
            'msg' => "belum ada nomor antrian baru"
        ]);
    }
} else {
    echo json_encode([
        "hasil" => false,
        'msg' => "Not Valid!"
    ]);
}
