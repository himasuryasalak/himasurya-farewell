<?php
include 'koneksi.php';
include 'qrcode2.php';
$nama = $_POST['nama'];
$angkatan = $_POST['angkatan'];
$wisudawan = $_POST['wisudawan'];
$no_wa = $_POST['no_wa'];
$now = DateTime::createFromFormat('U.u', microtime(true));
$tanggal = $now->format("y-m-d H:i:s.u");

try {
    mysqli_query($koneksi,"insert into rekap values (NULL,'$tanggal','$nama','$angkatan','$wisudawan','$no_wa','','terdaftar')");
    $obj = new stdClass();
    $obj->status="success";
    $obj->data=qrcode($no_wa);
    echo json_encode($obj);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}
