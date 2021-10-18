<?php
require 'vendor/autoload.php';
function qrcode($isiqr){
    include('php/phpqrcode/qrlib.php');
    $tempdir = "files/eticket/";
    $npm=strtr(base64_encode($isiqr), '+/=', '-_-');
    $path = $tempdir.$isiqr.'_0.png';
    $path1 = $tempdir.$isiqr.'.png';
    $template = 'files/template.png';
    $logopath="files/logo_QR.png";

    if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);
    // outputs image directly into browser, as PNG stream
    QRcode::png($npm, $path1, QR_ECLEVEL_H, 10,1);
     // ambil file qrcode
     
    //tempelbarcode($path1,$logopath,$path1,100,50,50);
    tempelbarcode($template,$path1,$path1,450,320,1270);

    
    $type = pathinfo($path1, PATHINFO_EXTENSION);
    $data = file_get_contents($path1);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    unlink($path1);

    return $base64;

}
function tempelbarcode($path0,$pathbarcode,$pathexport,$barcode_width,$posisi_x,$posisi_y){
    $QR = imagecreatefrompng($path0);

    // memulai menggambar logo dalam file qrcode
    $logo = imagecreatefromstring(file_get_contents($pathbarcode));
    
    imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
    imagealphablending($logo , false);
    imagesavealpha($logo , true);

    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);

    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    // Scale logo to fit in the QR Code
    $logo_qr_width = $barcode_width; //UBAH
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale;

    //UBAH
    imagecopyresampled($QR, $logo,$posisi_x,$posisi_y, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

    // Simpan kode QR lagi, dengan logo di atasnya
    imagepng($QR,$pathexport);
}