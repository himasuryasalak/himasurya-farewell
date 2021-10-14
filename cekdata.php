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
    $obj->jam_masuk = $data['jam_masuk'];
    if ($_GET['mode']!='check_in'){
        $obj->data=qrcode($no_wa);
    }
}else{
    $obj->status = "not_found";
    if ($_GET['mode']=='check_in'){
        http_response_code(404);
    }
}
echo json_encode($obj);