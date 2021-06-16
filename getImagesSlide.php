<?php
include_once "config.php";
if (isset($_POST['getImagesSlide'])) {
    $getData = mysqli_query($konek, "SELECT * FROM slide_images where visible = 1 ORDER BY position ASC");
    $i = 1;
    while ($dataImg = mysqli_fetch_assoc($getData)) {
        $data["img_src"][$i] = $dataImg["src"]; // inisial setiap loket
        $i++;
    }
    $data['jml_img'] = mysqli_num_rows($getData);
    echo json_encode($data);
}
