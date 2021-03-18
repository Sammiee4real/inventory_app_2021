<?php
$table = "";
$app_name = 'Finsight Savings';
require_once("db_connect.php");
// require_once("constants.php");
require_once("config.php");
global $dbc;


define('SECRETE_KEY', 'test123');

//Datatypes
define('BOOLEAN', '1');
define('INTEGER', '2');
define('STRING', '3');

//  Error codes
define('INCORRECT_PASSWORD', 100);
define('API_RESPONSE_ERROR', 109);
define('EMPTY_FIELDS', 101);
define('NO_ACCESS', 102);
define('NOT_FOUND', 103);
define('RECORD_EXISTS', 104);
define('SUCCESS_RESPONSE', 200);
define('USER_EXISTS', 105);
define('PASSWORD_MISMATCH', 106);
define('DB_ERROR', 107);
define('NULL', 108);



//Server Errors
define('AUTHORIZATION_HEADER_NOT_FOUND',  300);
define('ACCESS_TOKEN_ERRORS', 301);
define('JWT_PROCESSING_ERROR', 302);




///Total of 11 endpoints
//////implementation plan
///set each value for each category 
/// 1 for regular 2 - halal 3 - christmas 4 - Ileya  5 - student plan::: transport , feeding, etc 

/// user regular plan creation: min 100, description, lock period: 3/6/12 months, interest is available
///params:  plan name, user_id, opening savings amount, lock period from current date, daily interest@that time,  savings_type

/// user halal plan creation: min 100, description ,lock period: 3/6/12 months, interest is NOT available,
///params:  plan name, user_id, savings_type

///user christmas and ileya: min 100,  4 days before the event,
///params: plan_name, user_id, savings_type

///create user plans based on each categories unique id and save to db

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


// function get_money_box_history_per_user($user_id){
//   global $dbc;
// }
 

// function get_earnings_per_user($user_id){
//   global $dbc;
  
// }

function withdraw_to_money_box($pin,$plan_id,$type,$amount_to_withdraw){
    global $dbc; 

    if($type == 'regular'){
    $table = "user_regular_plans";

    }
    else if($type == 'halal'){
    $table = "user_halal_plans";

    }
    else if($type == "christmas"){
    $table = "user_christmas_plans";

    }
    else if($type == "ileya"){
    $table = "user_ileya_plans";

    }
    //this is 5
    else if($type == "student"){
    $table = "user_student_plans";

    }else{
     return json_encode(array( "status"=>NOT_FOUND, "msg"=>"wrong plan type" ));
    }

   


    $current_date = date('Y-m-d');
    $get_plan_det =   get_one_row_from_one_table_by_id($table,'unique_id',$plan_id,'date_created');   
    $lock_date0 = $get_plan_det['lock_date']; 
    $user_id = $get_plan_det['user_id']; 
    $lock_date = date('Y-m-d',strtotime($lock_date0)); 
    
    // if($current_date < $lock_date){
    //    return json_encode(array( "status"=>NOT_FOUND, "msg"=>"the investment is still in a locked state" ));

    // }


    $user_det =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
    $dbpin = $user_det['pin'];

    if($dbpin != $pin){
       return json_encode(array( "status"=>NOT_FOUND, "msg"=>"wrong pin" ));

    }


    $daily_interest = $get_plan_det['daily_interest']; 
    $user_plan_name = $get_plan_det['user_plan_name']; 
    $current_bal = $get_plan_det['current_balance'];
    $fee = 25;
    $newbal = $current_bal - $amount_to_withdraw - $fee; 

    if($newbal < 0){
      return json_encode(array( "status"=>NOT_FOUND, "msg"=>"insufficient balance" ));
    }
    $update_current_bal = update_by_one_param($table,'current_balance',$newbal,'unique_id',$plan_id);


    $current_wallet = $user_det['grand_wallet'];
    $new_grand_Wallet = $current_wallet - $amount_to_withdraw - $fee;
    if($new_grand_Wallet < 0){
      return json_encode(array( "status"=>NOT_FOUND, "msg"=>"insufficient GRAND balance" ));
     }
    $update_grand_bal = update_by_one_param('users','grand_wallet',$new_grand_Wallet,'unique_id',$user_id);


     $get_plan_wallet =   get_one_row_from_one_table_by_id($table,'unique_id',$plan_id,'date_created');
     $plan_wallet2 = $get_plan_wallet['current_balance'];

     $get_grand_wallet =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
     $grand_wallet2 = $get_grand_wallet['grand_wallet'];



      $unique_id = unique_id_generator($plan_id.$type);
      $sql_insert = "INSERT INTO `money_box` SET
      `unique_id`='$unique_id',
      `plan_id`='$plan_id',
      `user_id`='$user_id',
      `amount`='$amount_to_withdraw',
      `transfer_type`=1,
      `source`=1,
      `date_added`=now()

      ";
      $qry_insert = mysqli_query($dbc,$sql_insert);

      // transfer_type: 0 means from plan to moneybox 
      // source: 1 means from plan to moneybox 

      $money_box = get_money_box_bal($user_id);

      return json_encode(array( "status"=>SUCCESS_RESPONSE,
                    "withdrawal_id"=>$unique_id,
                     "amount_to_withdraw"=> $amount_to_withdraw,
                     'amount_to_withdrawf' =>  number_format(floatval($amount_to_withdraw),2),
                     "withdrawal_fee"=> $fee,
                     "withdrawal_feef"=> number_format(floatval($fee),2),
                     "money_box"=> $money_box,
                     'money_boxf' =>  number_format(floatval($money_box),2),
                     "plan_wallet"=> $plan_wallet2,
                     'plan_walletf' =>  number_format(floatval($plan_wallet2),2),
                     "grand_wallet"=> $grand_wallet2,
                     'grand_walletf' =>  number_format(floatval($grand_wallet2),2),
                     "msg"=>"withdrawal to moneybox was successful" ));

}


function send_feedbacks($user_id,$message){
  global $dbc;
  $get_user_det =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');    
  if($get_user_det == null){
              return json_encode(array( "status"=>NOT_FOUND, "msg"=>"user not found" ));

  }else{

              $phone = $get_user_det['phone'];
              $email = $get_user_det['email'];
              $admin_email = "adebsholey4real@gmail.com";
              $unique_id = unique_id_generator($phone.$user_id);
              $sql = "INSERT INTO `feedbacks` SET
              `unique_id`='$unique_id',
              `user_id`='$user_id',
              `message`='$message',
              `phone`='$phone',
              `email`='$email',
              `date_sent`=now()
              ";
              $qry = mysqli_query($dbc,$sql) or die(mysqli_error($dbc));
              if($qry){
                $subject = "Feedback from ".$email ;
                $content = "Hello,

                A user sent a feedback to you. 

                Below are details

                Email: ". $email. "

                Phone: ". $phone."
                
                Message: ". $message ."
                
                Thank you ";

                email_function($admin_email, $subject, $content);
                return json_encode(array( "status"=>SUCCESS_RESPONSE, "feedback_id"=>$unique_id, "msg"=>"feedback succesfully sent" ));
              }else{
                return json_encode(array( "status"=>DB_ERROR, "msg"=>"server error" ));
              }


  }

  
}


function get_bank_details(){
  $array  = array( 
    array(
      'bank_name' => "Access Bank Plc", 
      'bank_code' => "044"  
    ),
    
    array(
      'bank_name' => "Fidelity Bank Plc", 
      'bank_code' => "070"  
    ),

    array(
      'bank_name' => "First City Monument Bank Limited", 
      'bank_code' => "214"  
    ),
    
    array(
      'bank_name' => "First Bank of Nigeria Limited", 
      'bank_code' => "011"  
    ),

    array(
      'bank_name' => "Guaranty Trust Bank Plc", 
      'bank_code' => "058"  
    ),

    
    array(
      'bank_name' => "United Bank for Africa Plc", 
      'bank_code' => "033"  
    ),


    array(
      'bank_name' => "Citibank Nigeria Limited", 
      'bank_code' => "023"  
    ),

    array(
      'bank_name' => "Ecobank Nigeria Plc", 
      'bank_code' => "050"  
    ),

    array(
      'bank_name' => "Heritage Banking Company Limited", 
      'bank_code' => "030"  
    ),

    array(
      'bank_name' => "Keystone Bank Limited", 
      'bank_code' => "082"  
    ),

    array(
      'bank_name' => "Standard Chartered Bank", 
      'bank_code' => "068"  
    ),


    array(
      'bank_name' => "Stanbic IBTC Bank Plc", 
      'bank_code' => "221"  
    ),

    array(
      'bank_name' => "Sterling Bank Plc", 
      'bank_code' => "232"  
    ),

    array(
      'bank_name' => "Titan Trust Bank Limited", 
      'bank_code' => "022"  
    ),

    array(
      'bank_name' => "Unity Bank Plc", 
      'bank_code' => "215"  
    ),

    array(
      'bank_name' => "Wema Bank Plc", 
      'bank_code' => "035"  
    )

  );

  return json_encode($array);

}




function investment_group_creation_from_bank($user_id,$group_name,$amount,$slot_to_buy,$rave_transaction_id,$unique_payment_id){
  global $dbc;
  //what should be start date
  $table = "investment_groups";
  $table2 = "user_investment_purchase";
  $current_date = date('Y-m-d');
  $investment_start_date = date('y-m-d',strtotime($current_date.' + 90 days'));
  $count_created_grps = get_row_count_no_param('investment_groups');

   $crave_transaction_id = check_record_by_one_param($table2,'rave_transaction_id',$rave_transaction_id);
   $cunique_payment_id = check_record_by_one_param($table2,'unique_payment_id',$unique_payment_id);


  $check_grp_exist  = check_record_by_one_param($table,'group_name',$group_name);


  if($check_grp_exist){
    // return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"record exists" ));
      // $uniqkey = unique_id_generator($user_id.$group_name);
      $uniqkey = rand(11111,99999);
      $group_name = $group_name.'_'.$uniqkey;
    }
  

 if($crave_transaction_id == true || $cunique_payment_id == true ){
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));
   }


  else if($count_created_grps == 10){
          return json_encode(array( "status"=>NO_ACCESS, "msg"=>"Maximum number of groups created" ));
  }

  else if($slot_to_buy >= 10){
          return json_encode(array( "status"=>NO_ACCESS, "msg"=>"you cannot buy up to 50% available slots" ));
  }

  else if($user_id == "" ||  $group_name == "" ||  $amount == "" || $slot_to_buy == "" ||  $rave_transaction_id == "" ||  $unique_payment_id == "" ){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));

  }
  else{

            $unique_id = unique_id_generator($user_id);
            $sql = "INSERT INTO `investment_groups` SET
            `unique_id`='$unique_id',
            `group_name`='$group_name',
            `group_admin`='$user_id',
            `amount`='$amount',
            `investment_start_date`='$investment_start_date',
            `interest_per_slot`=300,
            `no_of_years`=3,
            `current_slot`='$slot_to_buy',
            `expected_slot`=20,
            `price_per_slot`=150000, 
            `date_added`=now()
            ";
            /////status will change to 0 later
            $qry = mysqli_query($dbc,$sql);



            $unique_id2 = unique_id_generator($user_id.'second');
            $sql_sec = "INSERT INTO `user_investment_purchase` SET
            `unique_id`='$unique_id2',
            `funding_source`='from_bank',
            `user_id`='$user_id',
            `rave_transaction_id`='$rave_transaction_id',
            `unique_payment_id`='$unique_payment_id',
            `investment_group_id`='$unique_id',
            `slots_bought`='$slot_to_buy',
            `slot_amount`='$amount',
            `date_added`=now()
            ";
            /////status will change to 0 later
            $qry_sec = mysqli_query($dbc,$sql_sec);

            return json_encode(array( "status"=>SUCCESS_RESPONSE, "group_unique_id"=>$unique_id, "msg"=>"successfully created" ));
  }

}

function list_investments_per_user($user_email){
  global $dbc;
  $array_master = [];
  $get_user_det = get_one_row_from_one_table_by_id('users','email',$user_email,'date_added');
  $fullname = $get_user_det['fname'].' '.$get_user_det['lname'];
  $user_id = $get_user_det['unique_id'];

  $get_investments = get_rows_from_one_table_by_id('user_investment_purchase_manual','user_email',$user_email,'date_added');
  if($get_investments == null){
            return json_encode(array( "status"=>NOT_FOUND, "msg"=>"no investment found" ));
  }else{
      foreach ($get_investments as $investments) {
          $array  = array(
            'investment_id' => $investments['unique_id'],
            'group_name' => $investments['group_name'],
            'funding_source' => $investments['funding_source'],
            'investment_type' => $investments['investment_type'],
            'slots_bought' => $investments['slots_bought'],
            'slot_amount' => $investments['slot_amount'],
            'interest_rate_percent' => $investments['interest_rate_percent'],
            'price_per_slot' => $investments['price_per_slot'],
            'expected_roi' => $investments['expected_roi'],
            'investment_duration_days' => $investments['investment_duration_days'],
            'investment_duration_years' => $investments['investment_duration_days'] / 365,
            'investment_start_date' => format_date($investments['investment_start_date']),
            'date_added' => format_date($investments['date_added'])
             );
          array_push($array_master, $array);
      }

      return json_encode(array( "status"=>SUCCESS_RESPONSE,"fullname"=>$fullname, "user_id"=>$user_id, "user_email"=>$user_email, "data"=>$array_master));



  }
}


///investments  keke napep::: 80k group of 10
function create_user_investment_keke($group_name,$email,$amount,$amountc){
      global $dbc;
      $table = "users";
      $table22 = "investment_groups_bare";
      $table33 = "user_investment_purchase_manual";
      $current_date = date('Y-m-d');
      $investment_start_date = date('y-m-d',strtotime($current_date.' + 30 days'));
      $count_no_in_group = get_row_count_two_params($table33,'group_name',$group_name,'group_type','keke');
     
      if($check_exist == false){
            return json_encode(array( "status"=>NOT_FOUND, "msg"=>"this user is not a registered member" ));
      }

      else if($count_no_in_group >= 20){
          return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"sorry, the number of persons to fill this group for KEKE NAPEP is reached" ));
      }

      else if($email == "" ||  $amount == "" || $amountc == ""){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));
      }
      else if($amount != $amountc){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"please check and confirm you are inputing the right amount" ));
      }
      else{

        if($count_no_in_group == 0){
            $unique_idg = unique_id_generator($email.'gandogroup');
            $sql_grp = "INSERT INTO `$table22` SET
            `unique_id`='$unique_idg',
            `group_name`='$group_name',
            `group_type`='keke',
            `date_added`=now()
            ";
            $qry_grp = mysqli_query($dbc,$sql_grp);
        }


            $slot_to_buy = $amount / 80000;
            $expected_roi = $amount * 3;
            $unique_id = unique_id_generator($email.'gando');
            $sql_sec = "INSERT INTO `user_investment_purchase_manual` SET
            `unique_id`='$unique_id',
            `user_email`='$email',
            `group_name`='$group_name',
            `funding_source`='cash_transfer_deposit',
            `investment_type`='keke',
            `slots_bought`='$slot_to_buy',
            `slot_amount`='$amount',
            `interest_rate_percent`=300,
            `price_per_slot`=80000,
            `expected_roi`='$expected_roi',
            `investment_duration_days`=1095,
            `investment_start_date`='$investment_start_date',     
            `date_added`=now()
            ";
            $qry_sec = mysqli_query($dbc,$sql_sec);

            $get_user_det = get_one_row_from_one_table_by_id('users','email',$email,'date_added');
            $fullname = $get_user_det['fname'].' '.$get_user_det['lname'];
            $user_id = $get_user_det['unique_id'];

            if($qry_sec){
              return json_encode(array("status"=>SUCCESS_RESPONSE, 
                "msg"=>"Keke Napep Investment successfully entered for ".$fullname, 
                "investment_id"=>$unique_id,
                "user_email"=>$email,
                "group_name"=>$group_name,
                "user_id"=>$user_id,
                "investment_type"=>'keke',
                "interest_rate_percent"=>300,
                "price_per_slot"=>80000,
                "investment_amount"=>$amount,
                "expected_roi"=>$expected_roi,
                 "investment_start_date"=>format_date($investment_start_date),
                "investment_duration_days"=>'3 years',
                "date_added"=>format_date($current_date)
              ));
            }else{
              return json_encode(array("status"=>DB_ERROR, "msg"=>"server error occured"));

            }


      }
}


