<?php 
  require_once('../config/instantiated_files.php');
  $cat_name =  $_POST['cat_name'];
  // $created_by =  $_POST['created_by'];
  $create_product_category = create_product_category($cat_name,$uid);
  $create_product_category_dec = json_decode($create_product_category,true);
  if($create_product_category_dec['status'] != 111){
    echo $create_product_category_dec['msg'];
  } else{
    echo 200;
  }

?>