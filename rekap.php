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

<?php 
    $qdata = mysqli_query($koneksi, "SELECT * from rekap ");
    $results = array();
    while ($row = mysqli_fetch_array($qdata)) $results[] = $row;
    $wisudawan = array();
    $wisudawan = array_filter($results, function($element) { return ($element['wisudawan'] =='ya'); });
    $blm_hadir1 = array_filter($wisudawan, function($element) { return ($element['status'] =='terdaftar'); });
    $sdh_hadir1 = array_filter($wisudawan, function($element) { return ($element['status'] =='hadir'); });

    $tamulain = array();
    $tamulain = array_filter($results, function($element) { return ($element['wisudawan'] =='tidak'); });
    $blm_hadir2 = array_filter($tamulain, function($element) { return ($element['status'] =='terdaftar'); });
    $sdh_hadir2 = array_filter($tamulain, function($element) { return ($element['status'] =='hadir'); });
?>
<div class='container'>
<br>
<div class="div_info">
    <h2>Data Wisudawan</h2>
    <table class="table info table-bordered">
        <thead>
            <tr>
                <th style="color:orange">Belum Hadir</th>
                <th style="color:green">Sudah Hadir</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><?php echo count($blm_hadir1) ?></th>
                <th><?php echo count($sdh_hadir1) ?></th>
            </tr>
        </tbody>
    </table><br>
    <button type="button" class="btn btn-warning" id="btnrandom1">Random Picker</button>
</div>
<table id="tabel1" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="5px"></th>
            <th>Nama</th>
            <th width="50px">Masuk</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $count1=1;
        $list_wisudawan=array();
        foreach($wisudawan as $data1){
            array_push($list_wisudawan,$data1['nama']);
            if($data1['status']=='terdaftar'){
                $color_status="orange";
                $status='<i class="fas fa-times"></i>';
            }
            else {
                $color_status="black";
                $status=$data1['jam_masuk'];
            }
        ?>
        <tr>
        <td><?php echo $count1++;?></td>
        <td><?php echo $data1['nama']?></td>
        <td style="text-align: center;color: <?php echo $color_status ?>;"><?php echo $status?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<div class="div_info">
    <h2>Tamu Lainnya</h2>
    <table class="table info table-bordered">
        <thead>
            <tr>
                <th style="color:orange">Belum Hadir</th>
                <th style="color:green">Sudah Hadir</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <th><?php echo count($blm_hadir2) ?></th>
                <th><?php echo count($sdh_hadir2) ?></th>
            </tr>
        </tbody>
    </table>
</div>
<table id="tabel2" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="5px"></th>
            <th>Nama</th>
            <th width="15px">Thn</th>
            <th width="40px">Masuk</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $count1=1;
        foreach($tamulain as $data1){
            if($data1['status']=='terdaftar'){
                $color_status="orange";
                $status='<i class="fas fa-times"></i>';
            }
            else {
                $color_status="black";
                $status=$data1['jam_masuk'];
            }
        ?>
        <tr>
        <td><?php echo $count1++;?></td>
        <td><?php echo $data1['nama']?></td>
        <td style="text-align: center;"><?php echo $data1['angkatan']?></td>
        <td style="text-align: center;color: <?php echo $color_status ?>;"><?php echo $status?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<?php include 'footer_script.php'?>
<!-- DataTables  & Plugins -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.6.0/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.4/date-1.1.1/fc-4.0.0/fh-3.2.0/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.2/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#tabel1').DataTable().buttons().container().appendTo( '#tabel1_wrapper .col-md-6:eq(0)');
    $('#tabel2').DataTable().buttons().container().appendTo( '#tabel1_wrapper .col-md-6:eq(0)');
});
document.getElementById("btnrandom1").addEventListener("click",function(){
    let list = ['<?php echo implode("','",$list_wisudawan) ?>'];
    const random = Math.floor(Math.random() * list.length);
    let timerInterval
    Swal.fire({
        title: 'Memproses...',
        html: 'Hasil akan muncul dalam <b>3</b> Detik',
        timer: 3000,
        allowOutsideClick:false,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Math.ceil(Swal.getTimerLeft()/1000)
            }, 1000)
        },willClose: () => {
            clearInterval(timerInterval)
        }
        }).then((result) => {
        Swal.fire({
            title:"Selamat Kepada",
            html:"<h4>"+list[random]+"</h4>Telah Terpilih dalam random picker kali ini",
        })
    })
})
</script>
</body>
</html>