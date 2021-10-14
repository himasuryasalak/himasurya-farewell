<?php
include 'koneksi.php';
include 'qrcode2.php';
$nama = $_POST['nama'];
$angkatan = $_POST['angkatan'];
$wisudawan = $_POST['wisudawan'];
$no_wa = $_POST['no_wa'];
try {
    mysqli_query($koneksi,"insert into rekap values (NULL,'$nama','$angkatan','$wisudawan','$no_wa','','terdaftar')");
    $obj = new stdClass();
    $obj->status="success";
    $obj->data=qrcode($no_wa);
    echo json_encode($obj);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
