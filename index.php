<?php
include 'header.php';
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a,%h,%i,%s');
}
$timezone = new DateTimeZone('Asia/Jakarta');
$date = new DateTime('now',$timezone);
$date2 = new DateTime('2021-10-24 12:00:00',$timezone);
$diff = $date2->getTimestamp() - $date->getTimestamp();
$hasil = explode(",",gmdate("j,H,i,s"),$diff);

$hari = $hasil[0];
$jam = $hasil[1];
$menit = $hasil[2];
$detik = $hasil[2];
?>

<div class="container sm" style="text-align: -webkit-center;;">
<div class="row main">
    <div class="col-md-6" id="cover">
        <div id="header">
            <h1 style="text-align:center;font-family: 'Poppins', sans-serif;">Farewell 2021</h1>
            <h3 style="text-align:center">Catre El infinito</h3>
        </div>
        <div id="detail-acara">
            <div class="row">
                <div class="col-auto"><i class="fas fa-calendar-alt"></i></div>
                <div class="col-auto"><b>Sabtu, 30 Oktober 2021</b></div>
            </div>
            <div class="row">
                <div class="col-auto"><i class="fas fa-clock"></i></div>
                <div class="col-auto"><b>Open Gate : 15.00-15.30 WIB</b></div>
            </div>
            <a href="https://g.page/babehstreet" target="_BLANK" style="text-decoration: none;color:white;">
            <div class="row">
                <div class="col-auto"><i class="fas fa-map-marked-alt"></i></div>
                <div class="col-auto"><b>Babeh St.</b><br>Jl. Slamet No.6, Ketabang, Kec. Genteng, Kota SBY, Jawa Timur 60272</div>
            </div>
            </a>
            <div class="tombol" style="text-align: center;margin:30px 0">
            <a href="#registrasi"><button type="button" class="btn btn-lg btn-primary">Registrasi</button></a>
        </div>
    </div>
    
    </div>
    <div class="col-md-6">
    <div id='registrasi'>
        <h5>Batas Waktu Registrasi</h5>
        <div class="row countdown row-cols-4" style="max-width: 400px;">
            <div class="col-sm-3">
                <span id='hari'>08</span><b>Hari</b>       
            </div>
            <div class="col-sm-3">
                <span id='jam'>08</span><b>Jam</b>      
            </div>
            <div class="col-sm-3">
                <span id='menit'>08</span><b>Menit</b>       
            </div>
            <div class="col-sm-3">
                <span id='detik'>08</span><b>Detik</b>     
            </div>
        </div>
    </div>
        <div id="form-register">
        <h4><?php if ($diff>0) echo "REGISTRASI"; else echo "CEK E-TICKET" ?></h4><br>
            <form id='form1' class='needs-validation' novalidate>
                <h6>Nomor <i>Whatsapp</i></h6>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    </div>
                    <input type="number" max="99999999999999" min="99999" id='wa' class="form-control" placeholder="81234567891" aria-label="Username" aria-describedby="basic-addon1" required aria-required="true">
                </div>
                <div style="text-align: center;">
                    <button type="submit" id="btnsubmit1" class="btn btn-primary"><b>Next</b></button>
                </div>
            </form>
            <form id='form2' style="display: none;">
                <span><h6>Nama Lengkap</h6></span>
                <input id="nama" type="text" class="form-control" placeholder="Contoh : Kirni Ilyis" required aria-required="true"><br>
                <div class="row">
                    <div class="col-sm-3">
                        <h6>Angkatan</h6>
                        <input id="angkatan" type="number" max="2021" class="form-control" placeholder="2017" required aria-required="true">
                        <br>
                    </div>
                    <div id="wisudawan18" class="col-sm-9" style="display: none;">
                    <h6>Apakah kamu wisudawan tahun ini?</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name='wisudawan' type="radio" id="wisudawan_ya" value="ya">
                        <label class="form-check-label" for="wisudawan_ya">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name='wisudawan' type="radio" id="wisudawan_tidak" value="tidak">
                        <label class="form-check-label" for="wisudawan_tidak">Tidak</label>
                    </div>
                    </div>
                </div>
                <div id="footer-button" style="text-align: center;">
                    <button type="button" id="btncancel" class="btn btn-secondary">Batalkan Kehadiran</button>
                    <button type="button" id="btnlihat" class="btn btn-success">Lihat E-Ticket</button>
                    <button type="button" id="btndownload" class="btn btn-primary"><b>Download E-Ticket</b></button>
                    <button type="submit" id="btnsubmit2" class="btn btn-primary"><b>Submit</b></button>
                </div>
            </form>
        </div>


    </div>
  </div>

  <br>

