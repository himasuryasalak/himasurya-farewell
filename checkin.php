<?php
include 'koneksi.php';
$no_wa = base64_decode(strtr($_GET['data'], '-_-', '+/='));
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
mysqli_query($koneksi, "UPDATE rekap SET status='hadir' WHERE no_wa='$no_wa'")or die(mysqli_error($koneksi));
$data = mysqli_fetch_assoc($query);
$hasil = new stdClass();
$hasil->nama=$data['nama'];
$hasil->no_wa=$data['no_wa'];
$hasil->angkatan=$data['angkatan'];
$hasil->wisudawan=$data['wisudawan'];
echo json_encode($hasil);
