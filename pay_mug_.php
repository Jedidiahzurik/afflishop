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
/* 
$dbhost ="localhost"; //xpressjv_tknusers db
$dbuser = "xpressjv_for_comms";//"globalca_root";
$dbpass = "Db8hS?2NyR=%";//"fW4j3J_qb9Nc";
$dbname ="xpressjv_ecommerceweb";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
	die("Failed to connect");
}
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($db->connect_errno){
	die("Failed to connect");	
}



$i=0;
foreach($_SESSION['cart_p_id'] as $key => $value) {
    $i++;
    $arr_cart_p_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_size_id'] as $key => $value) {
    $i++;
    $arr_cart_size_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_size_name'] as $key => $value) {
    $i++;
    $arr_cart_size_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_color_id'] as $key => $value) {
    $i++;
    $arr_cart_color_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_color_name'] as $key => $value) {
    $i++;
    $arr_cart_color_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_qty'] as $key => $value) {
    $i++;
    $arr_cart_p_qty[$i] = $value;
    //$arr_cart_p_qty[$i] = 1;
}

$i=0;
foreach($_SESSION['cart_p_current_price'] as $key => $value) {
    $i++;
    $arr_cart_p_current_price[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_name'] as $key => $value) {
    $i++;
    $arr_cart_p_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_featured_photo'] as $key => $value) {
    $i++;
    $arr_cart_p_featured_photo[$i] = $value;
}


$i=0;
foreach($_SESSION['cart_p_old_price'] as $key => $value) {
    $i++;
    $arr_cart_p_old_price[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_description'] as $key => $value) {
    $i++;
    $arr_cart_p_description[$i] = $value;
    $arr_cart_p_description[$i] = base64_decode($arr_cart_p_description[$i]);
}
$i=0;
foreach($_SESSION['cart_p_short_description'] as $key => $value) {
    $i++;
    $arr_cart_p_short_description[$i] = $value;
    $arr_cart_p_short_description[$i] = base64_decode($arr_cart_p_short_description[$i]);
}
$i=0;
foreach($_SESSION['cart_p_feature'] as $key => $value) {
    $i++;
    $arr_cart_p_feature[$i] = $value;
    $arr_cart_p_feature[$i] = base64_decode($arr_cart_p_feature[$i]);
    
}
$i=0;
foreach($_SESSION['cart_p_condition'] as $key => $value) {
    $i++;
    $arr_cart_p_condition[$i] = $value;
    $arr_cart_p_condition[$i] = base64_decode($arr_cart_p_condition[$i]);
}
$i=0;
foreach($_SESSION['cart_p_return_policy'] as $key => $value) {
    $i++;
    $arr_cart_p_return_policy[$i] = $value;
    $arr_cart_p_return_policy[$i] = base64_decode($arr_cart_p_return_policy[$i]);
}
$i=0;
foreach($_SESSION['cart_p_total_view'] as $key => $value) {
    $i++;
    $arr_cart_p_total_view[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_is_featured'] as $key => $value) {
    $i++;
    $arr_cart_p_is_featured[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_is_active'] as $key => $value) {
    $i++;
    $arr_cart_p_is_active[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_ecat_id'] as $key => $value) {
    $i++;
    $arr_cart_ecat_id[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_aff_percent'] as $key => $value) {
    $i++;
    $arr_cart_aff_percent[$i] = $value;
}
*/
//$amount_c;
//$is_from_true_vendor = $_SESSION['customer']['is_from_true_vendor'];

//function init_($arr_cart_p_id,$client,$pdo){
    
    
 $last_trx_id = $last_trx_from = $last_trx_status_in = $last_trx_to = $last_trx_value = $last_trx_coin = "";


    function bgcolor(){return dechex(rand(0,10000000));}