///investments sienna::: 150k group of 20
function create_user_investment_sienna($group_name,$email,$amount,$amountc){
      global $dbc;
      $table = "users";
      $table22 = "investment_groups_bare";
      $table33 = "user_investment_purchase_manual";
      $current_date = date('Y-m-d');
      $investment_start_date = date('y-m-d',strtotime($current_date.' + 30 days'));
      $check_exist = check_record_by_one_param($table,'email',$email);
      $count_no_in_group = get_row_count_two_params($table33,'group_name',$group_name,'group_type','sienna');


      if($check_exist == false){
            return json_encode(array( "status"=>NOT_FOUND, "msg"=>"this user is not a registered member" ));
      }

      else if($count_no_in_group >= 20){
          return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"sorry, the number of persons to fill this group for SIENNA is reached" ));
      }

      else if($email == "" ||  $amount == "" || $amountc == ""){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));
      }
      else if($amount != $amountc){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"please check and confirm you are inputing the right amount" ));
      }
      else{

            if($count_no_in_group == 0){
            $unique_idg = unique_id_generator($email.'gandogroup');
            $sql_grp = "INSERT INTO `$table22` SET
            `unique_id`='$unique_idg',
            `group_name`='$group_name',
            `group_type`='sienna',
            `date_added`=now()
            ";
            $qry_grp = mysqli_query($dbc,$sql_grp);
            }

            $slot_to_buy = $amount / 150000;
            $expected_roi = $amount * 3;
            $unique_id = unique_id_generator($email.'gando');
            $sql_sec = "INSERT INTO `user_investment_purchase_manual` SET
            `unique_id`='$unique_id',
            `user_email`='$email',
            `group_name`='$group_name',
            `funding_source`='cash_transfer_deposit',
            `investment_type`='sienna',
            `slots_bought`='$slot_to_buy',
            `slot_amount`='$amount',
            `interest_rate_percent`=300,
            `price_per_slot`=150000,
            `expected_roi`='$expected_roi',
            `investment_duration_days`=1095,
            `investment_start_date`='$investment_start_date',     
            `date_added`=now()
            ";
            $qry_sec = mysqli_query($dbc,$sql_sec);


            $get_user_det = get_one_row_from_one_table_by_id('users','email',$email,'date_added');
            $fullname = $get_user_det['fname'].' '.$get_user_det['lname'];
            $user_id = $get_user_det['unique_id'];


            if($qry_sec){

               return json_encode(array("status"=>SUCCESS_RESPONSE, 
                "msg"=>"Sienna Investment successfully entered for ".$fullname, 
                "investment_id"=>$unique_id,
                "user_email"=>$email,
                "group_name"=>$group_name,
                "user_id"=>$user_id,
                "investment_type"=>'sienna',
                "interest_rate_percent"=>300,
                "price_per_slot"=>150000,
                "investment_amount"=>$amount,
                "expected_roi"=>$expected_roi,
                "investment_start_date"=>format_date($investment_start_date),
                "investment_duration_days"=>'3 years',
                "date_added"=>format_date($current_date)

              ));


            }else{
              return json_encode(array("status"=>DB_ERROR, "msg"=>"server error occured"));

            }


      }
}



function investment_group_creation_from_money_box($user_id,$group_name,$amount,$slot_to_buy){
  global $dbc;
  //what should be start date
  $current_date = date('Y-m-d');
  $table = 'investment_groups';
  $investment_start_date = date('y-m-d',strtotime($current_date.' + 90 days'));
  $count_created_grps = get_row_count_no_param('investment_groups');

  $money_box_balance = get_money_box_bal($user_id);

  $check_grp_exist  = check_record_by_one_param($table,'group_name',$group_name);


  if($check_grp_exist){
     return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"record exists" ));
      //$group_name = $group_name.'2';
    }


else if($money_box_balance < $amount){
          return json_encode(array( "status"=>NOT_FOUND, "msg"=>"insufficient funds in money box" ));
  }

  else if($slot_to_buy >= 10){
          return json_encode(array( "status"=>NO_ACCESS, "msg"=>"you cannot buy up to 50% available slots" ));
  }

  else if($count_created_grps == 10){
          return json_encode(array( "status"=>NO_ACCESS, "msg"=>"Maximum number of groups created" ));
  }
  else if($user_id == "" ||  $group_name == "" ||  $amount == "" || $slot_to_buy == "" ){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));

  }
  else{

            $unique_id = unique_id_generator($user_id);
            $sql = "INSERT INTO `investment_groups` SET
            `unique_id`='$unique_id',
            `group_name`='$group_name',
            `group_admin`='$user_id',
            `amount`='$amount',
            `investment_start_date`='$investment_start_date',
            `interest_per_slot`=300,
            `no_of_years`=3,
            `current_slot`='$slot_to_buy',
            `expected_slot`=20,
            `price_per_slot`=150000, 
            `date_added`=now()
            ";
            /////status will change to 0 later
            $qry = mysqli_query($dbc,$sql);



            $unique_id2 = unique_id_generator($user_id.'second');
            $sql_sec = "INSERT INTO `user_investment_purchase` SET
            `unique_id`='$unique_id2',
            `user_id`='$user_id',
            `funding_source`='from_money_box',
            `investment_group_id`='$unique_id',
            `slots_bought`='$slot_to_buy',
            `slot_amount`='$amount',
            `date_added`=now()
            ";
            /////status will change to 0 later
            $qry_sec = mysqli_query($dbc,$sql_sec);


          return json_encode(array( "status"=>SUCCESS_RESPONSE, "group_unique_id"=>$unique_id, "msg"=>"successfully created" ));

  }

}


function join_investment_group_from_money_box($user_id,$investment_group_id,$amount,$slot_to_buy){
  global $dbc;
  //what should be start date
  $money_box_balance = get_money_box_bal($user_id);

  $get_investment_group_det = get_one_row_from_one_table_by_id('investment_groups','unique_id',$investment_group_id,'date_added');

  $current_slot = $get_investment_group_det['current_slot'];
  $expected_slot = $get_investment_group_det['expected_slot'];
  $new_current_slot = $current_slot + $slot_to_buy;
  $your_max_buyable_slot = $expected_slot - $current_slot;

  $check_investment_grp = check_record_by_two_params('user_investment_purchase','user_id',$user_id,'investment_group_id',$investment_group_id);


   //check 1 slot
  // if($amount < 150000){
  //         return json_encode(array( "status"=>NOT_FOUND, "msg"=>"" ));

  // }

  // else
 
  if($slot_to_buy > $your_max_buyable_slot){
          return json_encode(array( "status"=>NOT_FOUND, "msg"=>"you cannot buy more than ".$your_max_buyable_slot. "slots" ));
  }

   else if($check_investment_grp){
      
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"you have joined this investment group already" ));
      
  }

  else if($slot_to_buy >= 10){
          return json_encode(array( "status"=>NO_ACCESS, "msg"=>"you cannot buy up to 50% available slots" ));
  }

  else if($money_box_balance < $amount){
          return json_encode(array( "status"=>NOT_FOUND, "msg"=>"insufficient funds in money box" ));
  }

  else if($user_id == "" ||  $investment_group_id == "" ||  $amount == "" || $slot_to_buy == "" ){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));

  }
  else{

           $$update_current_slot = update_by_one_param('investment_groups','current_slot',$new_current_slot,'unique_id',$investment_group_id);


            $unique_id = unique_id_generator($user_id.'second');
            $sql_sec = "INSERT INTO `user_investment_purchase` SET
            `unique_id`='$unique_id',
            `user_id`='$user_id',
            `funding_source`='from_money_box',
            `investment_group_id`='$investment_group_id',
            `slots_bought`='$slot_to_buy',
            `slot_amount`='$amount',
            `date_added`=now()
            ";
            /////status will change to 0 later
            $qry_sec = mysqli_query($dbc,$sql_sec);

            return json_encode(array( "status"=>SUCCESS_RESPONSE, "group_unique_id"=>$investment_group_id, "msg"=>"successfully joined" ));
  }

}


function join_investment_group_from_bank($user_id,$investment_group_id,$amount,$slot_to_buy,$rave_transaction_id,$unique_payment_id){
  global $dbc;
  //what should be start date
  $money_box_balance = get_money_box_bal($user_id);

  $table2 = "user_investment_purchase";

  $get_investment_group_det = get_one_row_from_one_table_by_id('investment_groups','unique_id',$investment_group_id,'date_added');   

  $current_slot = $get_investment_group_det['current_slot'];
  $expected_slot = $get_investment_group_det['expected_slot'];
  $new_current_slot = $current_slot + $slot_to_buy;
  $your_max_buyable_slot = $expected_slot - $current_slot;

  $check_investment_grp = check_record_by_two_params('user_investment_purchase','user_id',$user_id,'investment_group_id',$investment_group_id);


   $crave_transaction_id = check_record_by_one_param($table2,'rave_transaction_id',$rave_transaction_id);
   $cunique_payment_id = check_record_by_one_param($table2,'unique_payment_id',$unique_payment_id);

  if($crave_transaction_id == true || $cunique_payment_id == true ){
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));
   }

  else if($check_investment_grp){
      
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"you have joined this investment group already" ));
      
  }

  else if($slot_to_buy >= 10){

          return json_encode(array( "status"=>NO_ACCESS, "msg"=>"you cannot buy up to 50% available slots" ));
  }

  else if($slot_to_buy > $your_max_buyable_slot){
          return json_encode(array( "status"=>NOT_FOUND, "msg"=>"you cannot buy more than ".$your_max_buyable_slot. " 16 slots" ));
  }


  else if($user_id == "" ||  $investment_group_id == "" ||  $amount == "" || $slot_to_buy == "" ){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));

  }
  else{

           $update_current_slot = update_by_one_param('investment_groups','current_slot',$new_current_slot,'unique_id',$investment_group_id);


            $unique_id = unique_id_generator($user_id.'second');
            $sql_sec = "INSERT INTO `user_investment_purchase` SET
            `unique_id`='$unique_id',
            `user_id`='$user_id',
            `funding_source`='from_bank',
            `rave_transaction_id`='$rave_transaction_id',
            `unique_payment_id`='$unique_payment_id',
            `investment_group_id`='$investment_group_id',
            `slots_bought`='$slot_to_buy',
            `slot_amount`='$amount',
            `date_added`=now()
            ";
            /////status will change to 0 later
            $qry_sec = mysqli_query($dbc,$sql_sec);

            return json_encode(array( "status"=>SUCCESS_RESPONSE, "group_unique_id"=>$investment_group_id, "msg"=>"successfully joined" ));
  }

}


//////run as a cron every minute
// function check_and_update_pending_transfersNOTUSEDYET(){
//   global $dbc;
//   $sqltrans = "SELECT * FROM `transactions` WHERE `status`=0 ORDER BY `date_added` DESC";
//   $qrytrans = mysqli_query($dbc,$sqltrans);
//   $count = mysqli_num_rows($qrytrans);
//   if($count > 0){
      

//       while($row = mysqli_fetch_array($qrytrans)){

//                 $transfer_id = $row['transfer_id'];

//                 if($transfer_id != null){


//                         $amount = $row['amount'];
//                         $user_id = $row['user_id'];
//                         $response = get_a_transfer($transfer_id);
//                         $deco = json_decode($response,true);
//                         $transfer_status = $deco['data']['status'];
//                         if($transfer_status == 'SUCCESSFUL'){
//                         //update transsactions status
//                         $sqlupdate = "UPDATE `transactions` SET  `status`=1, `date_confirmed`=now() WHERE `transfer_id`='$transfer_id'";
//                         $qryupdate = mysqli_query($dbc,$sqlupdate);         
                         
//                            echo "Successful Transfer:::: Status Updated<br>";
                      
//                         }
//                         else if($transfer_status == "FAILED"){
                   
//                         //this means failed
//                         $sqlupdate2 = "UPDATE `transactions` SET  `status`=2, `date_confirmed`= now() WHERE `transfer_id`='$transfer_id'";
//                         $qryupdate2 = mysqli_query($dbc,$sqlupdate2); 


//                         //return money back to wallet
//                         $get_wallet_balance = get_wallet_balance($user_id);
//                         $gwd = json_decode($get_wallet_balance,true);
//                         $new_balance =  $gwd['msg'] + $amount;

//                         $sqlupdatew = "UPDATE `wallets` SET  `balance`='$new_balance' WHERE `user_id`='$user_id'";
//                         $qryupdatew = mysqli_query($dbc,$sqlupdatew);

//                         echo "Failed Transfer:::: Status Updated<br>";
//                         }
                      
//                       else{
//                                     //case of pending
//                                    echo "do nothing";


//                         }

//                 }else{

//                        echo "Failed Transfer:::: Transfer id does not exist<br>";
//                 }




//       }
   


//   } else{

//          echo "No Pending Transfers:::: Status Updated<br>";

//   }
// }



function make_withdrawal_from_money_box_to_bank($bank_code,$amount,$user_id){
  global $dbc;
  global $secret_key;
  // $secret_key = 'FLWSECK-e4d8bf253b4be22405decd22616c3337-X';
    // $amount = secure_database($amount);
    $amount = intval($amount);
    $user_id = secure_database($user_id);


    
    $naration = "Withdrawal from Finsight";
    $naration2 = "Withdrawals from Finsight";
    $currency = "NGN";



   $get_money_box_bal_without_fee = get_money_box_bal($user_id);

   $fee = 25;
    
   $get_money_box_bal = $get_money_box_bal_without_fee - $amount - $fee; 
   
   $reference_id = unique_id_generator($amount.$user_id.'kasa');

   $actual_amount_deducted_from_money_box = $amount + $fee;

  if($get_money_box_bal < $amount){
          return json_encode(array( "status"=>NOT_FOUND, "msg"=>"Sorry, Insufficient balance in money box" ));
  }
  
  else if($amount == "" || $user_id == "" || $reference_id == ""){
          return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"Empty field(s) found" ));
    
  }else{

      $get_bank_det = get_one_row_from_one_table_by_id('bank_details','user_id',$user_id,'date_added');   
      $account_no = $get_bank_det['account_no'];
      $bank_name = $get_bank_det['bank_name'];
      $fullname = $get_bank_det['account_name'];

            $url = 'https://api.flutterwave.com/v3/transfers';
            // Collection object
            $data = [
            'account_bank' => $bank_code,
            'account_number' => $account_no,
            'amount' => $amount,
            'narration' => $narration2,
            'currency' => $currency,
            'beneficiary_name' => $fullname,
            'reference' => $reference_id,
            ];
            
            // Initializes a new cURL session
            $curl = curl_init($url);
            
            // Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            // Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            
            // Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
            
            // Set custom headers for RapidAPI Auth and Content-Type header
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$secret_key,
            'Content-Type: application/json'
            ]);
            
            // Execute cURL request with all previous settings
            $response = curl_exec($curl);
            
            // Close cURL session
            curl_close($curl);

           $response_dec = json_decode($response,true);
           $response_status = $response_dec['status'];
           $response_message = $response_dec['message'];
           $transfer_id = $response_dec['data']['id'];

           if($response_status == 'error'){
                return json_encode(array( "status"=>API_RESPONSE_ERROR, "msg"=>$response_message ));
           }
           else{
                //the transaction was successful but does not guarantee that service was given
                $unique_id = unique_id_generator($amount.$user_id);
                $transaction_details = "Withdrawal Amount of ".number_format(floatval($amount),2)." sent to Bank Account ".$account_no." from money box";
                $sql = "INSERT INTO `withdraw_money_box_to_bank` SET
                `unique_id`='$unique_id',
                `amount`='$amount',
                `transaction_details`='$transaction_details',
                `reference`='$reference_id',
                `transfer_id`='$transfer_id',
                `status`=1,
                `user_id`='$user_id',
                `date_added`=now()
                ";
                /////status will change to 0 later
                $qry = mysqli_query($dbc,$sql);


                $unique_id2 = unique_id_generator($user_id.$amount.'naso');
                $sql_insert_money_box_spent = "INSERT INTO `spend_from_money_box` SET
                `unique_id`='$unique_id2',
                `spend_type`='withdraw_to_bank',
                `amount`='$actual_amount_deducted_from_money_box',
                `user_id`='$user_id',
                `date_added`=now()
                ";
                $qry_insert_money_box_spent = mysqli_query($dbc,$sql_insert_money_box_spent);



                if($qry == true && $qry_insert_money_box_spent == true){

                return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"successful withdrawal sent to bank account", "withdrawn_amount"=>number_format(floatval($amount),2), "user_id"=>$user_id )); //pending

                }else{

                return json_encode(array( "status"=>DB_ERROR, "msg"=>"Server Error" ));

                }

           }

     
  }

  

}



