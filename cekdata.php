<?php
include 'koneksi.php';
include 'qrcode2.php';

$no_wa='62'.$_GET['data'];
$query = mysqli_query($koneksi,"SELECT * FROM rekap WHERE no_wa='$no_wa'");
$row = mysqli_num_rows($query);
$obj = new stdClass();
if ($row === 1){
    $data = mysqli_fetch_assoc($query);
    $obj->status = "found";
    $obj->nama = $data['nama'];
    $obj->angkatan = $data['angkatan'];
    $obj->wisudawan = $data['wisudawan'];
    $obj->data=qrcode($no_wa);
}else{
    $obj->status = "not_found";
}
echo json_encode($obj);