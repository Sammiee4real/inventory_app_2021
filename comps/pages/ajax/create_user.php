<?php 
  require_once('../config/instantiated_files.php');
  $first_name =  $_POST['first_name'];
  $last_name =  $_POST['last_name'];
  $phone =  $_POST['phone'];
  $email =  $_POST['email'];
  $password =  $_POST['password'];
  $passwordc =  $_POST['passwordc'];
  $privilege_level =  $_POST['privilege_level'];

  $create_user = create_user($uid,$first_name,$last_name,$phone,$email,$password,$passwordc,$privilege_level);
  $create_user_dec = json_decode($create_user,true);
  if($create_user_dec['status'] != 111){
    echo $create_user_dec['msg'];
  } else{
    echo 200;
  }

?>