function savings_top_up($user_id,$plan_id,$type,$amount,$rave_transaction_id,$unique_payment_id){
  global $dbc;
   


  if($type == 'regular'){
      $table = "user_regular_plans";
   }
   else if($type == 'halal'){
      $table = "user_halal_plans";

  }
  else if($type == "christmas"){
      $table = "user_christmas_plans";

  }
  else if($type == "ileya"){
      $table = "user_ileya_plans";

  }
  //this is 5
  else if($type == "student"){
      $table = "user_student_plans";

  }else{
              return json_encode(array( "status"=>NOT_FOUND, "msg"=>"wrong plan type" ));

  }



          $crave_transaction_id = check_record_by_one_param($table,'rave_transaction_id',$rave_transaction_id);
          $cunique_payment_id = check_record_by_one_param($table,'unique_payment_id',$unique_payment_id);
         if($crave_transaction_id == true || $cunique_payment_id == true ){
              return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));
          }

          else if($user_id == ""  ||  $plan_id == ""  ||  $type == ""  ||  $amount == ""  || $rave_transaction_id == ""  ||  $unique_payment_id == ""){
              return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty fields found" ));
          }

          else{


          //update plan balance
          //update grand wallet
          //insert into top tbl

      
          $plan_det =   get_one_row_from_one_table_by_id($table,'unique_id',$plan_id,'date_created');
          $current_bal = $plan_det['current_balance'];
          $newbal = $current_bal + $amount;
          $update_current_bal = update_by_one_param($table,'current_balance',$newbal,'unique_id',$plan_id);


          $user_det =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
          $current_wallet = $user_det['grand_wallet'];
          $new_grand_Wallet = $current_wallet + $amount;
          $update_grand_bal = update_by_one_param('users','grand_wallet',$new_grand_Wallet,'unique_id',$user_id);

          $unique_id = unique_id_generator($rave_transaction_id.$unique_payment_id);
          $sql_insert = "INSERT INTO `savings_top_up` SET
            `unique_id`='$unique_id',
            `plan_type`='$type',
            `source`='bank_account',
            `amount`='$amount',
            `plan_id`='$plan_id',
            `rave_transaction_id`='$rave_transaction_id',
            `unique_payment_id`='$unique_payment_id',
            `date_added`=now()

          ";
          $qry_insert = mysqli_query($dbc,$sql_insert);



          $get_plan_info =   get_one_row_from_one_table_by_id($table,'unique_id',$plan_id,'date_created');
          $target_amount = $get_plan_info['target_amount'];
          // $rave_transaction_id = $get_plan_info['rave_transaction_id'];
          // $unique_payment_id = $get_plan_info['unique_payment_id'];
          $daily_interest = $get_plan_info['daily_interest'];
          $user_plan_name = $get_plan_info['user_plan_name'];
          $savings_type = $get_plan_info['savings_type'];
          $opening_balance = $get_plan_info['opening_balance'];
          $current_balance = $get_plan_info['current_balance'];
          $date_created = $get_plan_info['date_created'];

          $get_grand_wallet =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
          $grand_wallet2 = $get_grand_wallet['grand_wallet'];

              return json_encode(array( "status"=>SUCCESS_RESPONSE,
                                        "topup_id"=>$unique_id,
                                        "topup_source"=>'from_bank_account',
                                         "target_amount"=> $target_amount,
                                         'target_amountf' =>  number_format(floatval($target_amount),2)  ,
                                         "grand_wallet"=> $grand_wallet2,
                                         "grand_walletf"=> number_format(floatval($grand_wallet2),2),
                                         "topup_rave_transaction_id"=> $rave_transaction_id,
                                         "topup_unique_payment_id"=> $unique_payment_id,
                                         "daily_interest"=> $daily_interest,
                                         "user_plan_name"=> $user_plan_name,
                                         "savings_type"=> $savings_type,
                                         "opening_balance"=> $opening_balance,
                                         "current_balance"=> $current_balance,
                                         "plan_creation_date"=>format_date( $date_created),   
                                         "msg"=>"top up was successful" ));


          }
   
}


function savings_top_up_from_money_box($user_id,$plan_id,$type,$amount){
  global $dbc;
   
  if($type == 'regular'){
      $table = "user_regular_plans";
   }
   else if($type == 'halal'){
      $table = "user_halal_plans";

  }
  else if($type == "christmas"){
      $table = "user_christmas_plans";

  }
  else if($type == "ileya"){
      $table = "user_ileya_plans";

  }
  //this is 5
  else if($type == "student"){
      $table = "user_student_plans";

  }else{
              return json_encode(array( "status"=>NOT_FOUND, "msg"=>"wrong plan type" ));

  }



    if($user_id == ""  ||  $plan_id == ""  ||  $type == ""  ||  $amount == "" ){
              return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty fields found" ));
          }

          else{


          $get_money_box_bal_without_fee = get_money_box_bal($user_id);
          
          $fee = 25;

          $get_money_box_bal = $get_money_box_bal_without_fee - $amount - $fee;

          $actual_amount_deducted_from_money_box = $amount + $fee;

          if($get_money_box_bal < $amount){

              return json_encode(array( "status"=>NOT_FOUND, "msg"=>"insufficient funds in money box" ));
          }
      
          $plan_det =   get_one_row_from_one_table_by_id($table,'unique_id',$plan_id,'date_created');
          $current_bal = $plan_det['current_balance'];
          $newbal = $current_bal + $amount;
          $update_current_bal = update_by_one_param($table,'current_balance',$newbal,'unique_id',$plan_id);


          $user_det =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
          $current_wallet = $user_det['grand_wallet'];
          $new_grand_Wallet = $current_wallet + $amount;
          $update_grand_bal = update_by_one_param('users','grand_wallet',$new_grand_Wallet,'unique_id',$user_id);

          $unique_id = unique_id_generator($plan_id.$amount);
          $sql_insert = "INSERT INTO `savings_top_up` SET
            `unique_id`='$unique_id',
            `plan_type`='$type',
            `source`='money_box',
            `amount`='$amount',
            `plan_id`='$plan_id',
            `date_added`=now()

          ";
          $qry_insert = mysqli_query($dbc,$sql_insert);

          $unique_id2 = unique_id_generator($amount.$plan_id);
           $sql_insert_money_box_spent = "INSERT INTO `spend_from_money_box` SET
            `unique_id`='$unique_id2',
            `plan_type`='$type',
            `spend_type`='buy_plan',
            `amount`='$actual_amount_deducted_from_money_box',
            `user_id`='$user_id',
            `plan_id`='$plan_id',
            `date_added`=now()
          ";
          $qry_insert_money_box_spent = mysqli_query($dbc,$sql_insert_money_box_spent);



          $get_plan_info =   get_one_row_from_one_table_by_id($table,'unique_id',$plan_id,'date_created');
          $target_amount = $get_plan_info['target_amount'];
          // $rave_transaction_id = $get_plan_info['rave_transaction_id'];
          // $unique_payment_id = $get_plan_info['unique_payment_id'];
          $daily_interest = $get_plan_info['daily_interest'];
          $user_plan_name = $get_plan_info['user_plan_name'];
          $savings_type = $get_plan_info['savings_type'];
          $opening_balance = $get_plan_info['opening_balance'];
          $current_balance = $get_plan_info['current_balance'];
          $date_created = $get_plan_info['date_created'];

          $get_grand_wallet =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
          $grand_wallet2 = $get_grand_wallet['grand_wallet'];

              return json_encode(array( "status"=>SUCCESS_RESPONSE,
                                        "topup_id"=>$unique_id,
                                        "topup_source"=>'from_money_box',
                                         "target_amount"=> $target_amount,
                                         'target_amountf' =>  number_format(floatval($target_amount),2),
                                         "grand_wallet"=> $grand_wallet2,
                                         "grand_walletf"=> number_format(floatval($grand_wallet2),2),
                                         "topup_rave_transaction_id"=> $rave_transaction_id,
                                         "topup_unique_payment_id"=> $unique_payment_id,
                                         "daily_interest"=> $daily_interest,
                                         "user_plan_name"=> $user_plan_name,
                                         "savings_type"=> $savings_type,
                                         "opening_balance"=> $opening_balance,
                                         "current_balance"=> $current_balance,
                                         "plan_creation_date"=>format_date( $date_created),   
                                         "msg"=>"top up was successful" ));


          }
   
}


///as at the time of logging to that plan, lock period: 3 months/ 6 months / 12 months, add rave function here
function regular_plan_creation($target_amount,$user_id,$user_plan_name,$opening_amount,$savings_type,$daily_interest,$lock_period,$rave_transaction_id,$unique_payment_id){
    global $dbc;
    $table = 'user_regular_plans';
    $current_date = date('Y-m-d');
    $lock_date = date('Y-m-d',strtotime($current_date.' + '.$lock_period.' days'));
    $check_exist  = check_record_by_one_param($table,'user_plan_name',$user_plan_name);


    if($check_exist){
    // return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"record exists" ));
    $user_plan_name = $user_plan_name.'2';
    }


   $crave_transaction_id = check_record_by_one_param($table,'rave_transaction_id',$rave_transaction_id);
   $cunique_payment_id = check_record_by_one_param($table,'unique_payment_id',$unique_payment_id);

   if($crave_transaction_id == true || $cunique_payment_id == true ){
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));
   }

  else if($target_amount == "" || $user_plan_name == "" || $daily_interest == "" || $savings_type == "" || $opening_amount == ""  || $lock_period == "" || $user_id == "" || $rave_transaction_id == "" || $unique_payment_id == ""){
        return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));
      }

  else{

      $get_current_bal =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
      $current_bal = $get_current_bal['grand_wallet'];
      $newbal = $current_bal + $opening_amount;

      ///update wallet balance
      $update_grand_bal = update_by_one_param('users','grand_wallet',$newbal,'unique_id',$user_id);


        $unique_id = unique_id_generator($user_plan_name);
        $sql = "INSERT INTO  `$table` SET
        `unique_id`='$unique_id',
        `user_id`='$user_id',
        `target_amount`='$target_amount',
        `rave_transaction_id`='$rave_transaction_id',
        `unique_payment_id`='$unique_payment_id',
        `daily_interest`='$daily_interest',
        `user_plan_name`='$user_plan_name',
        `savings_type`='$savings_type',
        `opening_balance`= '$opening_amount',
        `current_balance`= '$opening_amount',
        `lock_period`='$lock_period',     
        `lock_date`='$lock_date',     
        `date_created`=now()
        ";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"user regular plan successfully created" ));

        }else{
        return json_encode(array( "status"=>DB_ERROR, "msg"=>"a server error occured" ));

        }

  }

}


function halal_plan_creation($target_amount,$user_id,$user_plan_name,$opening_amount,$savings_type,$daily_interest,$lock_period,$rave_transaction_id,$unique_payment_id){
    global $dbc;
    $table = 'user_halal_plans';
    $current_date = date('Y-m-d');
    $lock_date = date('Y-m-d',strtotime($current_date.' + '.$lock_period.' days'));
    $check_exist  = check_record_by_one_param($table,'user_plan_name',$user_plan_name);


    if($check_exist){
    // return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"record exists" ));
      $user_plan_name = $user_plan_name.'2';
    }

   $crave_transaction_id = check_record_by_one_param($table,'rave_transaction_id',$rave_transaction_id);
   $cunique_payment_id = check_record_by_one_param($table,'unique_payment_id',$unique_payment_id);

   if($crave_transaction_id == true || $cunique_payment_id == true ){
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));
   }

  else if($target_amount == "" || $user_plan_name == "" || $opening_amount == ""   || $savings_type == ""  || $lock_period == "" || $daily_interest == "" || $user_id == "" || $rave_transaction_id == "" || $unique_payment_id == ""){
        return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));
      }

  else{


        $get_current_bal =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
        $current_bal = $get_current_bal['grand_wallet'];
        $newbal = $current_bal + $opening_amount;

        ///update wallet balance
        $update_grand_bal = update_by_one_param('users','grand_wallet',$newbal,'unique_id',$user_id);

        $unique_id = unique_id_generator($user_plan_name);
        $sql = "INSERT INTO  `$table` SET
        `unique_id`='$unique_id',
        `user_id`='$user_id',
        `target_amount` = '$target_amount',
        `rave_transaction_id`='$rave_transaction_id',
        `unique_payment_id`='$unique_payment_id',
        `daily_interest`= 0,
        `user_plan_name`='$user_plan_name',
        `savings_type`='$savings_type',
        `opening_balance`= '$opening_amount',
        `current_balance`= '$opening_amount',
        `lock_period`='$lock_period',     
        `lock_date`='$lock_date',     
        `date_created`=now()
        ";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"user halal plan successfully created" ));

        }else{
        return json_encode(array( "status"=>DB_ERROR, "msg"=>"a server error occured" ));

        }

  }

}



function christmas_plan_creation($target_amount,$user_id,$user_plan_name,$opening_amount,$savings_type,$daily_interest,$rave_transaction_id,$unique_payment_id){
    global $dbc;
    $table = 'user_christmas_plans';
    $christmas_date = date('Y-12-25');
    $lock_date = date('Y-m-d',strtotime($christmas_date.' - 4 days'));
    $check_exist  = check_record_by_one_param($table,'user_plan_name',$user_plan_name);


    if($check_exist){
    // return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"record exists" ));
      $user_plan_name = $user_plan_name.'2';
    }

   $crave_transaction_id = check_record_by_one_param($table,'rave_transaction_id',$rave_transaction_id);
   $cunique_payment_id = check_record_by_one_param($table,'unique_payment_id',$unique_payment_id);

   if($crave_transaction_id == true || $cunique_payment_id == true ){
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));
   }

  else if($target_amount =="" || $user_plan_name == "" || $opening_amount == ""  || $daily_interest == ""  || $savings_type == ""  || $user_id == "" || $rave_transaction_id == "" || $unique_payment_id == ""){
        return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));
      }

  else{
  
        $get_current_bal =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
        $current_bal = $get_current_bal['grand_wallet'];
        $newbal = $current_bal + $opening_amount;

        ///update wallet balance
        $update_grand_bal = update_by_one_param('users','grand_wallet',$newbal,'unique_id',$user_id);


        $unique_id = unique_id_generator($user_plan_name);
        $sql = "INSERT INTO  `$table` SET
        `unique_id`='$unique_id',
        `user_id`='$user_id',
        `target_amount`='$target_amount',
        `rave_transaction_id`='$rave_transaction_id',
        `unique_payment_id`='$unique_payment_id',
        `daily_interest`= '$daily_interest',
        `user_plan_name`='$user_plan_name',
        `savings_type`='$savings_type',
        `opening_balance`= '$opening_amount', 
        `current_balance`= '$opening_amount',
        `lock_date`='$lock_date',
        `date_created`=now()
        ";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"user christmas plan successfully created" ));

        }else{
        return json_encode(array( "status"=>DB_ERROR, "msg"=>"a server error occured" ));

        }

  }

}


