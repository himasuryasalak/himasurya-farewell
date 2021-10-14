<?php 
if ($_SERVER['SERVER_NAME']=='localhost'){
shell_exec( 'git pull origin master' ); ?>
<h2>Succesfully Pulled</h2>
<?php     
} else {?>
<h2>Run on local. Can't pull repository</h2>
<?php } ?>