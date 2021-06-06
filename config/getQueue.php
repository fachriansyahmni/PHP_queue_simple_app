<?php
session_start();
include_once "../config.php";
if (isset($_POST['get'])) {
    $loketId = $_SESSION['UID'];


    // validasi
    $isExist = mysqli_query($konek, "SELECT * FROM antrian WHERE loket_id = '$loketId' AND is_done = 0 ORDER BY created_at ASC LIMIT 1");
    if (mysqli_num_rows($isExist) > 0) {
        $existQueue = mysqli_fetch_assoc($isExist);
        $existQueueId = $existQueue["id"];
        $updateexistAntrian = mysqli_query($konek, "UPDATE `antrian` SET `is_done` = '1' WHERE `antrian`.`id` = $existQueueId");
        // var_dump($updateexistAntrian);
        // die;
    }
    $getQueue = mysqli_query($konek, "SELECT * FROM antrian WHERE loket_id IS NULL AND is_done = 0 ORDER BY created_at ASC LIMIT 1");
    if (mysqli_num_rows($getQueue) > 0) {
        $DataQueue = mysqli_fetch_assoc($getQueue);
        $queueId = $DataQueue["id"];

        $datum = new DateTime();
        $startTime = $datum->format('Y-m-d H:i:s');
        $updateAntrian = mysqli_query($konek, "UPDATE antrian SET `loket_id` = '$loketId', `call_at` = '$startTime' WHERE id = $queueId");

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
