<?php 
  require_once('../config/instantiated_files.php');
  $old_password =  $_POST['old_password'];
  $new_password =  $_POST['new_password'];
  $new_passwordc =  $_POST['new_passwordc'];

  $edit_my_password = edit_my_password($old_password,$new_password,$new_passwordc,$uid);
  $edit_my_password_dec = json_decode($edit_my_password,true);
  if($edit_my_password_dec['status'] != 111){
    echo $edit_my_password_dec['msg'];
  } else{
    echo 200;
  }

?>