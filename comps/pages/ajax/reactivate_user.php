<?php 
  require_once('../config/instantiated_files.php');
  $idd =  $_GET['idd'];
  $reactivate_user = reactivate_user($uid,$idd);
  $reactivate_user_dec = json_decode($reactivate_user,true);
  if($reactivate_user_dec['status'] != 111){
    echo $reactivate_user_dec['msg'];
  } else{
    echo 200;
  }

?>