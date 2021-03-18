<?php $sms_sender_id = 'CloudWare';//values in this script should be changed by app configureation
$app_domain = $_SERVER['HTTP_HOST'];
$app_name = 'Extra-Funding';
$app_slug = 'Extra-Funding';
$app_link = $_SERVER['HTTP_HOST'];
$app_domain_root= $_SERVER['HTTP_HOST'];
date_default_timezone_set('Africa/Lagos');
//set timezone
$report_dir = "report/";
$report_pre_fix = 'report';

//NB: Expiry date is in days
$expiry_date = "60";

//Country code: NB: Should be a string
$country_code = "234";

//paystack secret testkey
$secret_key = 'sk_live_3811f301276c2252058b122991a6d3a92fb2c6bc';


$uploads_path = "C:/wamp64/www/eac/api/";

?>
