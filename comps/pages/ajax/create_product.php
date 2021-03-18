<?php 
  require_once('../config/instantiated_files.php');
  $cat_id =  $_POST['cat_id'];
  $product_name =  $_POST['product_name'];
  $quantity =  $_POST['quantity'];
  $unit_price =  $_POST['unit_price'];
  $measure_type =  $_POST['measure_type'];
  // $created_by =  $_POST['created_by'];

  $create_product = create_product($cat_id,$product_name,$quantity,$unit_price,$measure_type,$uid);
  $create_product_dec = json_decode($create_product,true);
  if($create_product_dec['status'] != 111){
    echo $create_product_dec['msg'];
  } else{
    echo 200;
  }

?>