<?php 
  require_once('../config/instantiated_files.php');
  $idd =  $_GET['idd'];
  $deactivate_user = deactivate_user($uid,$idd);
  $deactivate_user_dec = json_decode($deactivate_user,true);
  if($deactivate_user_dec['status'] != 111){
    echo $deactivate_user_dec['msg'];
  } else{
    echo 200;
  }

?>