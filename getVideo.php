<?php
include_once "config.php";
if (isset($_POST['getVideo'])) {
    $getData = mysqli_query($konek, "SELECT * FROM video_monitoring where visible = 1 LIMIT 1");
    if (mysqli_num_rows($getData) > 0) {
        $dataVideo = mysqli_fetch_assoc($getData);
        $data["video_src"] = $dataVideo["src"];
    }
    $data['jml_video'] = mysqli_num_rows($getData);
    echo json_encode($data);
}
