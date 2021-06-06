<?php
session_start();
include_once "../config.php";
if (isset($_POST['resetQueue']) && isset($_POST['antrian_ke'])) {
    $resetTo = htmlspecialchars($_POST['antrian_ke'], ENT_QUOTES);
    if ($resetTo >= 0) {
        $_getConfigAntrian = mysqli_query($konek, "SELECT * FROM config_antrian ORDER BY id DESC LIMIT 1");
        if (mysqli_num_rows($_getConfigAntrian) > 0) {
            $ConfigAntrian = mysqli_fetch_assoc($_getConfigAntrian);
            $last_queue = $ConfigAntrian['current_queue'];
            $reset = mysqli_query($konek, "UPDATE config_antrian SET  current_queue = '$resetTo', last_queue = '$last_queue' ORDER BY id DESC LIMIT 1");
        }
    }
}
header("location:" . $_SERVER['HTTP_REFERER']);
