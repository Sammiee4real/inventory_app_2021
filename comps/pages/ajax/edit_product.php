<?php 
  require_once('../config/instantiated_files.php');
  $cat_id =  $_POST['cat_id'];
  $product_name =  $_POST['product_name'];
  $quantity =  $_POST['quantity'];
  $unit_price =  $_POST['unit_price'];
  $product_id =  $_POST['product_id'];
  // $created_by =  $_POST['created_by'];

  $edit_product = edit_product($cat_id,$product_name,$quantity,$unit_price,$product_id,$uid);
  $edit_product_dec = json_decode($edit_product,true);
  if($edit_product_dec['status'] != 111){
    echo $edit_product_dec['msg'];
  } else{
    echo 200;
  }
  // print_r($_POST);

?>