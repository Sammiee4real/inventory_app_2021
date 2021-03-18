<?php 
  require_once('../config/instantiated_files.php');
  $first_name =  $_POST['first_name'];
  $last_name =  $_POST['last_name'];
  $phone =  $_POST['phone'];
  $email =  $_POST['email'];
  // $created_by =  $_POST['created_by'];

  $edit_my_profile = edit_my_profile($first_name,$last_name,$phone,$email,$uid);
  $edit_my_profile_dec = json_decode($edit_my_profile,true);
  if($edit_my_profile_dec['status'] != 111){
    echo $edit_my_profile_dec['msg'];
  } else{
    echo 200;
  }

?>