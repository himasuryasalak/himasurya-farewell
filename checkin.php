<?php
include 'koneksi.php';

$no_wa = $_GET['data'];
if($_GET['mode']!='manual') $no_wa = base64_decode(strtr($_GET['data'], '-_-', '+/='));

$query = mysqli_query($koneksi, "SELECT * from rekap WHERE no_wa='$no_wa'");
$cek = mysqli_num_rows($query);
if ($cek ===0){
    //$tabel = 'panitia';
    //$query = mysqli_query($koneksi, "SELECT * from $tabel WHERE no_wa='$no_wa'");
    //$cek = mysqli_num_rows($query);
    if ($cek ===0){
        echo "not_found";
        exit();
    }
}
$data = mysqli_fetch_assoc($query);

$hasil = new stdClass();
if ($data['jam_masuk']==''){
    $jam_masuk = date('H:i:s');
    mysqli_query($koneksi, "UPDATE rekap SET status='hadir', jam_masuk='$jam_masuk' WHERE no_wa='$no_wa'")or die(mysqli_error($koneksi));
    $hasil->status="success";
    $hasil->jam_masuk=$jam_masuk;
}else{
    $hasil->status="double";
    $hasil->jam_masuk=$data['jam_masuk'];
}
$hasil->nama=$data['nama'];
$hasil->no_wa=$data['no_wa'];
$hasil->angkatan=$data['angkatan'];
$hasil->wisudawan=$data['wisudawan'];

echo json_encode($hasil);
