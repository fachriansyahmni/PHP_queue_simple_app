<?php

include_once "config.php";
if (isset($_POST['getlokets'])) {

    $getLokets = mysqli_query($konek, "SELECT * FROM lokets");
    while ($loket = mysqli_fetch_assoc($getLokets)) {

        $rstl = mysqli_query($konek, 'SELECT * FROM antrian WHERE loket_id = ' . $loket['aliases'] . ' AND is_done = 0 ORDER BY created_at ASC LIMIT 1');
        if (mysqli_num_rows($rstl) > 0) {
            $row = mysqli_fetch_assoc($rstl);
            if ($row['id'] == null) {
                $id = 0;
            } else {
                $id = $row['nomor'];
            }
        } else {
            $id = "-";
        }
        $data["urut"][$loket['aliases']] = $id; // inisial setiap loket
    }
    $data['jml_loket'] = mysqli_num_rows($getLokets);
    echo json_encode($data);
}
