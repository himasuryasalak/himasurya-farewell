<?php
include 'header.php';
?>
<div class="container sm">
<h1 style="text-align:center;font-family:Lobster">Himasurya Farewell 2020</h1>
  <h3 style="text-align:center">RSVP</h3>
  <br>
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
    <div style="text-align: center;">
        <button type="button" id="btncancel" class="btn btn-secondary">Batalkan Kehadiran</button>
        <button type="button" id="btndownload" class="btn btn-primary"><b>Download E-Ticket</b</button>
        <button type="submit" id="btnsubmit2" class="btn btn-primary"><b>Submit</b></button>
    </div>
  </form>

</div>
<?php include 'footer_script.php'?>
<script>
let data_base64
(function() {
  'use strict';
  let divopsi = document.getElementById("wisudawan18");
  
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
                html: 'Sedang mencari <span class="coret"><i>pacar<i></span> data',
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
                            }else{
                                mode = "new";
                                document.getElementById('btncancel').style.display = 'none';
                                document.getElementById('btndownload').style.display = 'none';
                            }
                            document.getElementById("btnsubmit1").style.display='none'
                            document.getElementById("form2").style.display='block'
                            document.getElementById("wa").disabled = true
                            swal.close();
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
                confirmButtonColor: '#3085d6',
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
                                    html:`Kamu berhasil terdaftar, E-Ticket otomatis akan terunduh sesaat lagi. Jika E-Ticket belum terunduh/terdownload, klik <a href='#' onclick='javascript:downloadEticket()'>Download E-Ticket</a>
                                    <br><br>
                                    <button type="button" onclick='javascript:window.location.reload()' class="btn btn-primary"><b>Oke</b></button>`,
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
})();
function submitData(ini){
      console.log(ini)
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
                html:`E-Ticket otomatis akan terunduh sesaat lagi. Jika E-Ticket belum terunduh/terdownload, klik <a href='#' onclick='javascript:downloadEticket()'>Download E-Ticket</a>
                <br><br>
                <button type="button" onclick='javascript:window.location.reload()' class="btn btn-primary"><b>Oke</b></button>`,
                showConfirmButton: false,
                allowOutsideClick:false,
            })
        }
    })
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
  </body>
</html>
