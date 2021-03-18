<?php
$table = "";
$app_name = 'INVENTORY APP';
require_once("db_connect.php");
//require_once('validations.php');
require_once("config.php");
global $dbc;


function get_all_customers(){
    global $dbc;
    $sql = "SELECT id FROM `sales_txn_tbl` GROUP BY `phone`";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}


function get_all_orders(){
    global $dbc;
    $sql = "SELECT id FROM `sales_txn_tbl`";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}

function get_all_sales(){
    global $dbc;
    $sql = "SELECT SUM(price_to_pay) as amm FROM `sales_txn_tbl`";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count > 0){
        $row = mysqli_fetch_array($qry);
        $total_amount = $row['amm'];
        return $total_amount;
    }else{
        return 0;
    }
}




function check_record_by_one_param($table,$param,$value){
    global $dbc;
    $sql = "SELECT id FROM `$table` WHERE `$param`='$value'";
    $query = mysqli_query($dbc, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      return true; ///exists
    }else{
      return false; //does not exist
    }
    
}   

function check_record_by_two_params($table,$param,$value,$param2,$value2){
    global $dbc;
    $sql = "SELECT id FROM `$table` WHERE `$param`='$value' AND `$param2`='$value2'";
    $query = mysqli_query($dbc, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      return true; ///exists
    }else{
      return false; //does not exist
    }
    
}    


  function enter_sales($post_array,$amount_paid,$customer_name,$phone,$created_by,$inv){
       global $dbc;

       
       foreach($post_array as $value){
            
              $unique_id = unique_id_generator($inv.rand(222,333));
              $productID = explode('_', $value)[0];
              $purchase_qty = $_POST['purchase_qty_'.$productID];
              $quantity = $_POST['quantity_'.$productID];
              $pd_price = $_POST['pd_price_'.$productID];
              $price_to_pay = $_POST['price_to_pay_'.$productID];
              $new_quantity = $quantity - $purchase_qty;

              $sql = "INSERT INTO `sales_txn_tbl` SET 
                `invoice_no`='$inv',
                `unique_id`='$unique_id',
                `product_id`='$productID',
                `customer_name`='$customer_name',
                `phone`='$phone',
                `sales_status`=1,
                `unit_price`='$pd_price',
                `quantity`='$purchase_qty',
                `price_to_pay`='$price_to_pay',
                `total_amount`='$amount_paid',
                `created_by`='$created_by',
                `when_created`=now()
                ";
               $qry = mysqli_query($dbc,$sql);

               //update product table with new product quantity
               $sql_update_qty = "UPDATE `product_tbl` SET
                `quantity`='$new_quantity' WHERE `unique_id`='$productID'
               "; 
               $qry_update_qty = mysqli_query($dbc,$sql_update_qty);

       }

                return json_encode(array( "status"=>111, "msg"=>"Order entries was succesful" ));


   }

function reactivate_user($deactivated_by,$user_id){
  global $dbc;
   $sql = "UPDATE `users_tbl` SET `access_level`=1 WHERE `unique_id`='$user_id'";
   $query = mysqli_query($dbc,$sql);
   if($query){
                return json_encode(array( "status"=>111, "msg"=>"User deactivation was successful!" ));

   }else{
                return json_encode(array( "status"=>105, "msg"=>"Server Error!" ));

   }
}




function deactivate_user($deactivated_by,$user_id){
  global $dbc;
   $sql = "UPDATE `users_tbl` SET `access_level`=0 WHERE `unique_id`='$user_id'";
   $query = mysqli_query($dbc,$sql);
   if($query){
                return json_encode(array( "status"=>111, "msg"=>"User deactivation was successful!" ));

   }else{
                return json_encode(array( "status"=>105, "msg"=>"Server Error!" ));

   }
}


function user_login($email,$password){
   global $dbc;
   $email = secure_database($email);
   $password = secure_database($password);
   $hashpassword = md5($password);

   $sql = "SELECT * FROM `users_tbl` WHERE `email`='$email' AND `password`='$hashpassword' AND `access_level`=1";
   $query = mysqli_query($dbc,$sql);
   $count = mysqli_num_rows($query);
   if($count === 1){
      $row = mysqli_fetch_array($query);
      $fname = $row['first_name'];
      $lname = $row['last_name'];
      $phone = $row['phone'];
      $email = $row['email'];
      $unique_id = $row['unique_id'];
   
                return json_encode(array( 
                    "status"=>111, 
                    "user_id"=>$unique_id, 
                    "fname"=>$fname, 
                    "lname"=>$lname, 
                    "phone"=>$phone, 
                    "email"=>$email 
                  )
                 );
    
   }else{
                return json_encode(array( "status"=>102, "msg"=>"Wrong username or password!" ));
   }
}

