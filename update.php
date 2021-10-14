<?php 
$server=array();
$server = ['localhost','farewell.gabut.ga'];
if ( in_array($_SERVER['SERVER_NAME'],$server)){
shell_exec( 'git pull origin master' ); ?>
<h2>Succesfully Pulled</h2>
<?php     
} else {?>
<h2>Run on local. Can't pull repository</h2>
<?php } ?>