if(isset($_POST['payin']) && isset($_POST['payfrom'])){
$data = [];
    
$dbhost_ ="localhost"; //xpressjv_tknusers db
$dbuser_ = "xpressjv_tknroot";//"globalca_root";
$dbpass_ = "!V5.Woy50zcg";//"fW4j3J_qb9Nc";
$dbname_ ="xpressjv_tknusers";

if(!$con_ = mysqli_connect($dbhost_, $dbuser_, $dbpass_, $dbname_))
{
	die("Failed to connect");
}
$db = new mysqli($dbhost_, $dbuser_, $dbpass_, $dbname_);
if($db->connect_errno){
	die("Failed to connect");	
}

$sql = "SELECT * FROM walimg_ekomm";
  $result = mysqli_query($db,$sql);
  while ($row = mysqli_fetch_array($result)) {
    
    if($row['coin'] == "TRON"){
    $addr_tron = $row['addr'];
  }
    if($row['coin'] == "USDT (Trc20)"){
    $addr_usdt = $row['addr'];
  } 
  
 }
  
  
//if(isset($_POST['payin']) && isset($_POST['payfrom'])){
$data = [];

$payfrom = $_SESSION['customer']['cust_wallet_address'];
//https://tronscan.org/#/address/TQvNSuRWq7g99iD25NTmagpNAFsguGen8v
//$url = "https://tronscan.org/#/address/TAfBAF2ZSY1cUDdrFxDsa5JVvYhZ42v6fv";//$payfrom";
//$crawler = $client->request('GET', $url);

//main_admin adrr = tron=usdt :note
$url_m = "https://tronscan.org/#/address/$addr_tron";
$crawle_m = $client->request('GET', $url_m);


// if(isset($_SESSION['paycount'])){
 $_SESSION['paycount']++;
// }
// else{
// $_SESSION['paycount'] = 1;
// }
if($_SESSION['paycount'] == 1){
    //  usdt
    try{
$init_payfrom_bal_usdt = $crawler->filter("#rc-tabs-0-panel-1 > div > div:nth-child(2) > div.token-balance-item-right > div.token-value")->text();
$xu = $init_payfrom_bal_usdt;//"??? $1.80";
$xu_ = explode("$",$xu);
$xu__ = $xu_[1];
//$init_payfrom_bal_usdt = $xu__;
    // tron
$init_payfrom_bal_tron = $crawler->filter("#rc-tabs-0-panel-1 > div > div:nth-child(1) > div.token-balance-item-right > div.token-value")->text();
$xt = $init_payfrom_bal_tron;//"??? $1.80";
$xt_ = explode("$",$xt);
$xt__ = $xt_[1];
$init_payfrom_bal_tron = $xt__;   

    //admin tron
$init_payfrom_bal_tron_m = $crawler_m->filter("#rc-tabs-0-panel-1 > div > div:nth-child(1) > div.token-balance-item-right > div.token-value")->text();
$mxt = $init_payfrom_bal_tron_m;//"??? $1.80";
$mxt_ = explode("$",$mxt);
$mxt__ = $mxt_[1];
$init_payfrom_bal_tron_m = $mxt__;  

    //admin usdt
$init_payfrom_bal_usdt_m = $crawler_m->filter("#rc-tabs-0-panel-1 > div > div:nth-child(2) > div.token-balance-item-right > div.token-value")->text();
$mxu = $init_payfrom_bal_usdt_m;//"??? $1.80";
$mxu_ = explode("$",$mxu);
$mxu__ = $mxu_[1];
$init_payfrom_bal_usdt_m = $mxu__;    
    } catch (exception $e){}
}
else{
if($_POST['payin'] == "usdt"){
    $url = "https://www.oklink.com/en/trx/address/$payfrom";
    $crawler = $client->request('GET', $url);
    
$payinto = $addr_usdt;//$_POST['payin'];
$current_payfrom_bal_usdt_  = $crawler->filter("#root > main > div > div > div.single-pannel.index-module__content--HOUbT > div > div:nth-child(2) > div > div > div.index-module__header--VSRGB > div:nth-child(2) > span.index-module__sizeSM--OAmOQ.index-module__weightNormal--wlMFv.color-text-light")->text();
#rc-tabs-0-panel-1 > div > div:nth-child(2) > div.token-balance-item-right > div.token-value
    try{
        //user
$current_payfrom_bal_usdt  = $crawler->filter("#rc-tabs-0-panel-1 > div > div:nth-child(2) > div.token-balance-item-right > div.token-value")->text();
$yu = $current_payfrom_bal_usdt;//"??? $1.80";
$yu_ = explode("$",$yu);
$yu__ = $yu_[1];
$current_payfrom_bal_usdt = $yu__;
    //admin
$current_payfrom_bal_usdt_m  = $crawler_m->filter("#rc-tabs-0-panel-1 > div > div:nth-child(2) > div.token-balance-item-right > div.token-value")->text();
$myu = $current_payfrom_bal_usdt_m;//"??? $1.80";
$myu_ = explode("$",$myu);
$myu__ = $myu_[1];
$current_payfrom_bal_usdt_m = $myu__;    

$diff_ = $current_payfrom_bal_usdt - $init_payfrom_bal_usdt;
$diff_admin = $current_payfrom_bal_usdt_m - $init_payfrom_bal_usdt_m;
    } catch (exception $e){}
}

if($_POST['payin'] == "tron"){
$payinto = $addr_tron;//$_POST['payin'];
    try{
$current_payfrom_bal_tron  = $crawler->filter("#rc-tabs-0-panel-1 > div > div:nth-child(1) > div.token-balance-item-right > div.token-value")->text();
$yt = $current_payfrom_bal_tron;//"??? $1.80";
$yt_ = explode("$",$yt);
$yt__ = $yt_[1];
$current_payfrom_bal_tron = $yt__;

//admin
$current_payfrom_bal_tron_m  = $crawler_m->filter("#rc-tabs-0-panel-1 > div > div:nth-child(1) > div.token-balance-item-right > div.token-value")->text();
$myt = $current_payfrom_bal_tron_m;//"??? $1.80";
$myt_ = explode("$",$myt);
$myt__ = $myt_[1];
$current_payfrom_bal_tron = $myt__;

$diff_admin = $current_payfrom_bal_tron_m - $init_payfrom_bal_tron_m;
$diff_ = $current_payfrom_bal_tron - $init_payfrom_bal_tron;
    } catch (exception $e){}
}

}
//$diff_ >= $_SESSION['t_f_check_out'] && $diff_admin == $diff_

$payfrom = $_POST['payfrom'];
$amount_c = $_POST['amount_c'];
$is_paid = "False";
$r_color = bgcolor();
$pay_err = "";
 //$payinto = $addr_tron;
 //$payfrom = "0x45c4789206e9d34f2c0dd22a04f84949d51a9113";

//  $url = "https://bscscan.com/address-tokenpage?m=normal&a=$payinto";
//  $crawler = $client->request('GET', $url);

// try{
// $last_trx_status_in = $crawler->filter("#body > div.table-responsive > table > tbody > tr:nth-child(1) > td:nth-child(6) > span")->text();
// $last_trx_id = $crawler->filter("#body > div.table-responsive > table > tbody > tr:nth-child(1) > td:nth-child(2) > span > a")->text();

// $last_trx_age = $crawler->filter("#body > div.table-responsive > table > tbody > tr:nth-child(1) > td.showAge > span")->text();
// $last_trx_date = $crawler->filter("#body > div.table-responsive > table > tbody > tr:nth-child(1) > td.showDate > span")->text();

// $last_trx_from = $crawler->filter("#body > div.table-responsive > table > tbody > tr:nth-child(1) > td:nth-child(5) > a")->text();
// $last_trx_to = $crawler->filter("#body > div.table-responsive > table > tbody > tr:nth-child(1) > td:nth-child(7) > span")->text();
// $last_trx_value = $crawler->filter("#body > div.table-responsive > table > tbody > tr:nth-child(1) > td:nth-child(8)")->text();
// $last_trx_coin = $crawler->filter("#body > div.table-responsive > table > tbody > tr:nth-child(1) > td:nth-child(9) > a")->text();

// $last_trx_coin = trim($last_trx_coin);
// $last_trx_from = trim($last_trx_from);
// $payfrom = trim($payfrom);

// $payfrom = strtolower($payfrom);
// $last_trx_from = strtolower($last_trx_from);

// // $fd= time(date("$last_trx_date"));//strtotime($last_trx_date);
// // $date_now = time();//date("Y-m-d h:i:sa"); 
// // $date_diff = $date_now - $fd;
// // $w_min = $date_diff/60;
// // //must be $w_min<10 == 1

// }
// catch (exception $e){
//     //$last_trx_coin = $last_trx_from = $last_trx_status_in = $last_trx_to = $last_trx_value = $last_trx_coin = "";

// }

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
$int = $diff_;//$num;

$last_trx_from = $payfrom;
$last_trx_to =  $addr_tron;  
$last_trx_coin = $_POST['payin'];
$last_trx_value = $int;
$plan_w = $amount_c;



    
    $amount_paid = $int;
    $required_amount = $plan_w;
    $senders_addr = $last_trx_from;
    $receiver_addr = $last_trx_to;
if( true
    //$diff_ >= $amount_c && $diff_admin == $diff_
    //$last_trx_status_in !="OUT"
    ){

// $num = $last_trx_value;
// $int = (float)$num;

    
// if(
//     $last_trx_coin == $token_p && $payfrom == $last_trx_from && $int >= $amount_c
//     ){
        
//$is_paid = "True";
$tab = '<table class="table summery-table">
<thead>
  <tr>
    <th>You'.$current_payfrom_bal_usdt_.'xx</th>
    <!--<th>Grand Upline</th>-->
    <th>Amount</th>
    <th>Status</th>
  </tr>
</thead>  
<tbody>
  <tr class="order-subtotal">
    <td><b>'.$last_trx_from.'</b></td>
    <!--<td><b>'.$last_trx_to.'</b></td>-->
    <td><b>'.$last_trx_value.'</b></td>
    <td><b>'.$is_paid.'</b></td>
    
  </tr>
</tbody>  

</table>';

 
if($is_paid == 'True'){
 
        	$statement = $pdo->prepare("UPDATE tbl_customer SET 
        							is_aff=?, 
        							is_ven=?

        							WHERE cust_email='".$_SESSION['customer']['cust_email']."'");
        	$statement->execute(array(
        							$is_aff,
        							$is_ven
        						));		   

    		    
    		    }
    		    require "fpages.php";
                if_pay_r_den_mail($gfirstname,$from_name,$email,$chain_plan,$amount_paid,$required_amount,$senders_addr,$receiver_addr);
    		    sleep(2);
            

        
    // }       
        // 	$data = array(
        //             "trx_id" => $last_trx_id,
        //             "trx_age" =>  $last_trx_age,
        //             "trx_from" => $last_trx_from,
        //             "trx_status" =>  $last_trx_status_in,
        //             "trx_to" => $last_trx_to,
        //             "trx_value" => $last_trx_value,
        //             "trx_coin" => $last_trx_coin,
        //             "tab" => $tab,
        //             "status" => $is_paid,
        //             "pay_err" => $pay_err
                    
        //         );
        $data = array(
                    
                    "trx_from" => $last_trx_from,
                    
                    "trx_to" => $last_trx_to,
                    "trx_value" => $last_trx_value,
                    "trx_coin" => $last_trx_coin,
                    "tab" => $tab,
                    "status" => $is_paid,
                    "pay_err" => $pay_err
                    
                );
require "cart_i_d.php";
} elseif(
    $diff_ < $amount_c && $diff_admin == $diff_
    // $last_trx_coin == $token_p && $payfrom == $last_trx_from && $int < $amount_c
    ){
    $is_paid = "True";

                  //paying less than amount.  
                    $tab = '<i class="fas fa-exclamation-triangle" style="font-size:25px;color:#';
                    $tab .= $r_color.';"></i><b><h3><small>The payment system detected that you paid $'.$int.' instead of the required amount of $'.$plan_w.' Despite the warning.</h3>';
                    $tab .= 'Hence your Order will not be completed.<br>Contact support for a refund..</b>';
    
    $data = array(
                   
                    "tab" => $tab,
                    "status" => $is_paid,
                    "pay_err" => $pay_err
                    
                ); 
                if($is_paid == "True"){
                // if_pay_w_den_mail($gfirstname,$from_name,$email,$chain_plan,$amount_paid,$required_amount,$senders_addr,$receiver_addr);
                }
                
                    
} else {
                    $tab = '<i class="fa fa-spinner w3-spin" style="font-size:25px;color:#';
                    $tab .= $r_color.';"></i><b><h3><small>Awaiting payment...</small></h3>';
                    $tab .= 'Keep this page open, verification only take a few seconds and is done automatically upon payment.</b>';
    
    $data = array(
                   
                    "tab" => $tab,
                    "status" => $is_paid,
                    "pay_err" => $pay_err
                    
                );  
    
}

} else {
                    $tab = '<i class="fa fa-spinner w3-spin" style="font-size:25px;color:#';
                    $tab .= $r_color.';"></i><b><h3><small>Awaiting payment...</small></h3>';
                    $tab .= 'Keep this page open, verification only take a few seconds and is done automatically upon payment.</b>';
    
    $data = array(
                   
                    "tab" => $tab,
                    "status" => $is_paid ,
                    "pay_err" => $pay_err
                    
                );  
    
}
                echo json_encode($data);
 

    
//}
//init_($arr_cart_p_id,$client,$pdo);

  





?>