function ileya_plan_creation($target_amount,$user_id,$user_plan_name,$opening_amount,$savings_type,$daily_interest,$rave_transaction_id,$unique_payment_id){
    global $dbc;
    $table = 'user_ileya_plans';
    $ileya_date = date('2021-07-20');
    $lock_date = date('Y-m-d',strtotime($ileya_date.' - 4 days'));
    $check_exist  = check_record_by_one_param($table,'user_plan_name',$user_plan_name);


    if($check_exist){
    // return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"record exists" ));
      $user_plan_name = $user_plan_name.'2';
    }

   $crave_transaction_id = check_record_by_one_param($table,'rave_transaction_id',$rave_transaction_id);
   $cunique_payment_id = check_record_by_one_param($table,'unique_payment_id',$unique_payment_id);

   if($crave_transaction_id == true || $cunique_payment_id == true ){
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));
   }

  else if($target_amount == "" || $user_plan_name == "" || $opening_amount == ""  || $daily_interest == ""  || $savings_type == "" || $user_id == "" || $rave_transaction_id == "" || $unique_payment_id == ""){
        return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));
      }

  else{

        $get_current_bal =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
        $current_bal = $get_current_bal['grand_wallet'];
        $newbal = $current_bal + $opening_amount;

        ///update wallet balance
        $update_grand_bal = update_by_one_param('users','grand_wallet',$newbal,'unique_id',$user_id);

        $unique_id = unique_id_generator($user_plan_name);
        $sql = "INSERT INTO  `$table` SET
        `unique_id`='$unique_id',
        `user_id`='$user_id',
        `target_amount`='$target_amount',
        `rave_transaction_id`='$rave_transaction_id',
        `unique_payment_id`='$unique_payment_id',
        `daily_interest`= '$daily_interest',
        `user_plan_name`='$user_plan_name',
        `savings_type`='$savings_type',
        `opening_balance`= '$opening_amount',    
        `current_balance`= '$opening_amount',    
        `lock_date`='$lock_date',     
        `date_created`=now()
        ";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"user ileya plan successfully created" ));

        }else{
        return json_encode(array( "status"=>DB_ERROR, "msg"=>"a server error occured" ));

        }

  }

}


function student_plan_creation($target_amount,$user_id,$user_plan_name,$opening_amount,$savings_type,$savings_goal,$daily_interest,$lock_period,$rave_transaction_id,$unique_payment_id){
    global $dbc;
    $table = 'user_student_plans';
    $current_date = date('Y-m-d');

    if($lock_period != ""){
          $lock_period2 = $lock_period;
          $lock_date = date('Y-m-d',strtotime($current_date.' + '.$lock_period.' days'));
    }else{
          $lock_period2 = NULL;
          $lock_date = NULL;
    }

    $check_exist  = check_record_by_one_param($table,'user_plan_name',$user_plan_name);


    if($check_exist){
    // return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"record exists" ));
      $user_plan_name = $user_plan_name.'2';
    }

   $crave_transaction_id = check_record_by_one_param($table,'rave_transaction_id',$rave_transaction_id);
   $cunique_payment_id = check_record_by_one_param($table,'unique_payment_id',$unique_payment_id);

   if($crave_transaction_id == true || $cunique_payment_id == true ){
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));
   }

  else if( $target_amount == "" || $user_plan_name == "" || $savings_goal == "" || $opening_amount == ""  || $daily_interest == ""  || $savings_type == "" || $user_id == "" || $rave_transaction_id == "" || $unique_payment_id == ""){
        return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));
      }

  else{
        $get_current_bal =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
        $current_bal = $get_current_bal['grand_wallet'];
        $newbal = $current_bal + $opening_amount;

        ///update wallet balance
        $update_grand_bal = update_by_one_param('users','grand_wallet',$newbal,'unique_id',$user_id);



        $unique_id = unique_id_generator($user_plan_name);
        $sql = "INSERT INTO  `$table` SET
        `unique_id`='$unique_id',
        `user_id`='$user_id',
        `target_amount`='$target_amount',
        `rave_transaction_id`='$rave_transaction_id',
        `unique_payment_id`='$unique_payment_id',
        `daily_interest`= '$daily_interest',
        `user_plan_name`='$user_plan_name',
        `savings_type`='$savings_type',
        `savings_goal`='$savings_goal',
        `opening_balance`= '$opening_amount',    
        `current_balance`= '$opening_amount',    
        `lock_date`='$lock_date', 
        `lock_period`='$lock_period2', 
        `date_created`=now()
        ";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"user student plan successfully created" ));

        }else{
        return json_encode(array( "status"=>DB_ERROR, "msg"=>"a server error occured" ));

        }

  }

}


// function get_earnings_per_user(){
//   global $dbc;
// }


function get_all_balances_per_user($user_id){
  global $dbc;
  

  $money_box_bal = get_money_box_bal($user_id);

  $get_user_det = get_one_row_by_id('users','unique_id',$user_id);
  if($get_user_det == null){
    $grand_wallet_balance = 0;
  }else{
    $grand_wallet_balance = $get_user_det['grand_wallet'];
  }

  ///plans current balance
  $array_master = array();
  $array_grand_master = array();
  //regular
  $get_regular = get_rows_from_one_table_by_id('user_regular_plans','user_id',$user_id,'date_created');
  if($get_regular != null){
  //     $array_regular  = array();
  //     array_push($array_master, $array_regular);
  // }else{
    foreach ($get_regular as $regular) {
        $array_regular = array(
          'plan_category' => "regular",
          'plan_id' =>  $regular['unique_id'],
          'rave_transaction_id' =>  $regular['rave_transaction_id'],
          'unique_payment_id' =>  $regular['unique_payment_id'],
          'daily_interest' =>  $regular['daily_interest'],
          'user_plan_name' =>  $regular['user_plan_name'],
          'savings_type' =>  $regular['savings_type'],
         'opening_balance' =>  $regular['opening_balance'],
          'current_balance' => $regular['current_balance'],
          'opening_balancef' =>  number_format(floatval($regular['opening_balance']),2),
          'current_balancef' => number_format(floatval($regular['current_balance']),2),
          'target_amount' => $regular['target_amount'],
          'target_amountf' =>  number_format(floatval($regular['target_amount']),2),
          'lock_period' =>  $regular['lock_period'],
          'lock_date' =>  format_date($regular['lock_date']),
          'date_created' =>  format_date($regular['date_created'])
        );
        array_push($array_master, $array_regular);
    }
  }




  //halal
  $get_halal = get_rows_from_one_table_by_id('user_halal_plans','user_id',$user_id,'date_created');
   if($get_halal != null){
  //     $array_halal  = array();
  //     array_push($array_master, $array_halal);
  // }else{
    foreach ($get_halal as $halal) {
        $array_halal = array(
          'plan_category' => "halal",
          'plan_id' =>  $halal['unique_id'],
          'rave_transaction_id' =>  $halal['rave_transaction_id'],
          'unique_payment_id' =>  $halal['unique_payment_id'],
          'daily_interest' =>  $halal['daily_interest'],
          'user_plan_name' =>  $halal['user_plan_name'],
          'savings_type' =>  $halal['savings_type'],
         'opening_balance' =>  $halal['opening_balance'],
          'current_balance' => $halal['current_balance'],
          'opening_balancef' =>  number_format(floatval($halal['opening_balance']),2),
          'current_balancef' => number_format(floatval($halal['current_balance']),2),
          'target_amount' => $halal['target_amount'],
          'target_amountf' =>  number_format(floatval($halal['target_amount']),2),
          'lock_period' =>  $halal['lock_period'],
          'lock_date' =>  format_date($halal['lock_date']),
          'date_created' =>  format_date($halal['date_created'])
        );
        array_push($array_master, $array_halal);
    }
  }

  //christmas
  $get_christmas = get_rows_from_one_table_by_id('user_christmas_plans','user_id',$user_id,'date_created');
     if($get_christmas != null){
  //     $array_christmas  = array();
  //     array_push($array_master, $array_christmas);
  // }else{
    foreach ($get_christmas as $christmas) {
        $array_christmas = array(
          'plan_category' => "christmas",
          'plan_id' =>  $christmas['unique_id'],
          'rave_transaction_id' =>  $christmas['rave_transaction_id'],
          'unique_payment_id' =>  $christmas['unique_payment_id'],
          'daily_interest' =>  $christmas['daily_interest'],
          'user_plan_name' =>  $christmas['user_plan_name'],
          'savings_type' =>  $christmas['savings_type'],
          'opening_balance' =>  $christmas['opening_balance'],
          'current_balance' => $christmas['current_balance'],
          'opening_balancef' =>  number_format(floatval($christmas['opening_balance']),2),
          'current_balancef' => number_format(floatval($christmas['current_balance']),2),
          'target_amount' => $christmas['target_amount'],
          'target_amountf' =>  number_format(floatval($christmas['target_amount']),2),
          'lock_date' =>  format_date($christmas['lock_date']),
          'date_created' =>  format_date($christmas['date_created'])
        );
        array_push($array_master, $array_christmas);
    }
  }



  //ileya
  $get_ileya = get_rows_from_one_table_by_id('user_ileya_plans','user_id',$user_id,'date_created');
       if($get_ileya != null){
  //     $array_ileya  = array();
  //     array_push($array_master, $array_ileya);
  // }else{
    foreach ($get_ileya as $ileya) {
        $array_ileya = array(
          'plan_category' => "ileya",
          'plan_id' =>  $ileya['unique_id'],
          'rave_transaction_id' =>  $ileya['rave_transaction_id'],
          'unique_payment_id' =>  $ileya['unique_payment_id'],
          'daily_interest' =>  $ileya['daily_interest'],
          'user_plan_name' =>  $ileya['user_plan_name'],
          'savings_type' =>  $ileya['savings_type'],
          'opening_balance' =>  $ileya['opening_balance'],
          'current_balance' => $ileya['current_balance'],
          'opening_balancef' =>  number_format(floatval($ileya['opening_balance']),2),
          'current_balancef' => number_format(floatval($ileya['current_balance']),2),
          'target_amount' => $ileya['target_amount'],
          'target_amountf' =>  number_format(floatval($ileya['target_amount']),2),
          'lock_date' =>  format_date($ileya['lock_date']),
          'date_created' =>  format_date($ileya['date_created'])
        );
        array_push($array_master, $array_ileya);
    }
  }

  //student
  $get_student = get_rows_from_one_table_by_id('user_student_plans','user_id',$user_id,'date_created');
    if($get_student != null){
  //     $array_student  = array();
  //     array_push($array_master, $array_student);
  // }else{
    foreach ($get_student as $student) {
        $array_student = array(
          'plan_category' => "student",
          'plan_id' =>  $student['unique_id'],
          'rave_transaction_id' =>  $student['rave_transaction_id'],
          'unique_payment_id' =>  $student['unique_payment_id'],
          'daily_interest' =>  $student['daily_interest'],
          'user_plan_name' =>  $student['user_plan_name'],
          'savings_type' =>  $student['savings_type'],
         'opening_balance' =>  $student['opening_balance'],
          'current_balance' => $student['current_balance'],
          'opening_balancef' =>  number_format(floatval($student['opening_balance']),2),
          'current_balancef' => number_format(floatval($student['current_balance']),2),
          'target_amount' => $student['target_amount'],
          'target_amountf' =>  number_format(floatval($student['target_amount']),2),
          'lock_period' =>  $student['lock_period'],
          'lock_date' =>  format_date($student['lock_date']),
          'date_created' =>  format_date($student['date_created'])
        );
        array_push($array_master, $array_student);
    }
  }

  $get_user_det = get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
  $fullname = $get_user_det['fname'].' '.$get_user_det['lname'];

  return json_encode(array("status"=>SUCCESS_RESPONSE, "msg"=>"Balances successfully pulled for ".$fullname, "money_box_balance"=>$money_box_bal, "money_box_balancef"=>number_format(floatval($money_box_bal),2),  "grand_wallet"=>$grand_wallet_balance, "grand_walletf"=>number_format(floatval($grand_wallet_balance),2), "plans_info"=>$array_master));


}



function get_plans_per_user($user_id){
  global $dbc;
  $array_master = array();
  $array_grand_master = array();
  //regular
  $get_regular = get_rows_from_one_table_by_id('user_regular_plans','user_id',$user_id,'date_created');
  if($get_regular != null){
  //     $array_regular  = array();
  //     array_push($array_master, $array_regular);
  // }else{
    foreach ($get_regular as $regular) {
        $array_regular = array(
          'plan_category' => "regular",
          'plan_id' =>  $regular['unique_id'],
          'rave_transaction_id' =>  $regular['rave_transaction_id'],
          'unique_payment_id' =>  $regular['unique_payment_id'],
          'daily_interest' =>  $regular['daily_interest'],
          'user_plan_name' =>  $regular['user_plan_name'],
          'savings_type' =>  $regular['savings_type'],
         'opening_balance' =>  $regular['opening_balance'],
          'current_balance' => $regular['current_balance'],
          'opening_balancef' =>  number_format(floatval($regular['opening_balance']),2),
          'current_balancef' => number_format(floatval($regular['current_balance']),2),
          'target_amount' => $regular['target_amount'],
          'target_amountf' =>  number_format(floatval($regular['target_amount']),2),
          'lock_period' =>  $regular['lock_period'],
          'lock_date' =>  format_date($regular['lock_date']),
          'date_created' =>  format_date($regular['date_created'])
        );
        array_push($array_master, $array_regular);
    }
  }




  //halal
  $get_halal = get_rows_from_one_table_by_id('user_halal_plans','user_id',$user_id,'date_created');
   if($get_halal != null){
  //     $array_halal  = array();
  //     array_push($array_master, $array_halal);
  // }else{
    foreach ($get_halal as $halal) {
        $array_halal = array(
          'plan_category' => "halal",
          'plan_id' =>  $halal['unique_id'],
          'rave_transaction_id' =>  $halal['rave_transaction_id'],
          'unique_payment_id' =>  $halal['unique_payment_id'],
          'daily_interest' =>  $halal['daily_interest'],
          'user_plan_name' =>  $halal['user_plan_name'],
          'savings_type' =>  $halal['savings_type'],
         'opening_balance' =>  $halal['opening_balance'],
          'current_balance' => $halal['current_balance'],
          'opening_balancef' =>  number_format(floatval($halal['opening_balance']),2),
          'current_balancef' => number_format(floatval($halal['current_balance']),2),
          'target_amount' => $halal['target_amount'],
          'target_amountf' =>  number_format(floatval($halal['target_amount']),2),
          'lock_period' =>  $halal['lock_period'],
          'lock_date' =>  format_date($halal['lock_date']),
          'date_created' =>  format_date($halal['date_created'])
        );
        array_push($array_master, $array_halal);
    }
  }

  //christmas
  $get_christmas = get_rows_from_one_table_by_id('user_christmas_plans','user_id',$user_id,'date_created');
     if($get_christmas != null){
  //     $array_christmas  = array();
  //     array_push($array_master, $array_christmas);
  // }else{
    foreach ($get_christmas as $christmas) {
        $array_christmas = array(
          'plan_category' => "christmas",
          'plan_id' =>  $christmas['unique_id'],
          'rave_transaction_id' =>  $christmas['rave_transaction_id'],
          'unique_payment_id' =>  $christmas['unique_payment_id'],
          'daily_interest' =>  $christmas['daily_interest'],
          'user_plan_name' =>  $christmas['user_plan_name'],
          'savings_type' =>  $christmas['savings_type'],
          'opening_balance' =>  $christmas['opening_balance'],
          'current_balance' => $christmas['current_balance'],
          'opening_balancef' =>  number_format(floatval($christmas['opening_balance']),2),
          'current_balancef' => number_format(floatval($christmas['current_balance']),2),
          'target_amount' => $christmas['target_amount'],
          'target_amountf' =>  number_format(floatval($christmas['target_amount']),2),
          'lock_date' =>  format_date($christmas['lock_date']),
          'date_created' =>  format_date($christmas['date_created'])
        );
        array_push($array_master, $array_christmas);
    }
  }



  //ileya
  $get_ileya = get_rows_from_one_table_by_id('user_ileya_plans','user_id',$user_id,'date_created');
       if($get_ileya != null){
  //     $array_ileya  = array();
  //     array_push($array_master, $array_ileya);
  // }else{
    foreach ($get_ileya as $ileya) {
        $array_ileya = array(
          'plan_category' => "ileya",
          'plan_id' =>  $ileya['unique_id'],
          'rave_transaction_id' =>  $ileya['rave_transaction_id'],
          'unique_payment_id' =>  $ileya['unique_payment_id'],
          'daily_interest' =>  $ileya['daily_interest'],
          'user_plan_name' =>  $ileya['user_plan_name'],
          'savings_type' =>  $ileya['savings_type'],
          'opening_balance' =>  $ileya['opening_balance'],
          'current_balance' => $ileya['current_balance'],
          'opening_balancef' =>  number_format(floatval($ileya['opening_balance']),2),
          'current_balancef' => number_format(floatval($ileya['current_balance']),2),
          'target_amount' => $ileya['target_amount'],
          'target_amountf' =>  number_format(floatval($ileya['target_amount']),2),
          'lock_date' =>  format_date($ileya['lock_date']),
          'date_created' =>  format_date($ileya['date_created'])
        );
        array_push($array_master, $array_ileya);
    }
  }

  //student
  $get_student = get_rows_from_one_table_by_id('user_student_plans','user_id',$user_id,'date_created');
    if($get_student != null){
  //     $array_student  = array();
  //     array_push($array_master, $array_student);
  // }else{
    foreach ($get_student as $student) {
        $array_student = array(
          'plan_category' => "student",
          'plan_id' =>  $student['unique_id'],
          'rave_transaction_id' =>  $student['rave_transaction_id'],
          'unique_payment_id' =>  $student['unique_payment_id'],
          'daily_interest' =>  $student['daily_interest'],
          'user_plan_name' =>  $student['user_plan_name'],
          'savings_type' =>  $student['savings_type'],
         'opening_balance' =>  $student['opening_balance'],
          'current_balance' => $student['current_balance'],
          'opening_balancef' =>  number_format(floatval($student['opening_balance']),2),
          'current_balancef' => number_format(floatval($student['current_balance']),2),
          'target_amount' => $student['target_amount'],
          'target_amountf' =>  number_format(floatval($student['target_amount']),2),
          'lock_period' =>  $student['lock_period'],
          'lock_date' =>  format_date($student['lock_date']),
          'date_created' =>  format_date($student['date_created'])
        );
        array_push($array_master, $array_student);
    }
  }

  $get_user_det = get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
  $fullname = $get_user_det['fname'].' '.$get_user_det['lname'];

  return json_encode(array("status"=>SUCCESS_RESPONSE, "msg"=>"plans successfully pulled for ".$fullname, "data"=>$array_master));

}


