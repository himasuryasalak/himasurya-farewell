<?php 
include 'koneksi.php';
include 'header.php';
try {
    $session = SessionManager::getCurrentSession();
} catch (Exception $exception) {
    header('Location: /');
    exit(0);
}
?>
<br>
<div id="reader"></div>
<script src="js/html5-qrcode.min.js"></script>
<script src="library/sweetalert2/dist/sweetalert2.all.min.js"></script>
<?php include 'footer_script.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.1/howler.min.js"></script>
<script>
function onScanSuccess(decodedText, decodedResult) {
console.log(`Scan result: ${decodedText}`, decodedResult);
html5QrcodeScanner.clear();
Swal.fire({
  title: 'Memproses',
  html: 'Mohon tunggu',
  allowOutsideClick:false,
  didOpen: () => {
    Swal.showLoading()
    var url = "checkin.php?data="+decodedText;

    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);

    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
        console.log(xhr.status);
        console.log(xhr.responseText);
        if (xhr.responseText=="not_found"){
            var sound = new Howl({
                src: ['sound/error.mp3'],
                volume: 1.0,
            });
            sound.play()
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                html: 'Data tidak ditemukan',
                }).then((result) => {
                if (result.isConfirmed) {
                    html5QrcodeScanner.render(onScanSuccess);
                }
            })
        }else{
            let datajson=JSON.parse(xhr.responseText);
            var sound = new Howl({
            src: ['sound/success.mp3'],
            volume: 1.0,
            });
            sound.play()
            let isimodal = '<b>'+datajson.nama+'</b><br>Himasurya '+datajson.angkatan;
            if (datajson.wisudawan=='ya'){
                isimodal+='<br>Wisudawan';
            }
            Swal.fire({
                icon: 'success',
                title: 'Selamat Datang',
                html: isimodal,
                }).then((result) => {
                if (result.isConfirmed) {
                    html5QrcodeScanner.render(onScanSuccess);
                }
            })
        }
        
    }};

    xhr.send();
    
  }
})

}
function onScanError(ErrMsg){
Swal.fire({
  icon: 'error',
  title: 'Oops..',
  html: ErrMsg,
})
}

var html5QrcodeScanner = new Html5QrcodeScanner(
"reader", { fps: 10, qrbox: 250 });

function initialize(){
    html5QrcodeScanner.render(onScanSuccess);
}
initialize()
</script>
</body>
</html>