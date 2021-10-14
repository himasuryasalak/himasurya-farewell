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
    </table>
</div>
<table id="tabel1" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="10px">No.</th>
            <th>Nama</th>
            <th width="15px">Tahun</th>
            <th width="60px" style="text-align: center;">Status</th>
            <th width="12px"></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $count1=0;
        foreach($wisudawan as $data1){
            $count1++;
            if($data1['status']=='terdaftar')$color_status="orange";
            else $color_status="green";
        ?>
        <tr>
        <td><?php echo $count1++;?></td>
        <td><?php echo $data1['nama']?></td>
        <td style="text-align: center;"><?php echo $data1['angkatan']?></td>
        <td style="text-align: center;color: <?php echo $color_status ?>;"><b><?php echo strtoupper($data1['status'])?></b></td>
        <td style="text-align: center;"><a href='http://wa.me/<?php echo $data1['no_wa']?>' target="_BLANK" class="chat_wa"><button type="button" class="btn btn-sm btn-primary">Chat</button></a></td>
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
            <th width="10px">No.</th>
            <th>Nama</th>
            <th width="15px">Tahun</th>
            <th width="60px" style="text-align: center;">Status</th>
            <th width="12px"></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $count1=0;
        foreach($tamulain as $data1){
            $count1++;
            if($data1['status']=='terdaftar')$color_status="orange";
            else $color_status="green";
        ?>
        <tr>
        <td><?php echo $count1++;?></td>
        <td><?php echo $data1['nama']?></td>
        <td style="text-align: center;"><?php echo $data1['angkatan']?></td>
        <td style="text-align: center;color: <?php echo $color_status ?>;"><b><?php echo strtoupper($data1['status'])?></b></td>
        <td style="text-align: center;"><a href='http://wa.me/<?php echo $data1['no_wa']?>' target="_BLANK" class="chat_wa"><button type="button" class="btn btn-sm btn-primary">Chat</button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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
</script>
</body>
</html>