function get_money_box_txns_per_user($user_id){
  global $dbc;
  $array_master = array();
  $array_grand_master = array();
  $get_money_box_det = get_rows_from_one_table_by_id('money_box','user_id',$user_id,'date_added');

  if($get_money_box_det == null){
      return json_encode(array( "status"=>NOT_FOUND, "msg"=>"no transaction record found" ));
  }


  foreach ($get_money_box_det as  $value) {
    $plan_id  = $value['plan_id'];
    $regular = get_one_row_from_one_table_by_id('user_regular_plans','unique_id',$plan_id,'date_created');
     $halal = get_one_row_from_one_table_by_id('user_regular_plans','unique_id',$plan_id,'date_created');
    $christmas = get_one_row_from_one_table_by_id('user_regular_plans','unique_id',$plan_id,'date_created');
    $ileya = get_one_row_from_one_table_by_id('user_regular_plans','unique_id',$plan_id,'date_created');
    $student = get_one_row_from_one_table_by_id('user_regular_plans','unique_id',$plan_id,'date_created');

    if($regular != null){

             $array_regular = array(
          'plan_category' => "regular",
          'plan_id' =>  $regular['unique_id'],
          'amount_withdrawn' =>  $value['amount'],
          'amount_withdrawnf' =>  number_format(floatval($value['amount']),2),
          'rave_transaction_id' =>  $regular['rave_transaction_id'],
          'unique_payment_id' =>  $regular['unique_payment_id'],
          'daily_interest' =>  $regular['daily_interest'],
          'user_plan_name' =>  $regular['user_plan_name'],
          'savings_type' =>  $regular['savings_type'],
         'opening_balance' =>  $regular['opening_balance'],
          'current_balance' => $regular['current_balance'],
          'opening_balancef' =>  number_format(floatval($regular['opening_balance']),2),
          'current_balancef' => number_format(floatval($regular['current_balance']),2),
          'target_amount' => $regular['target_amount'],
          'target_amountf' =>  number_format(floatval($regular['target_amount']),2),
          'lock_period' =>  $regular['lock_period'],
          'lock_date' =>  format_date($regular['lock_date']),
          'date_created' =>  format_date($regular['date_created'])
        );
        array_push($array_master, $array_regular);

    }else if($halal != null){

      $array_halal = array(
          'plan_category' => "halal",
          'plan_id' =>  $halal['unique_id'],
           'amount_withdrawn' =>  $value['amount'],
          'amount_withdrawnf' =>  number_format(floatval($value['amount']),2),
          'rave_transaction_id' =>  $halal['rave_transaction_id'],
          'unique_payment_id' =>  $halal['unique_payment_id'],
          'daily_interest' =>  $halal['daily_interest'],
          'user_plan_name' =>  $halal['user_plan_name'],
          'savings_type' =>  $halal['savings_type'],
         'opening_balance' =>  $halal['opening_balance'],
          'current_balance' => $halal['current_balance'],
          'opening_balancef' =>  number_format(floatval($halal['opening_balance']),2),
          'current_balancef' => number_format(floatval($halal['current_balance']),2),
          'target_amount' => $halal['target_amount'],
          'target_amountf' =>  number_format(floatval($halal['target_amount']),2),
          'lock_period' =>  $halal['lock_period'],
          'lock_date' =>  format_date($halal['lock_date']),
          'date_created' =>  format_date($halal['date_created'])
        );
        array_push($array_master, $array_halal);

    }else if($christmas != null){
           $array_christmas = array(
          'plan_category' => "christmas",
          'plan_id' =>  $christmas['unique_id'],
           'amount_withdrawn' =>  $value['amount'],
          'amount_withdrawnf' =>  number_format(floatval($value['amount']),2),
          'rave_transaction_id' =>  $christmas['rave_transaction_id'],
          'unique_payment_id' =>  $christmas['unique_payment_id'],
          'daily_interest' =>  $christmas['daily_interest'],
          'user_plan_name' =>  $christmas['user_plan_name'],
          'savings_type' =>  $christmas['savings_type'],
          'opening_balance' =>  $christmas['opening_balance'],
          'current_balance' => $christmas['current_balance'],
          'opening_balancef' =>  number_format(floatval($christmas['opening_balance']),2),
          'current_balancef' => number_format(floatval($christmas['current_balance']),2),
          'target_amount' => $christmas['target_amount'],
          'target_amountf' =>  number_format(floatval($christmas['target_amount']),2),
          'lock_date' =>  format_date($christmas['lock_date']),
          'date_created' =>  format_date($christmas['date_created'])
        );
        array_push($array_master, $array_christmas);
    }else if($ileya != null){

       $array_ileya = array(
          'plan_category' => "ileya",
          'plan_id' =>  $ileya['unique_id'],
           'amount_withdrawn' =>  $value['amount'],
          'amount_withdrawnf' =>  number_format(floatval($value['amount']),2),
          'rave_transaction_id' =>  $ileya['rave_transaction_id'],
          'unique_payment_id' =>  $ileya['unique_payment_id'],
          'daily_interest' =>  $ileya['daily_interest'],
          'user_plan_name' =>  $ileya['user_plan_name'],
          'savings_type' =>  $ileya['savings_type'],
          'opening_balance' =>  $ileya['opening_balance'],
          'current_balance' => $ileya['current_balance'],
          'opening_balancef' =>  number_format(floatval($ileya['opening_balance']),2),
          'current_balancef' => number_format(floatval($ileya['current_balance']),2),
          'target_amount' => $ileya['target_amount'],
          'target_amountf' =>  number_format(floatval($ileya['target_amount']),2),
          'lock_date' =>  format_date($ileya['lock_date']),
          'date_created' =>  format_date($ileya['date_created'])
        );
        array_push($array_master, $array_ileya);

    }else if($student != null){
            $array_student = array(
          'plan_category' => "student",
          'plan_id' =>  $student['unique_id'],
           'amount_withdrawn' =>  $value['amount'],
          'amount_withdrawnf' =>  number_format(floatval($value['amount']),2),
          'rave_transaction_id' =>  $student['rave_transaction_id'],
          'unique_payment_id' =>  $student['unique_payment_id'],
          'daily_interest' =>  $student['daily_interest'],
          'user_plan_name' =>  $student['user_plan_name'],
          'savings_type' =>  $student['savings_type'],
         'opening_balance' =>  $student['opening_balance'],
          'current_balance' => $student['current_balance'],
          'opening_balancef' =>  number_format(floatval($student['opening_balance']),2),
          'current_balancef' => number_format(floatval($student['current_balance']),2),
          'target_amount' => $student['target_amount'],
          'target_amountf' =>  number_format(floatval($student['target_amount']),2),
          'lock_period' =>  $student['lock_period'],
          'lock_date' =>  format_date($student['lock_date']),
          'date_created' =>  format_date($student['date_created'])
        );
        array_push($array_master, $array_student);
    }else{
      // return json_encode(array( "status"=>NOT_FOUND, "msg"=>"no plan found" ));//dont return but countzz

    }

   



  }

  

 
  $get_user_det = get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
  $fullname = $get_user_det['fname'].' '.$get_user_det['lname'];

  return json_encode(array("status"=>SUCCESS_RESPONSE, "msg"=>"money box transactions plans successfully pulled for ".$fullname, "data"=>$array_master));

}



function get_plans_per_user_another_version($user_id){
  global $dbc;
  $array_master = array();
  $array_grand_master = array();
  //regular
  $get_regular = get_rows_from_one_table_by_id('user_regular_plans','user_id',$user_id,'date_created');
  if($get_regular == null){
      $array_regular  = array();
      array_push($array_master, $array_regular);
  }else{
    foreach ($get_regular as $regular) {
        $array_regular = array(
          'plan_category' => "regular",
          'plan_id' =>  $regular['unique_id'],
          'rave_transaction_id' =>  $regular['rave_transaction_id'],
          'unique_payment_id' =>  $regular['unique_payment_id'],
          'daily_interest' =>  $regular['daily_interest'],
          'user_plan_name' =>  $regular['user_plan_name'],
          'savings_type' =>  $regular['savings_type'],
         'opening_balance' =>  $regular['opening_balance'],
          'current_balance' => $regular['current_balance'],
          'opening_balancef' =>  number_format(floatval($regular['opening_balance']),2),
          'current_balancef' => number_format(floatval($regular['current_balance']),2),
          'lock_period' =>  $regular['lock_period'],
          'lock_date' =>  format_date($regular['lock_date']),
          'date_created' =>  format_date($regular['date_created'])
        );
        array_push($array_master, $array_regular);
    }
  }




  //halal
  $get_halal = get_rows_from_one_table_by_id('user_halal_plans','user_id',$user_id,'date_created');
   if($get_halal == null){
      $array_halal  = array();
      array_push($array_master, $array_halal);
  }else{
    foreach ($get_halal as $halal) {
        $array_halal = array(
          'plan_category' => "halal",
          'plan_id' =>  $halal['unique_id'],
          'rave_transaction_id' =>  $halal['rave_transaction_id'],
          'unique_payment_id' =>  $halal['unique_payment_id'],
          'daily_interest' =>  $halal['daily_interest'],
          'user_plan_name' =>  $halal['user_plan_name'],
          'savings_type' =>  $halal['savings_type'],
         'opening_balance' =>  $halal['opening_balance'],
          'current_balance' => $halal['current_balance'],
          'opening_balancef' =>  number_format(floatval($halal['opening_balance']),2),
          'current_balancef' => number_format(floatval($halal['current_balance']),2),
          'lock_period' =>  $halal['lock_period'],
           'lock_date' =>  format_date($halal['lock_date']),
          'date_created' =>  format_date($halal['date_created'])
        );
        array_push($array_master, $array_halal);
    }
  }

  //christmas
  $get_christmas = get_rows_from_one_table_by_id('user_christmas_plans','user_id',$user_id,'date_created');
     if($get_christmas == null){
      $array_christmas  = array();
      array_push($array_master, $array_christmas);
  }else{
    foreach ($get_christmas as $christmas) {
        $array_christmas = array(
          'plan_category' => "christmas",
          'plan_id' =>  $christmas['unique_id'],
          'rave_transaction_id' =>  $christmas['rave_transaction_id'],
          'unique_payment_id' =>  $christmas['unique_payment_id'],
          'daily_interest' =>  $christmas['daily_interest'],
          'user_plan_name' =>  $christmas['user_plan_name'],
          'savings_type' =>  $christmas['savings_type'],
          'opening_balance' =>  $christmas['opening_balance'],
          'current_balance' => $christmas['current_balance'],
          'opening_balancef' =>  number_format(floatval($christmas['opening_balance']),2),
          'current_balancef' => number_format(floatval($christmas['current_balance']),2),
          'lock_date' =>  format_date($christmas['lock_date']),
          'date_created' =>  format_date($christmas['date_created'])

        );
        array_push($array_master, $array_christmas);
    }
  }



  //ileya
  $get_ileya = get_rows_from_one_table_by_id('user_ileya_plans','user_id',$user_id,'date_created');
       if($get_ileya == null){
      $array_ileya  = array();
      array_push($array_master, $array_ileya);
  }else{
    foreach ($get_ileya as $ileya) {
        $array_ileya = array(
          'plan_category' => "ileya",
          'plan_id' =>  $ileya['unique_id'],
          'rave_transaction_id' =>  $ileya['rave_transaction_id'],
          'unique_payment_id' =>  $ileya['unique_payment_id'],
          'daily_interest' =>  $ileya['daily_interest'],
          'user_plan_name' =>  $ileya['user_plan_name'],
          'savings_type' =>  $ileya['savings_type'],
          'opening_balance' =>  $ileya['opening_balance'],
          'current_balance' => $ileya['current_balance'],
          'opening_balancef' =>  number_format(floatval($ileya['opening_balance']),2),
          'current_balancef' => number_format(floatval($ileya['current_balance']),2),
          'lock_date' =>  format_date($ileya['lock_date']),
          'date_created' =>  format_date($ileya['date_created'])
        );
        array_push($array_master, $array_ileya);
    }
  }

  //student
  $get_student = get_rows_from_one_table_by_id('user_student_plans','user_id',$user_id,'date_created');
    if($get_student == null){
      $array_student  = array();
      array_push($array_master, $array_student);
  }else{
    foreach ($get_student as $student) {
        $array_student = array(
          'plan_category' => "student",
          'plan_id' =>  $student['unique_id'],
          'rave_transaction_id' =>  $student['rave_transaction_id'],
          'unique_payment_id' =>  $student['unique_payment_id'],
          'daily_interest' =>  $student['daily_interest'],
          'user_plan_name' =>  $student['user_plan_name'],
          'savings_type' =>  $student['savings_type'],
         'opening_balance' =>  $student['opening_balance'],
          'current_balance' => $student['current_balance'],
          'opening_balancef' =>  number_format(floatval($student['opening_balance']),2),
          'current_balancef' => number_format(floatval($student['current_balance']),2),
          'lock_period' =>  $student['lock_period'],
          'lock_date' =>  format_date($student['lock_date']),
          'date_created' =>  format_date($student['date_created'])
        );
        array_push($array_master, $array_student);
    }
  }

  $get_user_det = get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_added');
  $fullname = $get_user_det['fname'].' '.$get_user_det['lname'];

  return json_encode(array("status"=>SUCCESS_RESPONSE, "msg"=>"plans successfully pulled for ".$fullname, "data"=>$array_master));

}





/////send deposit to database and update clients wallet
function process_deposit($user_id,$amount,$savings_plan_id,$rave_transaction_id,$unique_payment_id){
  global $dbc;
   $crave_transaction_id = check_record_by_one_param('payments_tbl','rave_transaction_id',$rave_transaction_id);
   $cunique_payment_id = check_record_by_one_param('payments_tbl','unique_payment_id',$unique_payment_id);

   if($crave_transaction_id == true || $cunique_payment_id == true ){
            return json_encode(array( "status"=>RECORD_EXISTS, "msg"=>"duplicate unique payment id or transaction id found" ));

   }else if($user_id == "" ||  $amount == "" ||  $savings_plan_id == "" ||  $rave_transaction_id == "" || $unique_payment_id == "" ){
        
            return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"empty field(s) found" ));

   }else{
            $unique_id = unique_id_generator($user_id.$rave_transaction_id);
            $sql = "INSERT INTO `payments_tbl` SET
              `unique_id`='$unique_id',
              `user_id`='$user_id',
              `savings_plan_id`='$savings_plan_id',
              `rave_transaction_id`='$rave_transaction_id',
              `unique_payment_id`='$unique_payment_id',
              `amount`='$amount',
              `deposit_date`=now()

            ";
            $qry = mysqli_query($dbc,$sql);  //record is inserted here

            if($qry){
                    $get_one_row_by_id = get_one_row_by_id('users','unique_id',$user_id);
                    if($get_one_row_by_id == null){
                    return json_encode(array( "status"=>NOT_FOUND, "msg"=>"user record not found" ));

                    }else{
                    $current_balance = floatval($get_one_row_by_id['grand_wallet']);
                    $new_balance = $current_balance + $amount;

                    $update_wall = "UPDATE `users` SET `grand_wallet`='$new_balance' WHERE `unique_id`='$user_id'";
                    $qryu = mysqli_query($dbc,$update_wall);

                    return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"deposit action was sucessful" ));

                    }
            }else{
                    return json_encode(array( "status"=>DB_ERROR, "msg"=>"insertion of record was NOT successful..server error" ));

            }



   }
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



