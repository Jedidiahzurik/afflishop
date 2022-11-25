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
*/
$f_xid = $_POST['pay_xid'];

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
$i=0;
foreach($_SESSION['cart_download_path'] as $key => $value){
    $i++;
    $arr_cart_download_path[$i] = $value;
    
}
if($_SESSION['ven_set'] == $_SESSION['customer']['cust_email']){
 $is_from_true_vendor = "SYSTEM";
}
else{
$is_from_true_vendor = $_SESSION['ven_set']; //$_SESSION['customer']['cust_email'];
}


 

    for($i=1;$i<=count($arr_cart_p_id);$i++){
        	$statement = $pdo->prepare("INSERT INTO tbl_product_aff(
        	                             
										p_name,
										p_old_price,
										p_current_price,
										p_qty,
										p_featured_photo,
										p_description,
										p_short_description,
										p_feature,
										p_condition,
										p_return_policy,
										p_total_view,
										p_is_featured,
										p_is_active,
										ecat_id,
										aff_token,
										aff_percent,
										main_product,
										date,
										xid
									) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$statement->execute(array(      
										$arr_cart_p_name[$i],
										$arr_cart_p_old_price[$i],
										$arr_cart_p_current_price[$i],
										$arr_cart_p_qty[$i],
										$arr_cart_p_featured_photo[$i],
										$arr_cart_p_description[$i],
										$arr_cart_p_short_description[$i],
										$arr_cart_p_feature[$i],
										$arr_cart_p_condition[$i],
										$arr_cart_p_return_policy[$i],
										$arr_cart_p_total_view[$i],
										$arr_cart_p_is_featured[$i],
										$arr_cart_p_is_active[$i],
										$arr_cart_ecat_id[$i],
                                        $is_from_true_vendor,
										$arr_cart_aff_percent[$i],
										$arr_cart_download_path[$i],
										date('Y-m-d H:i:s'),
										$f_xid
									));
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE main_product ='".$arr_cart_download_path[$i]."'");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
		    $owner_ven_main = $row['owner_token'];
		}
							
	$statement = $pdo->prepare("INSERT INTO tbl_product_ven(
        	                             
										p_name,
										p_old_price,
										p_current_price,
										p_qty,
										p_featured_photo,
										p_description,
										p_short_description,
										p_feature,
										p_condition,
										p_return_policy,
										p_total_view,
										p_is_featured,
										p_is_active,
										ecat_id,
										aff_token,
										aff_percent,
										main_product,
										date,
										xid
									) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$statement->execute(array(      
										$arr_cart_p_name[$i],
										$arr_cart_p_old_price[$i],
										$arr_cart_p_current_price[$i],
										$arr_cart_p_qty[$i],
										$arr_cart_p_featured_photo[$i],
										$arr_cart_p_description[$i],
										$arr_cart_p_short_description[$i],
										$arr_cart_p_feature[$i],
										$arr_cart_p_condition[$i],
										$arr_cart_p_return_policy[$i],
										$arr_cart_p_total_view[$i],
										$arr_cart_p_is_featured[$i],
										$arr_cart_p_is_active[$i],
										$arr_cart_ecat_id[$i],
                                        $owner_ven_main,
										$arr_cart_aff_percent[$i],
										$arr_cart_download_path[$i],
										date('Y-m-d H:i:s'),
										$f_xid
									));									
if(true){
    	$statement = $pdo->prepare("INSERT INTO tbl_downloads(
        	                             
        	                            customer_id,
										customer_email,
										download_path,
										product_image,
										payment_date,
										product_name,
										aff_percent,
										aff_token,
										xid
										
									) VALUES (?,?,?,?,?,?,?,?,?)");
		$statement->execute(array(      
		                                $_SESSION['customer']['cust_id'],
		                                $_SESSION['customer']['cust_email'],
										$arr_cart_download_path[$i],
										$arr_cart_p_featured_photo[$i],
										date('Y-m-d H:i:s'),
										$arr_cart_p_name[$i],
										$arr_cart_aff_percent[$i],
										$is_from_true_vendor,
										$f_xid
									));
}

    }
		   

    		    
    		    
    		    //require "fpages.php";
                //if_pay_r_den_mail($gfirstname,$from_name,$email,$chain_plan,$amount_paid,$required_amount,$senders_addr,$receiver_addr);
    		   // sleep(2);
            
       
        
require "cart_i_d.php";
echo "blah";

?>