</div>
<?php include 'footer_script.php'?>
<script>
let data_base64
(function() {
  'use strict';
  let divopsi = document.getElementById("wisudawan18");
  <?php if ($diff > 0){ ?>
Swal.fire({
    icon:"info",
    title: "Registrasi Diperpanjang!!!",
    html: "Batas waktu registrasi diperpanjang sampai<br><b>Minggu, 24 Oktober 2021 Pukul 12:00 WIB</b><br><br>Yuk segera daftarkan dirimu. Kemeriahan Farewell Party Himasurya menantimu!!!"
})
<?php } ?>
  let mode = "new";
    function show_opsi(){
        divopsi.style.display = 'inline'
        document.getElementById("wisudawan_ya").checked = false
        document.getElementById("wisudawan_tidak").checked = false
    }
    function hide_opsi(){
        divopsi.style.display = 'none'
        document.getElementById("wisudawan_tidak").checked = true;
    }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    document.getElementById("angkatan").addEventListener("keyup",function(){
        if(this.value == '2018'){
            show_opsi();
        }else{
            hide_opsi();
        }
    })
  window.addEventListener('load', function() {
      
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var form1 = document.getElementById('form1');
    var form2 = document.getElementById('form2');
      form1.addEventListener('submit', function(event) {
        if (form1.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }else{
            let wa = document.getElementById("wa").value
            event.preventDefault();
            Swal.fire({
                title: 'Memproses',
                html: 'Sedang mencari data',
                allowOutsideClick:false,
                didOpen: () => {
                    Swal.showLoading();
                    var url = "cekdata.php?data="+wa;
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", url);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            console.log(xhr.responseText)
                            let data = JSON.parse(xhr.responseText);
                            if (data.status=="found"){
                                document.getElementById('btnsubmit2').style.display = 'none';
                                document.getElementById("nama").value = data.nama;
                                document.getElementById("angkatan").value = data.angkatan;
                                document.getElementById("wisudawan_"+data.wisudawan).checked = true

                                document.getElementById('btnsubmit2').disabled = true;
                                document.getElementById("nama").disabled = true;
                                document.getElementById("angkatan").disabled = true;
                                document.getElementById("wisudawan_ya").disabled = true;
                                document.getElementById("wisudawan_tidak").disabled = true;
                                data_base64 = data.data;
                                mode = "edit";
                                if (data.angkatan=='2018'){
                                    divopsi.style.display = "inline";
                                }else{
                                    divopsi.style.display = "none";
                                }
                            <?php if ($diff > 0){ ?>
                            }else{
                                mode = "new";
                                document.getElementById('btncancel').style.display = 'none';
                                document.getElementById('btndownload').style.display = 'none';
                                document.getElementById('btnlihat').style.display = 'none';
                                
                            }
                            document.getElementById("btnsubmit1").style.display='none'
                            document.getElementById("form2").style.display='block'
                            document.getElementById("wa").disabled = true
                            swal.close();
                            <?php } else{ ?>
                                document.getElementById("btnsubmit1").style.display='none'
                                document.getElementById("form2").style.display='block'
                                document.getElementById("wa").disabled = true
                                swal.close();
                            }else{
                                swal.fire({
                                    icon: 'error',
                                    title: 'Tidak ditemukan',
                                    html: 'Nomor whatsapp tidak terdaftar',
                                    confirmButtonColor: '#2273ca',
                                })
                            }
                            <?php } ?>
                        }
                    }
                    xhr.send();
                }
            })
        }
        form1.classList.add('was-validated');
      }, false);
      form2.addEventListener("submit",function(event){
        event.preventDefault();
        if (form1.checkValidity() === false || document.querySelector('input[name="wisudawan"]:checked')==undefined) {        
          event.stopPropagation();
        }else{
            let wa = "+62 "+document.getElementById("wa").value
            let wa_encoded = "62"+document.getElementById("wa").value
            let nama = document.getElementById("nama").value
            let angkatan = document.getElementById("angkatan").value
            let wisudawan = document.querySelector('input[name="wisudawan"]:checked').value
            Swal.fire({
                title: 'Yakin udah bener?',
                html: `
                <table class='table-borderless tabel-tipis'>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><b>${nama}</b></td>
                    </tr>
                    <tr>
                        <td>No.Whatsapp</td>
                        <td>:</td>
                        <td><b>${wa}</b></td>
                    </tr>
                    <tr>
                        <td>Angkatan</td>
                        <td>:</td>
                        <td><b>${angkatan}</b></td>
                    </tr>
                    <tr>
                        <td>Wisudawan</td>
                        <td>:</td>
                        <td><b>${wisudawan}</b></td>
                    </tr>
                </table>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2273ca',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke, lanjutkan',
                cancelButtonText: 'Salah, sek',
                reverseButtons: true,
                allowOutsideClick:false,
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: 'Memproses',
                    html: 'Mohon tunggu sedilut, gak sampe 3 tahun kok',
                    allowOutsideClick:false,
                    didOpen: () => {
                        Swal.showLoading();
                        var url = "submit_data.php";
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", url);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        var data = "nama="+nama+"&angkatan="+angkatan+"&wisudawan="+wisudawan+"&no_wa="+wa_encoded;
                        xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            let data_encoded=JSON.parse(xhr.responseText);
                            if (data_encoded.status=='success'){
                                downloadfile(data_encoded.data);
                                data_base64 = data_encoded.data
                                swal.fire({
                                    icon: 'success',
                                    title:"Horeee..",
                                    html:`Kamu berhasil terdaftar, <b>E-Ticket</b> otomatis akan terunduh sesaat lagi. <b>Tunjukkan E-Ticket tersebut saat masuk ke venue</b>, jadi jangan dihapus ya mas mbak. 
                                    <br><br>
                                    <button type="button" onclick='javascript:lihatEticket()' class="btn btn-success">Lihat E-Ticket</button>&nbsp;<button type="button" onclick='javascript:window.location.reload()' class="btn btn-primary"><b>Oke</b></button><br>`,
                                    footer: "<a href='' style='text-align: center;' onclick='javascript:downloadEticket()'>Klik disini jika E-Ticket belum terunduh / terdownload</a>",
                                    showConfirmButton: false,
                                    allowOutsideClick:false,
                                })
                            }
                        }};

                        xhr.send(data);
                    }
                })
                }
            })
        }
        form1.classList.add('was-validated');
      })
      
  }, false);
  
  document.getElementById("btndownload").addEventListener("click",function(){
    downloadEticket()
  })
  document.getElementById("btnlihat").addEventListener("click",function(){
    lihatEticket()
  })
  document.getElementById("btncancel").addEventListener("click",function(){
    batalhadir()
  })
})();
function submitData(ini){
      console.log(ini)
  }
function batalhadir(){
    Swal.fire({
        title: "Yahh, yakin nih??",
        html: "Apakah kamu yakin gajadi dateng Farewell 2021??",
        confirmButtonText: "Yakin",
        cancelmButtonText: "Batal",
        confirmButtonColor: '#d35757',
        showCancelButton:true,
        icon: "question",
    }).then((result)=>{
        if(result.isConfirmed){
            Swal.fire({
            title: 'Memprose Pembatalan...',
            html: 'Sek rek, dilut...',
            allowOutsideClick:false,
            didOpen: () => {
                Swal.showLoading();

                let no_wa = document.getElementById("wa").value;
                let xhr = new XMLHttpRequest();
                xhr.open("GET",'batalhadir?data='+no_wa);
                xhr.onreadystatechange = function(){
                    if (xhr.readyState === 4){
                        if(xhr.responseText==='done'){
                            swal.fire({
                                icon: 'success',
                                title:"Oke, sudah...",
                                html:`Pembatalan kehadiran berhasil diproses
                                <br><br>
                                <button type="button" onclick='javascript:window.location.reload()' class="btn btn-primary"><b>Oke</b></button>`,
                                showConfirmButton: false,
                                allowOutsideClick:false,
                            })
                        }else{
                            swal.fire({
                                icon: 'error',
                                title:"Oops...Terjadi kesalahan",
                                html:xhr.responseText,
                                allowOutsideClick:false,
                            })
                        }
                    }
                }
                xhr.send();
            }
        })
        }
    })
}
function downloadEticket(){
    Swal.fire({
        title: 'Mengunduh...',
        html: 'Sek rek, sek digolekno',
        allowOutsideClick:false,
        didOpen: () => {
            Swal.showLoading();
            downloadfile(data_base64);
            swal.fire({
                icon: 'success',
                title:"Oke, sudah...",
                html:`<b>E-Ticket</b> otomatis akan terunduh sesaat lagi. <b>Tunjukkan E-Ticket tersebut saat masuk ke venue</b>, jadi jangan dihapus ya mas mbak. 
                <br><br>
                <button type="button" onclick='javascript:window.location.reload()' class="btn btn-primary"><b>Oke</b></button>`,
                footer: "<a href='#' style='text-align: center;' onclick='javascript:downloadEticket()'>Klik disini jika E-Ticket belum terunduh / terdownload</a>",
                showConfirmButton: false,
                allowOutsideClick:false,
            })
        }
    })
  }
function lihatEticket(){
    var image = new Image();
    image.src = data_base64;

    var w = window.open("");
    w.document.write(image.outerHTML);
}
function downloadfile(base64) {
    const linkSource = `${base64}`;
    const downloadLink = document.createElement("a");
    const fileName = "E-Ticket Farewell 2021.png";

    downloadLink.href = linkSource;
    downloadLink.download = fileName;
    downloadLink.click();
}
</script>
<script>
var distance = <?php echo $diff ?>;

var x = setInterval(function() {
    distance--
  // Time calculations for days, hours, minutes and seconds
  document.getElementById("hari").innerHTML = ("0"+Math.floor(distance / (60 * 60 * 24))).slice(-2);
  document.getElementById("jam").innerHTML = ("0"+Math.floor((distance % (60 * 60 * 24)) / (60 * 60))).slice(-2);
  document.getElementById("menit").innerHTML = ("0"+Math.floor((distance % (60 * 60)) / (60))).slice(-2);
  document.getElementById("detik").innerHTML = ("0"+Math.floor(distance % (60))).slice(-2);

  // Display the result in the element with id="demo"
  //document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
  }
}, 1000);
if (distance < 0) {
    clearInterval(x);
    distance=0;
}
    document.getElementById("hari").innerHTML = ("0"+Math.floor(distance / (60 * 60 * 24))).slice(-2);
  document.getElementById("jam").innerHTML = ("0"+Math.floor((distance % (60 * 60 * 24)) / (60 * 60))).slice(-2);
  document.getElementById("menit").innerHTML = ("0"+Math.floor((distance % (60 * 60)) / (60))).slice(-2);
  document.getElementById("detik").innerHTML = ("0"+Math.floor(distance % (60))).slice(-2);
// Update the count down every 1 second

</script>
  </body>
</html>