function create_product_category($category_name,$created_by){
   global $dbc;
   $check =   check_record_by_one_param('category_tbl','category_name',$category_name);
   if($category_name == ""  || $created_by == ""){
        return json_encode(array( "status"=>105, "msg"=>"Empty field(s) found"));
   }
   else if($check){
        return json_encode(array( "status"=>118, "msg"=>"This Product Category Name exists"));
   }else{
        $unique_id = unique_id_generator($category_name);
        $sql = "INSERT INTO `category_tbl` SET 
        `unique_id`='$unique_id',
        `category_name`='$category_name',
        `created_by`='$created_by',
        `when_created`=now() ";
        $query = mysqli_query($dbc,$sql) ;
        // $query = mysqli_query($dbc,$sql) or die(mysqli_error($dbc));

        if($query){
          //$row = mysqli_fetch_array($query);
          return json_encode(array( 
           "status"=>111, "msg"=>'Product creation was successful'
            )
         );

        }else{
        return json_encode(array( "status"=>102, "msg"=>"Server Error!" ));

        }
   }

}

function create_product($cat_id,$product_name,$quantity,$unit_price,$measure_type,$created_by){
   global $dbc;
   $check =   check_record_by_one_param('product_tbl','product_name',$product_name);
   if($cat_id == "" || $product_name == ""  || $quantity == "" || $unit_price == "" || $measure_type == "" || $created_by == ""){
        return json_encode(array( "status"=>105, "msg"=>"Empty field(s) found"));
   }
   else if($check){
        return json_encode(array( "status"=>118, "msg"=>"This Product Name exists"));
   }else{
        $unique_id = unique_id_generator($product_name);
        $sql = "INSERT INTO `product_tbl` SET 
        `unique_id`='$unique_id',
        `category_id`='$cat_id',
        `product_name`='$product_name',
        `unit_price`='$unit_price',
        `quantity`='$quantity',
        `measure_type`='$measure_type',
        `availability_status`=1,
        `created_by`='$created_by',
        `when_created`=now() ";
        $query = mysqli_query($dbc,$sql) ;
        // $query = mysqli_query($dbc,$sql) or die(mysqli_error($dbc));

        $unique_id_log = unique_id_generator($product_name.'restock');
        $sqlre = "INSERT INTO `restocking_tbl` SET 
        `restock_id`='$unique_id_log',
        `product_id`='$unique_id',
        `quantity`='$quantity',
        `restock_type`='new_pro',
        `restock_date`=now(),
        `created_by`='$created_by',
        `when_created`=now() ";
        $queryre = mysqli_query($dbc,$sqlre) ;

        if($query == true &&  $queryre == true ){
          return json_encode(array( 
           "status"=>111, "msg"=>'Product creation was successful'
            )
         );

        }else{
        return json_encode(array( "status"=>102, "msg"=>"Server Error!" ));

        }
   }

}

function edit_product($cat_id,$product_name,$quantity,$unit_price,$product_id,$created_by){
   global $dbc;
  // $check = get_rows_from_one_table_by_id('product_tbl','product_name',$product_name,'when_created');
   if($cat_id == "" || $product_name == ""  || $quantity == "" || $unit_price == "" || $product_id == "" || $created_by == ""){
        return json_encode(array( "status"=>105, "msg"=>"Empty field(s) found"));
   }
   // else if($check){
   //      return json_encode(array( "status"=>118, "msg"=>"This Product Name exists"));
   // }
   else{
        $sql = "UPDATE `product_tbl` SET 
        `category_id`='$cat_id',
        `product_name`='$product_name',
        `unit_price`='$unit_price',
        `quantity`='$quantity',
        `created_by`='$created_by'
        WHERE `unique_id`='$product_id'";
        $query = mysqli_query($dbc,$sql) ;
    
        if($query == true){
          return json_encode(array( 
           "status"=>111, "msg"=>'Product Update was successful'
            )
         );

        }else{
        return json_encode(array( "status"=>102, "msg"=>"Server Error!" ));

        }
   }

}