///too raw
function update_by_one_paccram($table,$param,$value){
    global $dbc;
    $update_id = secure_database($update_id);
    if($update_id != ""){
     
      $query_up = mysqli_query($dbc,"UPDATE $table SET `loan_status`=1,`date_approved`=now()  WHERE `client_phone`='$phone'");
    
       return json_encode(array("status"=>111, "msg"=>"Success, loan has been successfully disbursed."));


    }else{
      
           return json_encode(array( "status"=>100, "msg"=>"Sorry, empty record found" ));

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


// // Email Function
function email_function($email, $subject, $content){
    $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    //   $headers .= 'From: FarmKonnect <admin@farmkonnect.com>' . "\r\n";
    //   $headers .= 'Cc: support@loyalty.com' . "\r\n";
    $headers = "From: Finsight\r\n";
    @$mail = mail($email, $subject, $content, $headers);
    return $mail;
  }


function unique_id_generator($data){
    $data = secure_database($data);
    $newid = md5(uniqid().time().rand(11111,99999).rand(11111,99999).$data);
    return $newid;
}


 function format_date($date){
        $date = secure_database($date);
        $new_date_format = date('F-d-Y', strtotime($date));
        return $new_date_format;
  }


 

function empty_fields_found(){       
            return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"one or more variables missing" ));
}





function get_money_box_bal($user_id){
  global $dbc;
  $sql_spent = "SELECT sum(amount) as amm_spent FROM spend_from_money_box WHERE user_id='$user_id'";
  $qry_spent = mysqli_query($dbc,$sql_spent);
  $num_spent = mysqli_num_rows($qry_spent);
  if($num_spent == 0){
      $money_box_spent = 0;
  }else{
      $row_spent = mysqli_fetch_array($qry_spent);
      $money_box_spent = $row_spent['amm_spent'];
  }


  $sql = "SELECT sum(amount) as amm FROM money_box WHERE user_id='$user_id'";
  $qry = mysqli_query($dbc,$sql);
  $num = mysqli_num_rows($qry);
  if($num == 0){
      return 0;
  }else{
      $row = mysqli_fetch_array($qry);
      $money_box = $row['amm'];
      $actual_money_box = $money_box - $money_box_spent;
      if($actual_money_box < 0){
        return 0;
      }else{
        
        return $actual_money_box;

      }
  }
}


function user_login($email,$password){
   global $dbc;
   $email = secure_database($email);
   $password = secure_database($password);
   $hashpassword = md5($password);

   $sql = "SELECT * FROM users WHERE `email`='$email' AND `password`='$hashpassword' AND  `role`=1 ";
   $query = mysqli_query($dbc,$sql);
   $count = mysqli_num_rows($query);
   if($count === 1){
      $row = mysqli_fetch_array($query);
      $fname = $row['fname'];
      $lname = $row['lname'];
      $phone = $row['phone'];
      $email = $row['email'];
      $unique_id = $row['unique_id']; //user id
      $access_status = $row['access_status'];
      $pin = $row['pin'];
      $added_by = $row['added_by'];
      $date_added = $row['date_added'];
      $gender = $row['gender'];
      $dob = $row['dob'];
      $bvn = $row['bvn'];
      $invite_code = $row['invite_code'];
      $grand_wallet = $row['grand_wallet'];

      $money_box = get_money_box_bal($unique_id);

      $get_user_det = get_one_row_from_one_table_by_id('users','email',$email,'date_added');
      $user_id = $get_user_det['unique_id'];
            
      $get_bank_det = get_one_row_from_one_table_by_id('bank_details','user_id',$user_id,'date_added');
      $bank_code = $get_bank_det['bank_code'];
      $bank_name = $get_bank_det['bank_name'];
      $account_name = $get_bank_det['account_name'];
      $account_no = $get_bank_det['account_no'];
    

      if($access_status != 1){
                return json_encode(array( "status"=>NO_ACCESS, "msg"=>"Sorry you currently do not have access!" ));
      }else{
                return json_encode(array( 
                    "status"=>SUCCESS_RESPONSE, 
                    "msg"=>"successfully logged in", 
                    "unique_id"=>$unique_id, 
                    "bank_code"=>$bank_code, 
                    "bank_name"=>$bank_name, 
                    "account_name"=>$account_name, 
                    "account_no"=>$account_no, 
                    "grand_wallet"=>floatval($grand_wallet),
                    "grand_wallet_formatted"=>number_format(($grand_wallet),2),
                    "money_box"=>$money_box,
                    "money_boxf"=>number_format(($money_box),2),
                    "fname"=>$fname, 
                    "lname"=>$lname, 
                    "phone"=>$phone, 
                    "email"=>$email, 
                    "pin"=>$pin, 
                    "added_by"=>$added_by, 
                    "date_added"=>format_date($date_added), 
                    "gender"=>$gender, 
                    "dob"=>format_date($dob), 
                    "bvn"=>$bvn,
                    "invite_code"=>$invite_code,
                    "additional_notes"=>"For gender:  1 - male 2 - female"
                  )
                 );

      }
    
   }else{
                return json_encode(array( "status"=>NOT_FOUND, "msg"=>"No Record Found!" ));

   }
 

}




///personal details
function quick_registration($email,$fname,$lname,$phone,$password,$invite_code){
       global $dbc;
        $email = secure_database($email);
        $fname = secure_database($fname);
        $lname = secure_database($lname);
        $phone = secure_database($phone);
        $password = secure_database($password);
        $password = md5($password);
        $invite_code = secure_database($invite_code);
        
        $role = 1;
        $table = 'users';
        $check_exist = check_record_by_one_param($table,'phone',$phone);
        $check_exist_email = check_record_by_one_param($table,'email',$email);
       
       if($check_exist == true || $check_exist_email == true){
                return json_encode(array( "status"=>USER_EXISTS, "msg"=>"This user record exists" ));
         }
         else{
                if( $email == "" || $fname == "" || $lname == "" || $phone == "" || $password == "" ){

                return json_encode(array( "status"=>EMPTY_FIELDS, "msg"=>"Empty field(s) found" ));

                }

                else{

                $unique_id = unique_id_generator($email.$phone);
                $sql = "INSERT INTO `users` SET
                `unique_id` = '$unique_id',
                `fname` = '$fname',
                `lname` = '$lname',
                `phone` = '$phone',
                `email` = '$email',
                `password` = '$password',
                `invite_code` = '$invite_code',
                `role` = '$role',
                `date_added` = now()
                ";
                $query = mysqli_query($dbc, $sql)  or die(mysqli_error($dbc));
                //return $query;
                if($query){

                return json_encode(array( "status"=>SUCCESS_RESPONSE,"unique_id"=>$unique_id, "msg"=>"successful registration" ));


                }else{

                return json_encode(array( "status"=>DB_ERROR, "msg"=>"DB Error" ));

                }


                }

         }
        
}




///basic profile update
function basic_profile_update($unique_id,$email,$fname,$lname,$phone,$gender,$dob){
        global $dbc;
        $email = secure_database($email);
        $fname = secure_database($fname);
        $gender = secure_database($gender);
        $lname = secure_database($lname);
        $phone = secure_database($phone);
        $password = secure_database($password);
        $password = md5($password);
        $unique_id = secure_database($unique_id);   
        $table = 'users';
        $check_exist = check_record_by_one_param($table,'unique_id',$unique_id);
        $check_exist_email = check_record_by_one_param($table,'email',$email);
       
       if($check_exist){            
                $sql = "UPDATE `users` SET
                `fname` = '$fname',
                `lname` = '$lname',
                `phone` = '$phone',
                `gender` = '$gender',
                `dob` = '$dob'
                 WHERE 
                `unique_id`='$unique_id'
                ";
                $query = mysqli_query($dbc, $sql);
                //return $query;
                if($query){

                return json_encode(array( "status"=>SUCCESS_RESPONSE,"unique_id"=>$unique_id, "msg"=>"successful update of basic profile "));


                }else{

                return json_encode(array( "status"=>DB_ERROR, "msg"=>"DB Error" ));

                }


         }
         else{
                
                return json_encode(array( "status"=>NOT_FOUND, "msg"=>"This user record not found in db" ));


         }
        
}







///sercurity profile update
function security_profile_update($unique_id,$password,$pin){
        global $dbc;
        $password = secure_database($password);
        $password = md5($password);
        $pin = secure_database($pin);
        $unique_id = secure_database($unique_id);   
        $table = 'users';
        $check_exist = check_record_by_one_param($table,'unique_id',$unique_id);
       
       if($check_exist){         
                $sql = "UPDATE `users` SET
                `password` = '$password',
                `pin` = '$pin'
                 WHERE 
                `unique_id`='$unique_id'
                ";
                $query = mysqli_query($dbc, $sql);
                //return $query;
                if($query){

                return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"successful update of security profile" ));


                }else{

                return json_encode(array( "status"=>DB_ERROR, "msg"=>"DB Error" ));

                }


         }
         else{
                
                return json_encode(array( "status"=>NOT_FOUND, "msg"=>"This user record not found in db" ));


         }
        
}

///pin profile update
function pin_profile_update($unique_id,$oldpin,$pin){
        global $dbc;
        $pin = secure_database($pin);
        $oldpin = secure_database($oldpin);
        $unique_id = secure_database($unique_id);   
        $table = 'users';
        $check_exist = check_record_by_one_param($table,'unique_id',$unique_id);
        $check_exist_old = check_record_by_one_param($table,'pin',$old);
       
       if($check_exist_old == false){

             return json_encode(array( "status"=>NOT_FOUND, "msg"=>"wrong old pin entered" ));

       }
       else if($check_exist){         
                $sql = "UPDATE `users` SET
                `pin` = '$pin'
                 WHERE 
                `unique_id`='$unique_id'
                ";
                $query = mysqli_query($dbc, $sql);
                //return $query;
                if($query){

                return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"successful update of pin" ));


                }else{

                return json_encode(array( "status"=>DB_ERROR, "msg"=>"DB Error" ));

                }


         }
         else{
                
                return json_encode(array( "status"=>NOT_FOUND, "msg"=>"This user record not found in db" ));


         }
        
}



///bank details profile update
function bank_details_profile_update($user_id,$bankname,$acctno,$bvn,$accountname){
        global $dbc;
        $bankname = secure_database($bankname);
        $acctno = secure_database($acctno);
        $bvn = secure_database($bvn);
        $accountname = secure_database($accountname);
        $user_id = secure_database($user_id);   
        $table = 'users';
        $table2 = 'bank_details';
        $check_exist = check_record_by_one_param($table,'unique_id',$user_id);

        /////////getting bank code
   if($bankname == "Access Bank Plc"){ 
      $bank_code = "044";
   }else if($bankname == "Fidelity Bank Plc"){
      $bank_code = "070";
   }else if($bankname == "First City Monument Bank Limited"){
      $bank_code = "214";
   }else if($bankname == "First Bank of Nigeria Limited"){
      $bank_code = "011";
   }else if($bankname == "Citibank Nigeria Limited"){
      $bank_code = "023";
   }else if($bankname == "United Bank for Africa Plc"){
      $bank_code = "033";
   }else if($bankname == "Ecobank Nigeria Plc"){
      $bank_code = "050";
   }else if($bankname == "Heritage Banking Company Limited"){
      $bank_code = "030";
   }else if($bankname == "Keystone Bank Limited"){
      $bank_code = "082";
   }
   else if($bankname == "Standard Chartered Bank"){
      $bank_code = "068";
   }else if($bankname =="Stanbic IBTC Bank Plc"){
      $bank_code = "221";
   }else if($bankname == "Sterling Bank Plc"){
      $bank_code = "323";
   }else if($bankname == "Titan Trust Bank Limited"){
      $bank_code = "022";
   }else if($bankname == "Unity Bank Plc"){
      $bank_code = "215";
   }else if($bankname == "Wema Bank Plc"){
      $bank_code = "035";
   }else{
                           return json_encode(array( "status"=>NOT_FOUND,"msg"=>"no bank was selected" ));

   }
    

    
       if($check_exist){    

               $check_exist_bank_info = check_record_by_one_param($table2,'user_id',$user_id);

               if($check_exist_bank_info){
                      //update
                        $sql = "UPDATE `bank_details` SET
                        `bank_name` = '$bankname',
                        `bvn` = '$bvn',
                        `bank_code` = '$bank_code',
                        `account_name` = '$accountname',
                        `account_no` = '$acctno',
                        `last_update` = now()
                        WHERE 
                        `user_id`='$user_id'
                        ";
                        $query = mysqli_query($dbc, $sql);
                        //return $query;
                        if($query){

                           return json_encode(array( "status"=>SUCCESS_RESPONSE,"unique_id"=>$user_id,"msg"=>"successful update of bank details" ));


                        }else{

                           return json_encode(array( "status"=>DB_ERROR, "msg"=>"DB Error" ));

                        }
               
                }else{
                  //insert
                        $unique_id = unique_id_generator($accountname.$acctno);
                        $sql = "INSERT INTO `bank_details` SET
                        `unique_id`='$unique_id',
                        `user_id` = '$user_id',
                        `bank_name` = '$bankname',
                        `bank_code` = '$bank_code',
                        `bvn` = '$bvn',
                        `account_name` = '$accountname',
                        `account_no` = '$acctno',
                        `last_update` = now(), 
                        `date_added` = now()                        
                        ";
                        $query = mysqli_query($dbc, $sql);
                        //return $query;
                        if($query){

                        return json_encode(array( "status"=>SUCCESS_RESPONSE,"unique_id"=>$unique_id, "msg"=>"successful update of bank details" ));


                        }else{

                        return json_encode(array( "status"=>DB_ERROR, "msg"=>"DB Error" ));

                        }
               }

            


         }
         else{
                
                return json_encode(array( "status"=>NOT_FOUND, "msg"=>"This user record not found in db" ));


         }
        
}


function password_reset_mail($email){
       global $dbc;  
        $table = 'users';
        $check_exist = check_record_by_one_param($table,'email',$email);
        if($check_exist){
            $subject = "Password Reset";
            $content = "Hello,<br> We received a request to change password.<br>kindly use the link below to change your password.<br><br><br><a href='#'>Click Here to Reset Password</a><br>";
            $content .= "Thank you<hr><small>If you did not initiate this request kindly ignore.</small>";
            $email_function = email_function($email, $subject, $content);

            return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"password reset link sent" ));

        }else{
                return json_encode(array( "status"=>NOT_FOUND, "msg"=>"record not found in db" ));

        }

}


function password_reset_action($email,$password){
    global $dbc;
    $table = 'users';
    $check_exist = check_record_by_one_param($table,'email',$email);
    if($check_exist){
        $password = md5($password);
        $sql = "UPDATE `users` SET `password`='$password' WHERE `email`='$email'";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
          return json_encode(array( "status"=>SUCCESS_RESPONSE, "msg"=>"successful password reset" ));

        }else{
          return json_encode(array( "status"=>DB_ERROR, "msg"=>"db error" ));

        }
    }else{
          return json_encode(array( "status"=>NOT_FOUND, "msg"=>"record not found in db" ));
    }
  
}




