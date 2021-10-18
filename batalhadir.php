<?php
include 'koneksi.php';

$no_wa = "62".$_GET['data'];
try {
    mysqli_query($koneksi,"DELETE FROM rekap WHERE no_wa='$no_wa'");
    echo "done";
}catch (Exception $e) {
    echo $e->getMessage();
}