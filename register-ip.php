<?php
session_start();

if(isset($_POST['pass']))
{
 $pass=$_POST['pass'];
 if($pass=="1234.Kiki"  &&$_POST['user']!="none")
 {
    $isi = file_get_contents(".htaccess");
    $head1 = explode("#BEGIN_STATUS",$isi)[0];
    $s1 = explode("#BEGIN_STATUS",$isi);
    $head1 = $s1[0];
    $s2 = explode("#END_STATUS",$s1[1]);
    $line_status =$s2[0];
    $s3 = explode("#BEGIN_IP",$s2[1]);
    $middle = $s3[0];
    $s4= explode("#END_IP",$s3[1]);
    $line_ip = $s4[0];
    $footer1 = $s4[1];

    //Cek ini local atau ga
    $local = array("192","127","localhost");
    $server_ip0 = explode(".",$_SERVER['HTTP_HOST'])[0];
    if ( in_array($server_ip0,$local)){
        $long_status = 29;
        $long_ip = 32;
        $end_ip = 3;
        $break_line = "\r\n";
    }else{
        $long_status = 28;
        $long_ip = 31;
        $end_ip = 2;
        $break_line = "\n";
    }

    //pecah status
    $status0 = substr($line_status,0,$long_status);
    $mode = substr($line_status,$long_status,1);
    $status = "Done";
    if (isset($_POST['check'])){
        if (intval($mode)==1) {
            $mode='2';
            $status="maintenance";
        }
        else {
            $mode='1';
            $status="live";
        }
    }
    //echo "<br>mode:".$mode."<br>";
    $line_status=$status0.$mode."]".$break_line;

    //pecah IP
    $head_ip = substr($line_ip,0,$long_ip);
    $list_ip = substr($line_ip,$long_ip,strlen($line_ip)-$long_ip-$end_ip);
    $ip = explode("|",$list_ip);
    $ip[intval($_POST['user'])] = $_SERVER['REMOTE_ADDR'];
    $list_ip = join("|",$ip);
    //echo "<br>List ip:".$list_ip."<br>";
    $line_ip = $head_ip.$list_ip.")".$break_line;

    //Hasil akhir
    $akhir = $head1."#BEGIN_STATUS".$line_status."#END_STATUS".$middle."#BEGIN_IP".$line_ip."#END_IP".$footer1;
    $myfile = fopen(".htaccess", "w") or die("Unable to open file!");
    fwrite($myfile, $akhir);
    fclose($myfile);
 }
 else
 {
  $error="Access Denied";
 }
}

if(isset($_POST['page_logout']))
{
 unset($_SESSION['password']);
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<style>
    body
    {
    font-family: "Myriad Pro","Helvetica Neue",Helvetica,Arial,Sans-Serif;
    background-color:#01aff3;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90vh;
    padding: 0 10px;
    }
    #wrapper
    {
        max-width: 450px;
  width: 100%;
    }
    #wrapper h1
    {
    margin-top:50px;
    font-size:45px;
    color:white;
    }
    #wrapper p
    {
    font-size:16px;
    }
    #logout_form input[type="submit"]
    {
    width:100%;
    margin-top:10px;
    height:40px;
    font-size:16px;
    background:none;
    border:2px solid white;
    color:white;
    }
    #login_form
    {
    background-color:white;
    padding:20px;
    box-sizing:border-box;
    box-shadow:0px 0px 10px 0px #014864;
    }
    #login_form h1
    {
    margin:0px;
    font-size:25px;
    color:#028ac0;
    }
    select, input[type="password"]
    {
    width:100%;
    margin-top:10px;
    height:40px;
    padding-left:10px;
    font-size:16px;
    }
    input[type="checkbox"],label{
        height:40px;
        vertical-align: -webkit-baseline-middle;
    }
    #login_form input[type="submit"]
    {
        width: 100%;
    margin-top:10px;
    height:40px;
    font-size:16px;
    background-color:#01aff3;
    border:none;
    box-shadow:0px 4px 0px 0px #0388bd;
    color:white;
    border-radius:3px;
    }
    #login_form p
    {
    margin:0px;
    margin-top:15px;
    color:#01aff3;
    font-size:17px;
    font-weight:bold;
    }
</style>
</head>
<body>
    <?php
    if (isset($status)){
        ?>
        <script>
        <?php
        if($status=="live") echo "alert('IP Address Succesfully Registered. Maintenance mode OFF');";
        else if($status=="maintenance") echo "alert('IP Address Succesfully Registered. Maintenance mode ON');";
        else echo "alert('IP Address Succesfully Registered');";
        unset($status);
        ?>
        location.assign("../")
        </script>
        <?php
    }
    ?>
<div id="wrapper">
 <form method="post" action="" id="login_form">
  <h1>COMPLETE TO PROCEED</h1>
  <input type="password" name="pass" placeholder="*******">
  <select name="user">
      <option value="none" disabled selected="selected">- Choose -</option>
      <option value=0>Laptop</option>
      <option value=1>Phone</option>
  </select><br>
  <input type="checkbox" id="check1" name="check" value="Yes"/>
  <label for="check1">Switch Mode</label>
  <input type="submit" name="submit_pass" value="PROCEED">
  <p><font style="color:red;"><?php if(isset($error)) echo $error;?></font></p>
  <?php $error="apa"?>
 </form>

</div>
</body>
</html>