/////////MOST IMPORTANT FUNCTIONS START HERE::::
function enter_manual_repayment($client_phone,$repayment_amount,$date_of_repayment){
        global $dbc;
        $client_phone = secure_database($client_phone);
        $repayment_amount = secure_database($repayment_amount);
        $date_of_repayment = secure_database($date_of_repayment);
       
        $data = $client_phone.$repayment_amount;
        $unique_id = unique_id_generator($data);
        


        $table1 = 'user';
        $table2 = 'loans_tbl';

        $check_exist = check_record_by_one_param($table1,'mobile_phone_number',$client_phone);
        $check_running_loan = check_record_by_two_params($table2,'client_phone',$client_phone,'loan_status',1);


       

     
        
         if($check_exist == false){
                 return json_encode(array( "status"=>100, "msg"=>"Sorry, your record was not found on our server. Kindly register" ));
          
         }

          else if($check_running_loan == false){
                 return json_encode(array( "status"=>100, "msg"=>"Sorry, you currently do not have any running loan" ));
          
         }


         else{
            if( $client_phone == "" || $repayment_amount == "" || $date_of_repayment == ""){

                return json_encode(array( "status"=>101, "msg"=>"Empty field(s) found" ));

                }

              else{

              $get_running_loan_id = "SELECT * FROM `loans_tbl` WHERE `client_phone`='$client_phone' AND `loan_status`=1";
              $query_running_loan = mysqli_query($dbc, $get_running_loan_id);
              $row_running_loan = mysqli_fetch_array($query_running_loan);
              $loan_id = $row_running_loan['unique_id'];


                $sql = "INSERT INTO `repayments` SET
                `unique_id` = '$unique_id',
                `loan_id` = '$loan_id',
                `client_phone` = '$client_phone',
                `rep_amount` = '$repayment_amount',
                `rep_date` = '$date_of_repayment',
                `date_sent` = now(),
                `rep_status` = 0
                ";
                $query = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));
                if($query){

                return json_encode(array( "status"=>111, "msg"=>"success" ));


                }else{

                return json_encode(array( "status"=>100, "msg"=>"Something went wrong" ));

                }


                }

         }
        


}





function check_user_exists($phone){
          global $dbc;
          
          $phone = secure_database($phone);


          $sql = "SELECT * FROM `user` WHERE `mobile_phone_number`='$phone'";
          $query = mysqli_query($dbc, $sql);
          $count = mysqli_num_rows($query);
          if($count > 0){
            
            $row = mysqli_fetch_array($query);
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            
           return json_encode(
            array( 

              "status"=>111, 
              "mobile_phone_number"=>$phone,
              "first_name"=>$first_name,
              "last_name"=>$last_name

             ));
          }

          else{
          
           return json_encode(array( "status"=>100, "msg"=>"Sorry, your record was not found on our server. Kindly register" ));
          
          }

}


function update_or_disburse_loan($phone){
    global $dbc;
    $table = "loans_tbl";
    $phone = secure_database($phone);
    $check_pending_loan = check_record_by_two_params($table,'client_phone',$phone,'loan_status',0);
    if($check_pending_loan){
      $query_up = mysqli_query($dbc,"UPDATE loans_tbl SET `loan_status`=1,`date_approved`=now()  WHERE `client_phone`='$phone'");
    
       return json_encode(array("status"=>111, "msg"=>"Success, loan has been successfully disbursed."));


    }else{
      
           return json_encode(array( "status"=>100, "msg"=>"Sorry, this user does not have a pending loan" ));

    }
}


function view_running_loan($phone){
    global $dbc;
    $table = 'loans_tbl';
    $phone = secure_database($phone);
    $check_loan_exist = check_record_by_two_params($table,'client_phone',$phone,'loan_status',1);
    $sql = "SELECT * FROM `$table` WHERE `client_phone`='$phone' AND `loan_status`=1 ";
    $query = mysqli_query($dbc,$sql);

    if($check_loan_exist){

        if($query){
            $row = mysqli_fetch_array($query);
            $loan_amount = $row['loan_amount'];
            $interest_rate = $row['interest_rate'];
            $expected_repayment = $row['loan_amount'] + (  ($interest_rate/100) * $row['loan_amount'] );
            $tenure_days = $row['tenure_days'];
            
            $date_applied = $row['date_applied'];
            $date_approved = $row['date_approved'];

            $check_user_exists = check_user_exists($phone);
            $jsd = json_decode($check_user_exists,true);
            $fname = $jsd['first_name'];
            $lname = $jsd['last_name'];

            
            return json_encode(array("status"=>111, "loan_amount"=>$loan_amount,"first_name"=>$fname,"last_name"=>$lname,"loan_amountf"=>number_format($loan_amount),"expected_repayment"=>$expected_repayment,"expected_repaymentf"=>number_format($expected_repayment),"tenure_days"=>$tenure_days,"interest_rate"=>$interest_rate, "date_applied"=>$date_applied, "date_approved"=>$date_approved));

            }
            else{
            return json_encode(array("status"=>100, "msg"=>"Something went wrong... "));
            }

    } else{

       return json_encode(array("status"=>100, "msg"=>"No running loans found!"));
    }



}

function apply_for_loan($phone,$lamount,$interest,$tenure){
    global $dbc;
    $table = "loans_tbl";
    $phone = secure_database($phone);
    $lamount = secure_database($lamount);
    $interest = secure_database($interest);
    $tenure = secure_database($tenure);
    $unique_id = 'loans_'.unique_id_generator($phone.$interest);
    // $check_exist = check_record_by_one_param($table,'mobile_phone_number',$mobile_phone_number);
    $check_loan_exist = check_record_by_two_params($table,'client_phone',$phone,'loan_status',1);
    $check_loan_exist2 = check_record_by_two_params($table,'client_phone',$phone,'loan_status',0);
    
    if($check_loan_exist){
        //get loan info:
                return json_encode(array( "status"=>100, "msg"=>"Oops, You are currently on a loan... Go to view existing loans."));       
    }

   if($check_loan_exist2){
        //get loan info:
                return json_encode(array( "status"=>100, "msg"=>"Oops, You have loan application currently being reviewed... Go to view existing loans."));       
    }

    else{

          $sql_insert = "INSERT INTO `loans_tbl` SET
            `unique_id`='$unique_id',
            `client_phone`='$phone',
            `loan_amount`='$lamount',
            `interest_rate`='$interest',
            `tenure_days`='$tenure',
            `loan_status`= 0,
            `date_applied`= now()

          ";

          $query_insert = mysqli_query($dbc,$sql_insert);
          
          if($query_insert){
                return json_encode(array( "status"=>111, "msg"=>"Success, your loan application has being recieved." ));

           }else{
                return json_encode(array( "status"=>100, "msg"=>"Something went wrong" ));
           }


                
    }
    


}


function check_record_by_three_params($table,$param,$value,$param2,$value2,$param3,$value3){
    global $dbc;
    $sql = "SELECT id FROM `$table` WHERE `$param`='$value' AND `$param2`='$value2' AND `$param3`='$value3' ";
    $query = mysqli_query($dbc, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      return true; ///exists
    }else{
      return false; //does not exist
    }
    
}   






















/////// MOST IMPORTANT FUNCTIONS END HERE




 function get_unique_id($initial){
            
             $uniquestring = strtoupper($initial['0']);
             $uniquestring2 = strtoupper($initial['1']);
             $uniqueid = rand(1000,99999);
             $uniqueid2 = date('hms');
             $uniqueid4 = time();
             

              $unique_id =  $initial.''.$uniqueid4.''.$uniqueid;

              return $unique_id;
  }



function check_record_by_two_paramsold($table,$param,$value,$param2,$value2){
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


function check_password($pass,$cpass){
    if($pass == $cpass){
      return true; //pass is same
    }else{
      return false; //pass is not same
    }
} 


function admin_registration($first_name,$last_name,$other_name,$password,$cpassword,$mobile_phone_number,$email_address,$permissions_details,$added_by,$status){
       global $dbc;
       //,$pinpass
       
        $first_name = secure_database($first_name);
        $password = secure_database($password);
        $password = md5($password);
        $cpassword = secure_database($cpassword);
        $cpassword = md5($cpassword);
        $last_name = secure_database($last_name);
        $other_name = secure_database($other_name);
        $mobile_phone_number = secure_database($mobile_phone_number);
        $email_address = secure_database($email_address);
        //$pinpass = secure_database($pinpass);
        $permissions_details = secure_database($permissions_details);
        $added_by = secure_database($added_by);
        $status = secure_database($status);
    
        $data = $first_name.$last_name.$email_address;
        $admin_id = unique_id_generator($data);
        $table = 'admin';
      
  

        $check_exist = check_record_by_one_param($table,'email_address',$email_address);
        $check_password = check_password($password,$cpassword);

        $check_admin_exist = check_record_by_one_param($table,'added_by',$added_by);

       


         if($check_exist){
                return json_encode(array( "status"=>103, "msg"=>"this record exists" ));
         }

         else if($check_admin_exist == false){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }

         else if($check_password == false){

                return json_encode(array( "status"=>104, "msg"=>"password mismatch found" ));

         }

         else{
                  
                if($first_name == "" || $last_name == "" || $other_name == "" || $mobile_phone_number == "" || $email_address == ""  ||   $permissions_details == "" || $added_by == "" || $status == "" || $password == "" || $cpassword == "" ){

                return json_encode(array( "status"=>101, "msg"=>"empty field(s) found" ));

                }

                else{


                $sql = "INSERT INTO `admin` SET
                `admin_id` = '$admin_id',
                `first_name` = '$first_name',
                `last_name` = '$last_name',
                `other_name` = '$other_name',
                `password` = '$password',
                `mobile_phone_number` = '$mobile_phone_number',
                `email_address` = '$email_address',
                `permissions_details` = '$permissions_details',
                `when_added` = now(),
                `added_by` = '$added_by'
                ";
                $query = mysqli_query($dbc, $sql);
                
               

                if($query){
                  return json_encode(array( "status"=>111, "msg"=>"success" ));
                }else{

                return json_encode(array( "status"=>100, "msg"=>"Something went wrong" ));

                }


                }

         }


        
}







function insert_audit_log($activity_performed,$who_performed,$ip_address,$url_accessed,$system_name,$before_details,$after_details){
     global $dbc;
       //,$pinpass
       
        $activity_performed = secure_database($activity_performed);
        $who_performed = secure_database($who_performed);
        $ip_address = secure_database($ip_address);
        $url_accessed = secure_database($url_accessed);
        $system_name = secure_database($system_name);
        $before_details = secure_database($before_details);
        $after_details = secure_database($after_details);

              if($activity_performed == "" || $who_performed == "" || $ip_address == "" || $url_accessed == "" || $system_name == ""  ||   $before_details == ""  || $after_details == ""){

                return json_encode(array( "status"=>101, "msg"=>"empty field(s) found" ));

                }

                else{


                $sql = "INSERT INTO `audit_log` SET
                `activity_performed` = '$activity_performed',
                `who_performed` = '$who_performed',
                `ip_address` = '$ip_address',
                `url_accessed` = '$url_accessed',
                `system_name` = '$system_name',
                `before_details` = '$before_details',
                `after_details` = '$after_details',
                `when_performed` = now()
                ";
                $query = mysqli_query($dbc, $sql);
                if($query){

                return json_encode(array( "status"=>111, "msg"=>"success" ));


                }else{

                return json_encode(array( "status"=>100, "msg"=>"Something went wrong" ));

                }


                


         }

                  
      

}



function view_defaulters($admin_id) {
        global $dbc;
        $admin_id = secure_database($admin_id);     
        $check_admin_exist = check_record_by_one_param('admin','added_by',$admin_id);
        $check_admin_exist2 = check_record_by_one_param('admin','admin_id',$admin_id);
        $array= array();


       if($check_admin_exist == false  AND  $check_admin_exist2 == false  ){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }else{

              $sql = "SELECT * FROM `defaulter_list` ORDER BY `since_when` DESC";
              $query = mysqli_query($dbc,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){
                    while($row = mysqli_fetch_array($query)){


                      $get_user = get_one_row_by_id('user', 'user_id',$row['user_id']);
                      $first_name = $get_user['first_name'];
                      $last_name = $get_user['last_name'];
                      $mobile_phone_number = $get_user['mobile_phone_number'];
                      $email_address = $get_user['email_address'];

                      $array_row = array(

                        'defaulter_id'=>$row['defaulter_id'],
                        'first_name'=> $first_name,
                        'last_name'=> $last_name,
                        'phone'=> $mobile_phone_number,
                        'email'=> $email_address,
                        'since_when'=> $row['since_when'],
                        'amount_owed'=> $row['amnt_owed'],
                        'recovery_level_used'=> $row['recovery_level_used']
                        

                      );
                     array_push($array, $array_row);
                      //array_push($array_row);
                    }

                     // return json_encode($array['details']);
                     return json_encode($array);

              }else{

                     return json_encode(array( "status"=>106, "msg"=>"no record found" ));

              }



         }



}


function view_pending_disbursments($admin_id) {
     global $dbc;
        $admin_id = secure_database($admin_id);     
        $check_admin_exist = check_record_by_one_param('admin','added_by',$admin_id);
        $check_admin_exist2 = check_record_by_one_param('admin','admin_id',$admin_id);
        $array= array();


       if($check_admin_exist == false  AND  $check_admin_exist2 == false  ){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }else{

              $sql = "SELECT * FROM `diss_pend` ORDER BY `when_requested` DESC";
              $query = mysqli_query($dbc,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){
                    while($row = mysqli_fetch_array($query)){


                      $get_user = get_one_row_by_id('user', 'user_id',$row['client_id']);
                      $first_name = $get_user['first_name'];
                      $last_name = $get_user['last_name'];
                      $mobile_phone_number = $get_user['mobile_phone_number'];
                      $email_address = $get_user['email_address'];

                      $array_row = array(

                        'disbursement_id'=>$row['diss_id'],
                        'first_name'=> $first_name,
                        'last_name'=> $last_name,
                        'phone'=> $mobile_phone_number,
                        'email'=> $email_address,
                        'when_requested'=> $row['when_requested'],
                        'amount'=> $row['amount'],
                        'disbursement_channel'=> $row['channel_dis'],
                        'expected_repayment'=> $row['expected_repay']
                        

                      );
                     array_push($array, $array_row);
                      //array_push($array_row);
                    }

                     // return json_encode($array['details']);
                     return json_encode($array);

              }else{

                     return json_encode(array( "status"=>106, "msg"=>"no record found" ));

              }



         }



}


function view_pend_disb_log($admin_id) {
       global $dbc;
        $admin_id = secure_database($admin_id);     
        $check_admin_exist = check_record_by_one_param('admin','added_by',$admin_id);
        $check_admin_exist2 = check_record_by_one_param('admin','admin_id',$admin_id);
        $array= array();


       if($check_admin_exist == false  AND  $check_admin_exist2 == false  ){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }else{

              $sql = "SELECT * FROM `diss_pend_log` ORDER BY `when_requested` DESC";
              $query = mysqli_query($dbc,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){
                    while($row = mysqli_fetch_array($query)){


                      $get_user = get_one_row_by_id('user', 'user_id',$row['client_id']);
                      $first_name = $get_user['first_name'];
                      $last_name = $get_user['last_name'];
                      $mobile_phone_number = $get_user['mobile_phone_number'];
                      $email_address = $get_user['email_address'];

                      if($row['repaid'] == 0){
                        $repaid = "still on loan";
                        $classified_default = "defaulter";
                      }else{
                        $repaid = "loan fully paid";
                        $classified_default = "good client";

                      }

                      $array_row = array(

                        'disbursement_id'=>$row['diss_id'],
                        'first_name'=> $first_name,
                        'last_name'=> $last_name,
                        'phone'=> $mobile_phone_number,
                        'email'=> $email_address,
                        'when_requested'=> $row['when_requested'],
                        'when_disbursed'=> $row['when_diss'],
                        'who_disbursed'=> $row['who_diss'],
                        'amount'=> $row['amount'],
                        'disbursement_channel'=> $row['channel_dis'],
                        'repayment_status'=> $repaid,
                        'expected_repayment'=> $row['expected_repay'],
                        'expected_repayment_date'=> $row['expected_repay_date'],
                        'classified_default'=> $row['expected_repay_date']
                        

                      );
                     array_push($array, $array_row);
                      //array_push($array_row);
                    }

                     // return json_encode($array['details']);
                     return json_encode($array);

              }else{

                     return json_encode(array( "status"=>106, "msg"=>"no record found" ));

              }



         }



}



function view_failed_logins($admin_id) {
        global $dbc;
        $admin_id = secure_database($admin_id);     
        $check_admin_exist = check_record_by_one_param('admin','added_by',$admin_id);
        $check_admin_exist2 = check_record_by_one_param('admin','admin_id',$admin_id);
        $array= array();


       if($check_admin_exist == false  AND  $check_admin_exist2 == false  ){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }else{

              $sql = "SELECT * FROM `failed_logins` ORDER BY `when_last_login` DESC";
              $query = mysqli_query($dbc,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){
                    while($row = mysqli_fetch_array($query)){


                      $get_user = get_one_row_by_id('user', 'user_id',$row['user_id']);
                      // if($get_user != null){

                      // }
                      $first_name = $get_user['first_name'];
                      $last_name = $get_user['last_name'];
                      $mobile_phone_number = $get_user['mobile_phone_number'];
                      $email_address = $get_user['email_address'];

                   

                      $array_row = array(
                        'first_name'=> $first_name,
                        'last_name'=> $last_name,
                        'phone'=> $mobile_phone_number,
                        'email'=> $email_address,
                        'ip_address'=> $row['ip_address'],
                        'when_last_login'=> $row['when_last_login'],
                        'system_name'=> $row['system_name']
                      );
                     array_push($array, $array_row);
                      //array_push($array_row);
                    }

                     // return json_encode($array['details']);
                     return json_encode($array);

              }else{

                     return json_encode(array( "status"=>106, "msg"=>"no record found" ));

              }



         }



}

function view_last_logins($admin_id) {
        global $dbc;
        $admin_id = secure_database($admin_id);     
        $check_admin_exist = check_record_by_one_param('admin','added_by',$admin_id);
        $check_admin_exist2 = check_record_by_one_param('admin','admin_id',$admin_id);
        $array= array();


       if($check_admin_exist == false  AND  $check_admin_exist2 == false  ){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }else{

              $sql = "SELECT * FROM `last_logins` ORDER BY `when_last_login` DESC";
              $query = mysqli_query($dbc,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){
                    while($row = mysqli_fetch_array($query)){


                      $get_user = get_one_row_by_id('user', 'user_id',$row['user_id']);
                      // if($get_user != null){

                      // }
                      $first_name = $get_user['first_name'];
                      $last_name = $get_user['last_name'];
                      $mobile_phone_number = $get_user['mobile_phone_number'];
                      $email_address = $get_user['email_address'];

                   

                      $array_row = array(
                        'first_name'=> $first_name,
                        'last_name'=> $last_name,
                        'phone'=> $mobile_phone_number,
                        'email'=> $email_address,
                        'ip_address'=> $row['ip_address'],
                        'when_last_login'=> $row['when_last_login'],
                        'system_name'=> $row['system_name']
                      );
                     array_push($array, $array_row);
                      //array_push($array_row);
                    }

                     // return json_encode($array['details']);
                     return json_encode($array);

              }else{

                     return json_encode(array( "status"=>106, "msg"=>"no record found" ));

              }



         }



}



function view_password_log($admin_id) {
         global $dbc;
        $admin_id = secure_database($admin_id);     
        $check_admin_exist = check_record_by_one_param('admin','added_by',$admin_id);
        $check_admin_exist2 = check_record_by_one_param('admin','admin_id',$admin_id);
        $array= array();


       if($check_admin_exist == false  AND  $check_admin_exist2 == false  ){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }else{

              $sql = "SELECT * FROM `password_log` ORDER BY `when_updated_last` DESC";
              $query = mysqli_query($dbc,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){
                    while($row = mysqli_fetch_array($query)){


                      $get_user = get_one_row_by_id('user', 'user_id',$row['user_id']);
                      // if($get_user != null){

                      // }
                      $first_name = $get_user['first_name'];
                      $last_name = $get_user['last_name'];
                      $mobile_phone_number = $get_user['mobile_phone_number'];
                      $email_address = $get_user['email_address'];

                   

                      $array_row = array(
                        'first_name'=> $first_name,
                        'last_name'=> $last_name,
                        'phone'=> $mobile_phone_number,
                        'email'=> $email_address,
                        'when_updated_last'=> $row['when_updated_last'],
                        'expiry_date'=> $row['expiry_date']
                      );
                     array_push($array, $array_row);
                      //array_push($array_row);
                    }

                     // return json_encode($array['details']);
                     return json_encode($array);

              }else{

                     return json_encode(array( "status"=>106, "msg"=>"no record found" ));

              }



         }



}



function view_clients($admin_id) {
        global $dbc;
        $admin_id = secure_database($admin_id);     
        $check_admin_exist = check_record_by_one_param('admin','added_by',$admin_id);
        $check_admin_exist2 = check_record_by_one_param('admin','admin_id',$admin_id);
        $array= array();


       if($check_admin_exist == false  AND  $check_admin_exist2 == false  ){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }else{

              $sql = "SELECT * FROM `user` ORDER BY `when_added` DESC";
              $query = mysqli_query($dbc,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){
                    while($row = mysqli_fetch_array($query)){

                      if($row['status'] == 1){
                        $status = "active";
                      }

                      if($row['status'] == 0){
                        $status = "disabled";
                      }

                      if($row['status'] == 2){
                        $status = "suspended";
                      }

                      $array_row = array(
                        'first_name'=> $row['first_name'],
                        'last_name'=> $row['last_name'],
                        'other_name'=> $row['other_name'],
                        'phone'=> $row['mobile_phone_number'],
                        'email'=> $row['email_address'],
                        'other_details'=> $row['other_details'],
                       
                        'channel'=> $row['channel'],
                        'status'=> $status,
                        'secret_question'=> $row['sece_ques'],
                        'secret_answer'=> $row['sece_ans'],
                         'when_added'=> $row['when_added'] 
                      );
                     array_push($array, $array_row);
                      //array_push($array_row);
                    }

                     // return json_encode($array['details']);
                     return json_encode($array);

              }else{

                     return json_encode(array( "status"=>106, "msg"=>"no record found" ));

              }



         }



}


function admin_login($email_address,$password,$ip_address,$system_name){
    global $dbc;
    $password = secure_database($password);
    $ip_address = secure_database($ip_address);
    $system_name = secure_database($system_name);
    $password = md5($password);
     $sql = "SELECT * FROM `admin` where `email_address`='$email_address' AND `password`='$password'";
    $query = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      $get_admin = get_one_row_by_id('admin', 'email_address',$email_address);
    

      if($get_admin != null){
        $admin_id = $get_admin['admin_id'];
       //insert last logins
       $check_first = check_record_by_two_params('last_logins','user_id',$admin_id,'user_type',2);

       if($check_first){
        $sql_upll = "UPDATE `last_logins` SET `when_last_login`= now() WHERE `user_type`=2 AND `user_id`='$admin_id'";
           $query_upll = mysqli_query($dbc,$sql_upll);
            if($query_upll){
              return json_encode(array( "status"=>111, "msg"=>"success" ));
              }else{
              return json_encode(array( "status"=>100, "msg"=>"something went wrong" ));
              }
       }else{

           $sql_ll = "INSERT INTO `last_logins` SET
           `email`='$email_address',
           `user_id`='$admin_id',
           `user_type`= 2,
           `ip_address`='$ip_address',
           `system_name`='$system_name',
           `when_last_login`= now()

           ";
           $query_ll = mysqli_query($dbc,$sql_ll);
            if($query_ll){
              return json_encode(array( "status"=>111, "msg"=>"success" ));
              }else{
              return json_encode(array( "status"=>100, "msg"=>"something went wrong" ));
              }

       } 

     }else{
         return json_encode(array( "status"=>100, "msg"=>"login failed" ));
     }
       
       
    
    }else{
       
      $get_admin = get_one_row_by_id('admin', 'email_address',$email_address);
    
      if($get_admin != null){
        $admin_id = $get_admin['admin_id'];

       //insert failded logins
        $sql_fl = "INSERT INTO `failed_logins` SET
           `email`='$email_address',
           `user_id`='$admin_id',
           `user_type`= 2,
           `ip_address`='$ip_address',
           `system_name`='$system_name',
           `when_last_login`= now()

           ";
           $query_fl = mysqli_query($dbc,$sql_fl);

           if($query_fl){
              return json_encode(array( "status"=>100, "msg"=>"login failed. username or password incorrect" ));
              }else{
              return json_encode(array( "status"=>100, "msg"=>"something went wrong" ));

              }

      } else{

              return json_encode(array( "status"=>100, "msg"=>"login failed" ));


      }


 
    }
}





