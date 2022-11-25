<?php
ob_start();
session_start();
include("f_h/admin/inc/config.php");
include("f_h/admin/inc/functions.php");
include("f_h/admin/inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
require 'gws/vendor/autoload.php';
 use Goutte\Client;
 $client = new Client();
 
 $amount_c = $_POST['amount_c'];
 $is_aff = $_SESSION['customer']['is_aff'];
$is_ven = $_SESSION['customer']['is_ven'];
if($amount_c < 10 && $amount_c >= 8){
    $is_aff = 1;
    if($is_ven != 1){
    $is_ven = 0;
    }
}
if($amount_c >= 10){
    if($is_aff !=1){
    $is_aff = 0;
    }
    $is_ven = 1;
}
 
        	$statement = $pdo->prepare("UPDATE tbl_customer SET 
        							is_aff=?, 
        							is_ven=?

        							WHERE cust_email='".$_SESSION['customer']['cust_email']."'");
        	$statement->execute(array(
        							$is_aff,
        							$is_ven
        						));		   

 
 
 
 
//  require "fpages.php";
//                 if_pay_r_den_mail($gfirstname,$from_name,$email,$chain_plan,$amount_paid,$required_amount,$senders_addr,$receiver_addr);
//     		    sleep(2);
    		    
    		    
    		    echo "blah";

 
 
 
 
 
 
 
 
 
 ?>