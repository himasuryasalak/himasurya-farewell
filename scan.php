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
<div class='container' style="text-align: center;">
<div id="reader"></div>
<br>
<button type="button" class='btn btn-secondary' id="btnmanual">Manual Check-In</button>
</div>
<script src="js/html5-qrcode.min.js?v=241021"></script>
<script src="library/sweetalert2/dist/sweetalert2.all.min.js"></script>
<?php include 'footer_script.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.1/howler.min.js"></script>
<script>
function onScanSuccess(decodedText, decodedResult) {
console.log(`Scan result: ${decodedText}`, decodedResult);
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
                    html5QrcodeScanner.resume()
            })
        }else{
            let datajson=JSON.parse(xhr.responseText);
            modalsukses(datajson)
        }
        
    }};

    xhr.send();
    
  }
})
html5QrcodeScanner.pause()
}
function onScanError(ErrMsg){
Swal.fire({
  icon: 'error',
  title: 'Oops..',
  html: ErrMsg,
})
}
const formatsToSupport = [
  Html5QrcodeSupportedFormats.QR_CODE,
  Html5QrcodeSupportedFormats.UPC_A,
  Html5QrcodeSupportedFormats.UPC_E,
  Html5QrcodeSupportedFormats.UPC_EAN_EXTENSION,
  Html5QrcodeSupportedFormats.CODE_128,
  Html5QrcodeSupportedFormats.EAN_13,
];
var html5QrcodeScanner = new Html5QrcodeScanner(
"reader", { 
    fps: 30, 
    qrbox: 250,
    formatsToSupport: formatsToSupport
});

function initialize(){
    html5QrcodeScanner.render(onScanSuccess);
}
initialize()

document.getElementById("btnmanual").addEventListener("click",function(){
    let no_wa;
    html5QrcodeScanner.clear();
    Swal.fire({
        title: 'Masukkan Nomor Whatsapp',
        text: 'Awali dengan 62. Contoh: 6281234567891',
        input: 'number',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Cek Data',
        showLoaderOnConfirm: true,
        backdrop: true,
        preConfirm: (login) => {
            no_wa = login
            let no_wa1 = no_wa.toString().substring(2);
            return fetch(`cekdata?data=${no_wa1}&mode=check_in`)
            .then(response => {
                if (!response.ok) {
                throw new Error(response.statusText)
                }
                return response.json()
            })
            .catch(error => {
                Swal.showValidationMessage(
                `${error}`
                )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            let btnconfirm = true
            let isimodal = "<h4>"+result.value.nama+"</h3><b>Himasurya "+result.value.angkatan+"</b>"
            if (result.value.jam_masuk!=''){
                btnconfirm = false
                isimodal+= "<br>Sudah masuk pada "+result.value.jam_masuk
            }else{
                isimodal+= "<br>Belum Check-In"
            }
            Swal.fire({
            title: 'Data Ditemukan',
            html: isimodal,
            showCancelButton: true,
            showConfirmButton: btnconfirm,
            confirmButtonText: 'Check-In',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(`checkin?data=${no_wa}&mode=manual`)
                .then(response => {
                    if (!response.ok) {
                    throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                    `Tidak Ditemukan`
                    )
                })
            },
            }).then((result) => {
            if (result.isConfirmed) {
                modalsukses(result.value)
            }else{initialize()}
            })
        }else{initialize()}
    })
})
function modalsukses(datajson){
    var sound = new Howl({
    src: ['sound/success.mp3'],
    volume: 1.0,
    });
    sound.play()
    let isimodal = '<b>'+datajson.nama+'</b><br>Himasurya '+datajson.angkatan;
    if (datajson.wisudawan=='ya'){
        isimodal+='<br>Wisudawan';
    }
    isimodal+='<br>'+datajson.jam_masuk;
    judulmodal = "Selamat Datang"
    if (datajson.status!='success'){
        judulmodal = "Sudah Masuk"
    }
    Swal.fire({
        icon: 'success',
        title: judulmodal,
        html: isimodal,
        }).then((result) => {
            html5QrcodeScanner.resume()
    })
}
</script>
</body>
</html>