function insert_chat_return_template($message_type,$message,$message_url,$message_image,$who_added){
     global $dbc;
       //,$pinpass
       
        
        $message_type = secure_database($message_type);
        $message = secure_database($message);
        $message_url = secure_database($message_url);
        $message_image = secure_database($message_image);
        $who_added = secure_database($who_added);
        $data = $message_type.$message.$who_added;
        $message_id = unique_id_generator($data);

        $check_admin_exist = check_record_by_one_param('admin','added_by',$who_added);
  
       if($check_admin_exist == false){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }
       
         else  if( $message_type == "" || $message == "" || $message_url == "" || $message_image == ""  ||   $who_added == "" ){

                return json_encode(array( "status"=>101, "msg"=>"empty field(s) found" ));

                }

                else{


                $sql = "INSERT INTO `chat_return_template` SET
                `message_id` = '$message_id',
                `message_type` = '$message_type',
                `message` = '$message',
                `message_url` = '$message_url',
                `message_image` = '$message_image',
                `who_added` = '$who_added',
                `when_added` = now()
                ";
                $query = mysqli_query($dbc, $sql);
                if($query){

                return json_encode(array( "status"=>111, "msg"=>"success" ));


                }else{

                return json_encode(array( "status"=>100, "msg"=>"Something went wrong" ));

                }


                


         }

                  
      

}


//will be more secure later
function user_change_password($email_address,$oldpassword,$newpassword,$cnewpassword){
  global $dbc;
      $curdate = date('Y-m-d H:i:s');
      $plus_20days = date('Y-m-d H:i:s', strtotime('+20 days',strtotime($curdate)));

       $table = 'user';
        $email_address = secure_database($email_address);
        $oldpassword = secure_database($oldpassword);
        $newpassword = secure_database($newpassword);
        $cnewpassword = secure_database($cnewpassword);

        $oldpassword = md5($oldpassword);
        $newpassword = md5($newpassword);
        $cnewpassword = md5($cnewpassword);

        $check = check_record_by_two_params($table,'email_address',$email_address,'password',$oldpassword);
        $check2 = check_record_by_one_param($table,'email_address',$email_address);
        if($check == true and $check2 == true){
           
            $get_rec = get_one_row_by_id($table,'email_address',$email_address);
            $user_id = $get_rec['user_id'];
            if($newpassword == $cnewpassword){

            $sql = "UPDATE `$table` SET `password`='$newpassword' where `email_address`='$email_address' AND `password`='$oldpassword'";
            $query = mysqli_query($dbc,$sql);


          $check_first = check_record_by_two_params('password_log','user_id',$user_id,'user_type',1);
          if($check_first){
                $sql_upll = "UPDATE `password_log` SET `when_updated_last`= '$curdate',`expiry_date`='$plus_20days' WHERE `user_type`=1 AND `user_id`='$user_id'";
                   $query_upll = mysqli_query($dbc,$sql_upll);
                    if($query_upll){
                      return json_encode(array( "status"=>111, "msg"=>"success, password valid for 20 days" ));
                      }else{
                      return json_encode(array( "status"=>100, "msg"=>"something went wrong" ));
                      }
               }else{

                   $sql_ll = "INSERT INTO `password_log` SET
                 
                   `user_id`='$user_id',
                   `user_type`= 1,
                   `when_updated_last`= now(),
                   `expiry_date`= '$plus_20days'

                   ";
                   $query_ll = mysqli_query($dbc,$sql_ll);
                    if($query_ll){
                      return json_encode(array( "status"=>111, "msg"=>"success, password valid for 20 days" ));
                      }else{
                      return json_encode(array( "status"=>100, "msg"=>"something went wrong" ));
                      }

               } 


            }else{
                return json_encode(array("status"=>100,"msg"=>"password mismatch"));
            }

        }

  else{
                return json_encode(array( "status"=>100, "msg"=> "no traceable record" ));
   
    }

}


function admin_change_password($email_address,$oldpassword,$newpassword,$cnewpassword){
  global $dbc;
        $curdate = date('Y-m-d H:i:s');
         $plus_20days = date('Y-m-d H:i:s', strtotime('+20 days',strtotime($curdate)));
  
       $table = 'admin';
        $email_address = secure_database($email_address);
        $oldpassword = secure_database($oldpassword);
        $newpassword = secure_database($newpassword);
        $cnewpassword = secure_database($cnewpassword);

        $oldpassword = md5($oldpassword);
        $newpassword = md5($newpassword);
        $cnewpassword = md5($cnewpassword);

        $check = check_record_by_two_params($table,'email_address',$email_address,'password',$oldpassword);
        $check2 = check_record_by_one_param($table,'email_address',$email_address);
        if($check == true and $check2 == true){
           
            $get_rec = get_one_row_by_id($table,'email_address',$email_address);
            $admin_id = $get_rec['admin_id'];
            if($newpassword == $cnewpassword){

            $sql = "UPDATE `$table` SET `password`='$newpassword' where `email_address`='$email_address' AND `password`='$oldpassword'";
            $query = mysqli_query($dbc,$sql);


          $check_first = check_record_by_two_params('password_log','user_id',$admin_id,'user_type',2);
          if($check_first){
                $sql_upll = "UPDATE `password_log` SET `when_updated_last`= '$curdate',`expiry_date`='$plus_20days' WHERE `user_type`=1 AND `user_id`='$admin_id'";
                   $query_upll = mysqli_query($dbc,$sql_upll);
                    if($query_upll){
                      return json_encode(array( "status"=>111, "msg"=>"success, password valid for 20 days" ));
                      }else{
                      return json_encode(array( "status"=>100, "msg"=>"something went wrong" ));
                      }
               }else{

                   $sql_ll = "INSERT INTO `password_log` SET
                 
                   `user_id`='$admin_id',
                   `user_type`= 2,
                   `when_updated_last`= now(),
                   `expiry_date`= '$plus_20days'

                   ";
                   $query_ll = mysqli_query($dbc,$sql_ll);
                    if($query_ll){
                      return json_encode(array( "status"=>111, "msg"=>"success, password valid for 20 days" ));
                      }else{
                      return json_encode(array( "status"=>100, "msg"=>"something went wrong" ));
                      }

               } 


            }else{
                return json_encode(array("status"=>100,"msg"=>"password mismatch"));
            }

        }

  else{
                return json_encode(array( "status"=>100, "msg"=> "no traceable record" ));
   
    }

}





function view_single_client($admin_id,$uemail_address){
      global $dbc;
        $admin_id = secure_database($admin_id);     
        $uemail_address = secure_database($uemail_address);     
        $check_admin_exist = check_record_by_one_param('admin','added_by',$admin_id);
        $check_admin_exist2 = check_record_by_one_param('admin','admin_id',$admin_id);
        $check_client_exist = check_record_by_one_param('user','email_address',$uemail_address);
        $array= array();


       if($check_admin_exist == false  AND  $check_admin_exist2 == false){

                return json_encode(array( "status"=>105, "msg"=>"you are not authorized!" ));

         }

         else if($check_client_exist == false){

                return json_encode(array( "status"=>105, "msg"=>"client does not exist!" ));

         }

         else{

              $sql = "SELECT * FROM `user` where `email_address`='$uemail_address'";
              $query = mysqli_query($dbc,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){
                    $row = mysqli_fetch_array($query);


                      if($row['status'] == 1){
                        $status = "active";
                      }

                      if($row['status'] == 0){
                        $status = "disabled";
                      }

                      if($row['status'] == 2){
                        $status = "suspended";
                      }

                    $array_row = array(
                        'first_name'=> $row['first_name'],
                        'last_name'=> $row['last_name'],
                        'other_name'=> $row['other_name'],
                        'phone'=> $row['mobile_phone_number'],
                        'email'=> $row['email_address'],
                        'other_details'=> $row['other_details'],
                       
                        'channel'=> $row['channel'],
                        'status'=> $status,
                        'secret_question'=> $row['sece_ques'],
                        'secret_answer'=> $row['sece_ans'],
                         'when_added'=> $row['when_added'] 
                      );
                     array_push($array, $array_row);
                     return json_encode($array);
                    //return json_encode(array('status'=>111,"msg"=>json_encode($array)));

              }else{

                     return json_encode(array( "status"=>106, "msg"=>"no record found" ));

              }



         }


}



//////////////////////////////not needed for now