function edit_my_profile($first_name,$last_name,$phone,$email,$uid){
   global $dbc;

   if($first_name == "" || $last_name == ""  || $phone == "" || $email == "" || $uid == ""){
        return json_encode(array( "status"=>105, "msg"=>"Empty field(s) found"));
   }
   else{
        $sql = "UPDATE `users_tbl` SET 
        `first_name`='$first_name',
        `last_name`='$last_name',
        `phone`='$phone',
        `email`='$email'
        WHERE `unique_id`='$uid'";
        $query = mysqli_query($dbc,$sql) ;
    
        if($query == true){
          return json_encode(array( 
           "status"=>111, "msg"=>'Your Profile Update was successful'
            )
         );

        }else{
        return json_encode(array( "status"=>102, "msg"=>"Server Error!" ));

        }
   }

}

function edit_my_password($old_password,$new_password,$new_passwordc,$uid){
   global $dbc;
   $check_old_pass = check_record_by_one_param('user_tbl','password',md5($old_password));

   if($old_password == "" || $new_password == ""  || $new_passwordc == "" || $uid == ""){
        return json_encode(array( "status"=>105, "msg"=>"Empty field(s) found"));
   }
   else if($check_old_pass == false){
        return json_encode(array( "status"=>109, "msg"=>"Old Password is wrong"));
   }
      else if($new_password != $new_passwordc){
        return json_encode(array( "status"=>107, "msg"=>"Password Mismatch found"));
   }
   else{
        $password_new2 = md5($new_password);
        $sql = "UPDATE `users_tbl` SET 
        `password`='$password_new2'
        WHERE `unique_id`='$uid'";
        $query = mysqli_query($dbc,$sql);
    
        if($query == true){
          return json_encode(array( 
           "status"=>111, "msg"=>'Your Password Update was successful'
            )
         );

        }else{
        return json_encode(array( "status"=>102, "msg"=>"Server Error!" ));

        }
   }

}




function create_user($uid,$first_name,$last_name,$phone,$email,$password,$passwordc,$privilege){
   global $dbc;
   $password = md5($password);
   $passwordc = md5($passwordc);
   $check_phone = check_record_by_one_param('users_tbl','phone',$phone);
   $check_email = check_record_by_one_param('users_tbl','email',$email);
   if($uid == "" || $first_name == ""  || $last_name == "" || $phone == "" || $email == "" || $password == "" || $privilege == ""){
        return json_encode(array( "status"=>105, "msg"=>"Empty field(s) found"));
   }
   else if($check_phone == true || $check_email == true  ){
        return json_encode(array( "status"=>113, "msg"=>"Empty field(s) found"));
   }
   else if($password != $passwordc){
        return json_encode(array( "status"=>113, "msg"=>"Password mismatch found"));
   }
   else{
        $unique_id = unique_id_generator($first_name.$last_name.$uid);
        $sql = "INSERT INTO `users_tbl` SET 
        `unique_id`='$unique_id',
        `first_name`='$first_name',
        `last_name`='$last_name',
        `phone`='$phone',
        `email`='$email',
        `password`='$password',
        `privilege_level`='$privilege',
        `created_by`='$uid',
        `when_created`=now() ";
        $query = mysqli_query($dbc,$sql) ;
        // $query = mysqli_query($dbc,$sql) or die(mysqli_error($dbc));

        if($query){
          //$row = mysqli_fetch_array($query);
          return json_encode(array( 
           "status"=>111, "msg"=>'User creation was successful'
            )
         );

        }else{
        return json_encode(array( "status"=>102, "msg"=>"Server Error!" ));

        }
   }

}


function unique_id_generator($data){
    $data = secure_database($data);
    $newid = md5(uniqid().time().rand(11111,99999).rand(11111,99999).$data);
    return $newid;
}

function get_row_count_no_param($table){
    global $dbc;
    $sql = "SELECT id FROM `$table`";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}

function get_row_count_one_param($table,$param,$value){
    global $dbc;
    $sql = "SELECT id FROM `$table` WHERE `$param`='$value'";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}

