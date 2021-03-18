<?php session_start();
     include('database_functions.php');
     if(!isset($_SESSION['uid'])){
        header('location: index.php');
      }
     $uid = $_SESSION['uid'];
     $user_details = get_one_row_from_one_table_by_id('users_tbl','unique_id',$uid,'when_created');
     $first_name = $user_details['first_name'];
     $last_name = $user_details['last_name'];
     $fullname = $first_name.' '.$last_name;
     $email = $user_details['email'];
     $phone = $user_details['phone'];
     // $gender = $user_details['gender'];
     $date_created = $user_details['when_created'];
     $privilege_level = $user_details['privilege_level'];

     if($privilege_level == 1){
        $role = "Super Admin";
     }

    if($privilege_level == 2){
        $role = "Staff";
     }
 

     $basename = basename($_SERVER['PHP_SELF']);

     $unauthorized_pages = ['create_product.php','products.php','create_product_category.php','categories.php','create_user.php','users.php'];

     if(in_array($basename, $unauthorized_pages) && $privilege_level == 2){
        header('location: no_access.php');

     }

     //////////pagination script starts
		if (isset($_GET['pageno'])) {
		$pageno = $_GET['pageno'];
		} else {
		$pageno = 1;
		}
		$no_per_page = 12;
		$offset = ($pageno-1) * $no_per_page; 
		/////////pagination script ends
?>