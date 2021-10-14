<?php
include 'qrcode.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <base target="_top">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	    <style>
		html {
    display: table;
    margin: auto;
}

body {
    padding: 20px;
    display: table-cell;
	}

	th, td {
    padding: 3px;
	text-align: left; 
    vertical-align: top;	
	}
 .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 150px;
}
</style>
  </head>
  <body>
  <div style="font-size:120%">
  <div align="center"><h1>YOU ARE INVITED!!!</h1></div>
  <br>
  <br>
Halo, <br>
Kamu sudah terdaftar untuk menghadiri acara <b>Farewell Himasurya 2020</b> yang akan dilaksanakan pada : <br>
<table style="margin-top:10px;margin-bottom:10px">
<tr>
	<td>Hari, tanggal</td>
	<td>:</td>
	<td><b>Rabu, 14 Oktober 2020</b></td>
</tr>
<tr>
	<td>Jam</td>
	<td>:</td>
	<td><b>18.00 WIB sampe corona ilang</b></td>
</tr>
<tr>
	<td>Tempat</td>
	<td>:</td>
	<td ><a href="https://goo.gl/maps/LVQjrAcfsCW2aiib7" target="_blank" style="color:black;text-decoration: none"><b>BOBER Cafe</b><img src="https://cdn.iconscout.com/icon/free/png-512/google-maps-3-569475.png" alt="rumah" width="20" height="20"><br>
        Jl. Raya Jemursari No.70<br>Jemur Wonosari, Kec. Wonocolo<br>Surabaya</a></td>
</tr>
</table>
Tunjukkan <i>QR Code</i> dibawah ini atau <i>E-ticket</i> yang terlampir pada <i>email</i> ini kepada panitia saat menghadiri acara sebagai tanda kehadiran. Ojok lali teko lho rek...
<br>
<br>
<div align="center">
<img id="qrcode" alt="QR Code" style="border:5px solid black" class="center" src="<?php echo qrcode('2301190198');?>">
</div>
</div>
<script>
</script>
  </body>
</html>