function get_row_count_two_params($table,$param,$value,$param2,$value2){
    global $dbc;
    $sql = "SELECT id FROM `$table` WHERE `$param`='$value' AND `$param2`='$value2'";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}


function update_by_one_param($table,$param,$value,$condition,$condition_value){
  global $dbc;
  $sql = "UPDATE `$table` SET `$param`='$value' WHERE `$condition`='$condition_value'";
  $qry = mysqli_query($dbc,$sql);
  if($qry){
     return true;
  }else{
      return false;
  }
}


function get_one_row_from_one_table_by_id($table,$param,$value,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             $row = mysqli_fetch_array($query);              
             return $row;
          }
          else{
             return null;
        }
    }


function secure_database($value){
    global $dbc;
    $new_value = mysqli_real_escape_string($dbc,$value);
    return $new_value;
}

function get_rows_from_one_table_by_id($table,$param,$value,$order_option){
        global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             while($row = mysqli_fetch_array($query)){
                $display[] = $row;
             }              
             return $display;
          }
          else{
             return null;
          }
}


function get_rows_from_one_table($table,$order_option){
         global $dbc;
       
        $sql = "SELECT * FROM `$table` ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
           while($row = mysqli_fetch_array($query)){
             $row_display[] = $row;
           }
                          
            return $row_display;
          }
          else{
             return null;
          }
}

function truncateString($str, $chars, $to_space, $replacement="...") {
   if($chars > strlen($str)) return $str;

   $str = substr($str, 0, $chars);
   $space_pos = strrpos($str, " ");
   if($to_space && $space_pos >= 0) 
       $str = substr($str, 0, strrpos($str, " "));

   return($str . $replacement);
}

function get_total_pages($table,$no_per_page){
    global $dbc;
    $no_per_page = secure_database($no_per_page);
    $total_pages_sql = "SELECT COUNT(id) FROM  `$table` ";
    $result = mysqli_query($dbc,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_per_page);
    return $total_pages;
}


function get_rows_from_one_table_with_pagination($table,$offset,$no_per_page){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `$table` ORDER BY when_created DESC LIMIT $offset,$no_per_page ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_rows_from_one_table_with_pagination_group_by($table,$offset,$no_per_page,$group_by_param,$order_option){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `$table` GROUP BY `$group_by_param` ORDER BY `$order_option` DESC LIMIT $offset,$no_per_page ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function get_rows_from_one_table_with_pagination_group_by_limit($table,$group_by_param,$order_option,$limit){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` GROUP BY `$group_by_param` ORDER BY `$order_option` DESC LIMIT $limit ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}







 function format_date($date){
        $date = secure_database($date);
        $new_date_format = date('F-d-Y h:i:s', strtotime($date));

        return $new_date_format;
  }


function variables_not_set(){
            
        return json_encode(array( "status"=>102, "msg"=>"one or more variables missing" ));

}

function get_one_row_by_id($table,$param,$id){
    global $dbc;
    $sql = "SELECT * FROM `$table` where `$param`='$id'";
    $query = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
       $row = mysqli_fetch_array($query);
       return $row;
    }else{
      return null;
    }
}

function client_update($first_name,$last_name,$phone,$email,$gender,$client_id){
     global $dbc;
     $sql = "UPDATE `client_users` SET `first_name`='$first_name',`last_name`='$last_name',`phone`='$phone',`email`='$email',`gender`='$gender' WHERE `unique_id`='$client_id'";
     $qry = mysqli_query($dbc,$sql);
     if($qry){
        return json_encode(array( "status"=>111, "msg"=>"Update was successful" )); 
     }else{
        return json_encode(array( "status"=>105, "msg"=>"Server error" )); 

     }
}


function universal_search_param($current_param){
  global $dbc;
  $sql = "SELECT * FROM `client_users` WHERE `first_name` LIKE '%$current_param%' OR  `last_name` LIKE '%$current_param%'";
  $qry = mysqli_query($dbc,$sql);
  $num = mysqli_num_rows($qry);
  if($num == 0){
        return json_encode(array( "status"=>102, "msg"=>"No record found" )); 
  }else{
      while($row = mysqli_fetch_array($qry)){
                $row_display[] = $row;
      }

     
        return json_encode(array( "status"=>111, "msg"=>$row_display )); 


  }
}



//////////////////////////////not needed for now
