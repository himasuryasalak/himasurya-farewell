<?php
function qrcode($isiqr){
    include('php/phpqrcode/qrlib.php');
    $tempdir = "temp/";
    $npm=strtr(base64_encode($isiqr), '+/=', '-_-');
    $path = $tempdir.$npm.'.png';
    $logopath="https://cdn.pixabay.com/photo/2018/05/08/18/25/facebook-3383596_960_720.png";

    if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);
    // outputs image directly into browser, as PNG stream
    QRcode::png($npm, $path, QR_ECLEVEL_H, 10,2);
     // ambil file qrcode
     
    $QR = imagecreatefrompng($path);

    // memulai menggambar logo dalam file qrcode
    $logo = imagecreatefromstring(file_get_contents($logopath));
    
    imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
    imagealphablending($logo , false);
    imagesavealpha($logo , true);

    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);

    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    // Scale logo to fit in the QR Code
    $logo_qr_width = $QR_width/4;
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale;

    imagecopyresampled($QR, $logo, $QR_width/2.5, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

    // Simpan kode QR lagi, dengan logo di atasnya
    imagepng($QR,$path);
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    unlink($path);

    return $base64;
}
 //echo '<img src="'.$base64.'" />';

 //echo strtr(base64_encode($_GET['data']), '+/=', '-_-');
 //echo base64_decode(strtr($_GET['data'], '-_-', '+/='));
