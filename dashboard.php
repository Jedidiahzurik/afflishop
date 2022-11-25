
<?php
include('high_header.php');
// if (isset($_POST['form1_updt_p'])) {
// if($_FILES){
//     print_r($_FILES);
//      print_r($_POST);
// die;
// }
// die;
// }
?>   

<body class="sticky-header" onload="opencart()" style="margin:10px;">
    <?php echo $after_body; ?>
<?php
// Check if the customer is logged in or not
if(!isset($_SESSION['customer'])) {
    header('location: '.BASE_URL.'logout.php');
    exit;
} else {
    $_SESSION['customer'] = (array)$_SESSION['customer'];
    $arrr = $_SESSION["customer"];
    // print_r($arrr);
    // die;
    // If customer is logged in, but admin make him inactive, then force logout this user.
    $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?");
    $statement->execute(array($_SESSION['customer']['cust_id'],0));
    $total = $statement->rowCount();
    if($total) {
        header('location: '.BASE_URL.'logout.php');
        exit;
    }
}
?>
<?php

if(isset($_POST['f_withdraw__'])) {
    //paid_amount txnid payment_method payment_status date
    
    $paid_amount = $_POST['paid_amount'];
    $txnid = $_POST['txnid'];
    $payment_method = "Referral Commission: ".$_POST['payment_method'];
    $payment_status = $_POST['payment_status'];
    $date = $_POST['date'];
    
 $statement = $pdo->prepare("INSERT INTO tbl_withdraw (txnid,paid_amount,payment_method,payment_status, payment_date, customer_email) VALUES (?,?,?,?,?,?)");
 $statement->execute(array($txnid,$paid_amount,$payment_method,$payment_status,date("Y-m-d h:i:sa"),$_SESSION['customer']['cust_email']));        
   
 if(true) {
//$sql = "DELETE FROM chatid WHERE s_chat_id='$q'";
//        $statement = $pdo->prepare("UPDATE tbl_customer SET cust_name=?, cust_cname=?, cust_phone=?, cust_country=?, cust_address=?, cust_city=?, cust_state=?, cust_zip=? WHERE cust_id=?");
     
     $statement = $pdo->prepare("UPDATE tbl_customer SET is_ref_paid = 1 WHERE cust_pref_email ='".$_SESSION['customer']['cust_email']."'");
 $statement->execute();        
  
 }
 header("location: dashboard_w.php");  
    
    
}


?>
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    <!-- Start Header -->
<?php
include('templates/header_shop_style.php');
?>     <!-- End Header -->

    <main class="main-wrapper">
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">My Account</li>
                            </ul>
                            <!--<h6 class="title"><?php echo LANG_VALUE_90; ?></h6>-->
                        </div>
                        </div>
                       <!-- <div class="col-lg-12">
                                <div class="axil-shop-top mb--40">
                                 
                                                
                                                <div class="row" style="display:flex;flex-direction:row;flex-wrap:wrap;justify-content:space-around;width:100%;">
                                    <div class="form-group mb--0" style="width:50%;">
                                         <?php if($_SESSION['customer']['is_aff'] == 0):?>
                                                            <a href="upgrade.php?user=affiliate"><button type="button" class="axil-btn btn-bg-primary"  name="Upgrade_a">Upgrade to Affiliate</button></a>
                                            <?php else: ?>
                                            <a href="dashboard_a.php?user=affiliate"><button type="button" class="axil-btn btn-bg-primary"  name="Upgrade_a">Go to Affiliate Dashboard</button></a>
                                            <hr><a href="dashboard_w.php?user=affiliate"><button type="button" class="axil-btn btn-bg-primary"  name="Upgrade_a">See Withdrawals</button></a>
        
                                        <?php endif; ?> 
                                                        </div>
                                     <div class="form-group mb--0" style="width:50%;">
                                         <?php if($_SESSION['customer']['is_ven'] == 0):?>
                                                            <a href="upgrade.php?user=vendor"><button type="button" class="axil-btn btn-bg-primary"  name="Upgrade_v">Upgrade to Vendor</button></a>
                                            <?php else: ?>
                                            <a href="./u/product.php"><button type="button" class="axil-btn btn-bg-primary"  name="Upgrade_v">Go to Vendor Dashboard</button></a>
        
                                        <?php endif; ?>             
                                                        </div>
                                                </div>
                                                        
                                </div>
                            </div>-->
                    <?php if(isset($_SESSION['customer']['profile_pic']) && $_SESSION['customer']['profile_pic'] != ""):?>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img src="assets/uploads/<?=$_SESSION['customer']['profile_pic']?>" alt="Image" style="width:100px;height:100px;border-radius:10px;">
                            </div>
                        </div>
                    </div>
                    <?php else:?>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img src="assets/uploads/profile_picdE09036168Ae7B.jpg?>" alt="Image" style="width:100px;height:100px;border-radius:10px;">
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
         
       
                        
        <div class="row">
                            
        <!-- End Breadcrumb Area  -->

        <!-- Start My Account Area  -->
        <div class="axil-dashboard-area axil-section-gap">
            <div class="container">
                <div class="axil-dashboard-warp">
                    <div class="axil-dashboard-author">
                        <div class="media">
                            <?php if(isset($_SESSION['customer']['profile_pic']) && $_SESSION['customer']['profile_pic'] != ""):?>
                            <div class="thumbnail">
                                <img src="assets/uploads/<?=$_SESSION['customer']['profile_pic']?>" alt="<?=$_SESSION['customer']['cust_name']?>" style="width:100px;height:100px;border-radius:10px;">
                            </div>
                            <?php else:?>
                            <div class="thumbnail">
                                <img src="assets/uploads/profile_picdE09036168Ae7B.jpg" alt="<?=$_SESSION['customer']['cust_name']?>" style="width:100px;height:100px;border-radius:10px;">
                            </div>
                            <?php endif;?>
                            <div class="media-body">
                                <h5 class="title mb-0">Hello <?=$_SESSION['customer']['cust_name']?></h5>
                                <span class="joining-date">User Since <?=$_SESSION['customer']['cust_datetime']?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                       <?php require_once('templates/customer-sidebar.php'); ?>
                        <div class="col-xl-9 col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                                    <div class="axil-dashboard-overview">
                                        <div class="welcome-text">Hello <?=$_SESSION['customer']['cust_name']?> (not <span><?=$_SESSION['customer']['cust_name']?>?</span> <a href="logout.php">Log Out</a>)</div>
                                        <p>From your account dashboard you can view your recent orders, manage your infos, and edit your password and account details.</p>
                                        
                                         <?php
                                if($_SESSION['f_em'] != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$_SESSION['f_em']."</div>";
                                    unset($_SESSION['f_em']);
                                }
                                if($_SESSION['f_sm'] != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$_SESSION['f_sm']."</div>";
                                    unset($_SESSION['f_sm']);
                                }
                                ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-orders" role="tabpanel">
                                    <div class="axil-dashboard-order">
                                        <h6><?php echo LANG_VALUE_25; ?></h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                    <th><small style="font-size:12px;"><?php echo '#' ?></small></th>
                                    <!--<th><small style="font-size:12px;"><?php echo LANG_VALUE_48; ?></small></th>-->
                                    <th><small style="font-size:12px;"><?php echo LANG_VALUE_27; ?></small></th>
                                    <th><small style="font-size:12px;"><?php echo LANG_VALUE_28; ?></small></th>
                                    <th><small style="font-size:12px;"><?php echo LANG_VALUE_29; ?></small></th>
                                    <th><small style="font-size:12px;"><?php echo LANG_VALUE_30; ?></small></th>
                                    <th><small style="font-size:12px;"><?php echo LANG_VALUE_31; ?></small></th>
                                    <th><small style="font-size:12px;"><?php echo LANG_VALUE_32; ?></small></th>
                                </tr>
                                                </thead>
                                                <tbody>
                                                    
                                       
                                            <?php
                                            $i=0;
                                            $statement1 = $pdo->prepare("SELECT * FROM tbl_withdraw WHERE customer_email='".$_SESSION['customer']['cust_email']."'");
                                            $statement1->execute();
                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) { 
                                                $i++;
                                                ?>
                                               <tr>
                                       <td><?php echo $i; ?></td>
                                        <td><?php echo $row1['payment_date']; ?></td>
                                        <td><?php echo $row1['txnid']; ?></td>
                                        <td><?php echo '$'.$row1['paid_amount']; ?></td>
                                        <td><?php echo $row1['payment_status']; ?></td>
                                        <td><?php echo $row1['payment_method']; ?></td>
                                        <td><?php echo $row1['payment_id']; ?></td>
                                    </tr>
                                    <?php
                                } 
                                ?>     
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-downloads" role="tabpanel">
                                    <div class="axil-dashboard-order">
                                                                                <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                    <th><small style="font-size:12px;"><?php echo '#' ?></small></th>
                                    <th><small style="font-size:12px;">Image</small></th>
                                    <th><small style="font-size:12px;">Downloads</small></th>
                                    <th><small style="font-size:12px;">Date</small></th>
                                    
                                </tr>
                                                </thead>
                                                <tbody>
                                                    
                                       
                                            <?php
                                            $i=0;
                                            $statement1 = $pdo->prepare("SELECT * FROM tbl_downloads WHERE customer_email='".$_SESSION['customer']['cust_email']."'");
                                            $statement1->execute();
                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) { 
                                                $i++;
                                                ?>
                                               <tr>
                                       
                                        <td><?php echo $i; ?></td>
                                        <td><img style="width:70px;height:70px;" src="./assets/uploads/<?php echo $row1['product_image']; ?>"></td>
                                        <td><a href="./assets/uploads/<?php echo $row1['download_path']; ?>">Click here to access this product!</a></td>
                                        <td><?php echo '$'.$row1['payment_date']; ?></td>
                                        
                                    </tr>
                                    <?php
                                } 
                                ?>     
                                                </tbody>
                                            </table>
                                        </div>

                                        <!--<p>You don't have any download</p>-->
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-accounty" role="tabpanel">
                                     <div class="col-lg-9">

                                    <div class="axil-dashboard-account">
                                        <?php
                                        $pref = base64_encode($_SESSION['customer']['cust_email']);
                                        
                                        ?>
                                        <p>Your	Referral Link: <br><input spellcheck="false" type="text" style="width:60%;" value="https://afflishop.com/?r=<?=$pref?>" id="myInput_" readonly>
				<img onclick="myFunct()" src="copy.png" style="cursor:pointer; width: 20px; height: 20px;"> click to copy</p>
				<p>For every user registered under your referral link, you get 50% profit from their registeration fee! The table below only shows referrals whose commission you are yet to withdraw.</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                    <th><small style="font-size:12px;"><?php echo '#' ?></small></th>
                                    <th style="font-size:12px;">Referrals </th>
                                    <th style="font-size:12px;">Vendor Commission (50%) </th>
                                    <th style="font-size:12px;">Affiliate Commission (50%) </th>
                                    
                                </tr>
                                                </thead>
                                                <tbody>
                                        


                               <?php       $iy = 0;
                               $for_to_add = 0;
                                            $statement1 = $pdo->prepare("SELECT * FROM tbl_customer  WHERE cust_pref_email='".$_SESSION['customer']['cust_email']."' AND is_ref_paid =0");
                                            $statement1->execute();
                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) {
                                                $iy++;
                                                ?>
                                                <tr>
                                                <td><?php echo $iy; ?></td>
                                                <td><?php echo $row1['cust_name']; ?></td>
                                                <td><?php if($row1['is_ven'] == 1){$for_to_add += 10; echo "$10";} else{ echo "";} ?></td> 
                                                <td><?php if($row1['is_aff'] == 1){$for_to_add +=5; echo "$5";} else{ echo "";} ?></td> 
                                                </tr>    
                                                
                                               <?php
                                            }
                                            ?>
                                                   
                                       
                                      
                                                </tbody>
                                            </table>
                                              

                                        </div>
                                          <div class="row">
                            <div class="axil-order-summery mt--80">
                                <h5 class="title mb--20">Summary</h5>
                                <form action="" method="post">
                                <div class="summery-table-wrap">
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                          
                                            
                                            <tr class="order-total">
                                                <td>Referral Balance</td>
                                                <td class="order-total-amount"><?php echo LANG_VALUE_1; ?><?php echo $for_to_add; ?></td>
                                            </tr>
                                            <tr>
                                                 <?php $_SESSION['ref_com']= $for_to_add ?>
                                            <div class="shipping-amount">
                                                        <span class="title">Method: </span>
                                                        <!--<span class="amount">$35.00</span>-->
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio1" name="payment_method" value="USDT TRC20" checked>
                                                        <label for="radio1">USDT TRC20</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio2" value="TRON TRX" name="payment_method">
                                                        <label for="radio2">TRON TRX</label>
                                                    </div>
                                                    <div class="input-group"><br><br>
                                                        <input type="text" id="radio3" value="<?=$_SESSION['customer']['cust_wallet_address']?>" placeholder="Enter Wallet Address" name="txnid" readonly>
                                                        <label for="radio3">Address</label>
                                                    </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                                <input type="hidden" name="paid_amount" value="<?php echo $for_to_add; ?>">
                                <input type="hidden" name="payment_status" value="Pending">
                                
                                <input type="hidden" name="date" value="<?=date('Y-m-d H:i:s')?>">
                                
                                <button type="submit" name="f_withdraw__" class="axil-btn btn-bg-primary checkout-btn">Withdraw</button>
                                </form>
                            </div>
                    </div>
                                           
                                        
                                        
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-account" role="tabpanel">
                                    <?php
                                    function rand_name($l)
{
	$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','A','B','C','D','E','F','G','H');
	$text = "";
	
	$l = rand(4,$l);
	for($i=0;$i<$l;$i++)
	{
		$random = rand(0,25);
		$text .= $array[$random];
	}
	return $text;
}

if (isset($_POST['form1_updt_p'])) {

    $valid = 1;
$path = $_FILES['profile_pic']['name'];
    $path_tmp = $_FILES['profile_pic']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        // if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
        //     $valid = 0;
        //     $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        // }
    }
    if(empty($_POST['cust_name'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_123."<br>";
    }
     if(empty($_POST['cust_wallet_address'])) {
        $valid = 0;
        $error_message .= "Please enter wallet address to receive and make payment from"."<br>";
    }

    // if(empty($_POST['cust_phone'])) {
    //     $valid = 0;
    //     $error_message .= LANG_VALUE_124."<br>";
    // }

    // if(empty($_POST['cust_address'])) {
    //     $valid = 0;
    //     $error_message .= LANG_VALUE_125."<br>";
    // }

    if(empty($_POST['cust_country'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_126."<br>";
    }

    // if(empty($_POST['cust_city'])) {
    //     $valid = 0;
    //     $error_message .= LANG_VALUE_127."<br>";
    // }

    // if(empty($_POST['cust_state'])) {
    //     $valid = 0;
    //     $error_message .= LANG_VALUE_128."<br>";
    // }

    // if(empty($_POST['cust_zip'])) {
    //     $valid = 0;
    //     $error_message .= LANG_VALUE_129."<br>";
    // }

    $_SESSION['f_em'] = $error_message;


    if($valid == 1) {
$final_name = 'profile_pic'.rand_name(20).'.'.$ext;
// echo $ext;
// die;
        	move_uploaded_file( $path_tmp, './assets/uploads/'.$final_name );
            
        // update data into the database
        $statement = $pdo->prepare("UPDATE tbl_customer SET cust_name=?, cust_cname=?, cust_phone=?, cust_country=?, cust_address=?, cust_city=?, cust_state=?, cust_zip=? , cust_wallet_address = ?, profile_pic =? WHERE cust_id=?");
        $statement->execute(array(
                    strip_tags($_POST['cust_name']),
                    strip_tags($_POST['cust_cname']),
                    strip_tags($_POST['cust_phone']),
                    strip_tags($_POST['cust_country']),
                    strip_tags($_POST['cust_address']),
                    strip_tags($_POST['cust_city']),
                    strip_tags($_POST['cust_state']),
                    strip_tags($_POST['cust_zip']),
                    strip_tags($_POST['cust_wallet_address']),
                    $final_name,
                    $_SESSION['customer']['cust_id']
                ));  
       
        $success_message = LANG_VALUE_130;
        $_SESSION['f_sm'] = $success_message;

        $_SESSION['customer']['cust_name'] = $_POST['cust_name'];
        $_SESSION['customer']['cust_cname'] = $_POST['cust_cname'];
        $_SESSION['customer']['cust_phone'] = $_POST['cust_phone'];
        $_SESSION['customer']['cust_country'] = $_POST['cust_country'];
        $_SESSION['customer']['cust_address'] = $_POST['cust_address'];
        $_SESSION['customer']['cust_city'] = $_POST['cust_city'];
        $_SESSION['customer']['cust_state'] = $_POST['cust_state'];
        $_SESSION['customer']['cust_zip'] = $_POST['cust_zip'];
        $_SESSION['customer']['cust_wallet_address'] = $_POST['cust_wallet_address'];
        $_SESSION['customer']['profile_pic'] = $final_name;
        
        header("location: ./dashboard.php");
        
    }
}
?>

                                    <div class="col-lg-9">
                                        <div class="axil-dashboard-account">
                                            <h6>
                        <?php echo LANG_VALUE_117; ?>
                    </h6>
                     <?php
                    if($error_message != '') {
                        echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$error_message."</div>";
                    }
                    if($success_message != '') {
                        echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$success_message."</div>";
                    }
                    ?>
                                            <form action="" method="post" class="account-details-form" enctype="multipart/form-data">
                                                <?php $csrf->echoInputField(); ?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label><?php echo LANG_VALUE_102; ?> </label>
                                                            <input type="text" class="form-control" name="cust_name" value="<?php echo $_SESSION['customer']['cust_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label><?php echo LANG_VALUE_103; ?></label>
                                                            <input type="text" class="form-control" name="cust_cname" value="<?php echo $_SESSION['customer']['cust_cname']; ?>">
                                                        </div>
                                                    </div>-->
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label><?php echo LANG_VALUE_94; ?></label>
                                                            <input type="text" class="form-control"  name=""  value="<?php echo $_SESSION['customer']['cust_email']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Edit Wallet Address *</label>
                                                            <input type="text" class="form-control"  name="cust_wallet_address"  value="<?php echo $_SESSION['customer']['cust_wallet_address']; ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group" style="display:none;">
                                <label for=""><?php echo LANG_VALUE_104; ?> *</label>
                                <input type="text" class="form-control" name="cust_phone" value="x<?php echo $_SESSION['customer']['cust_phone']; ?>">
                            </div>
                                                    </div>
                                              <div class="col-lg-6">
                                        <div class="form-group" style="">
                                <label for="">Upload a profile picture</label>
                                <input type="file" class="form-control" name="profile_pic">
                            </div>                    
                            </div>      
                                                    <div class="col-6">
                                                        <div class="form-group mb--40">
                                                            <label><?php echo LANG_VALUE_106; ?></label>
                                                            <select name="cust_country" class="form-control">
                                <?php
                                $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo $row['country_id']; ?>" <?php if($row['country_id'] == $_SESSION['customer']['cust_country']) {echo 'selected';} ?>><?php echo $row['country_name']; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                                                            <p class="b3 mt--10">This will be how your name will be displayed in the account section and in reviews</p>
                                                        </div>
                                                    </div>
                                        <div class="col-lg-6">
                                                        <div class="form-group" style="display:none;">
                                <label for=""><?php echo LANG_VALUE_105; ?> *</label>
                                <textarea name="cust_address" class="form-control" cols="30" rows="10" style="height:70px;">x<?php echo $_SESSION['customer']['cust_address']; ?></textarea>
                            </div></div>
                            <div class="col-md-6 form-group" style="display:none;">
                                <label for=""><?php echo LANG_VALUE_107; ?> *</label>
                                <input type="text" class="form-control" name="cust_city" value="x<?php echo $_SESSION['customer']['cust_city']; ?>">
                            </div>
                            <div class="col-md-6 form-group" style="display:none;">
                                <label for=""><?php echo LANG_VALUE_108; ?> *</label>
                                <input type="text" class="form-control" name="cust_state" value="x<?php echo $_SESSION['customer']['cust_state']; ?>">
                            </div>
                            <div class="col-md-6 form-group" style="display:none;">
                                <label for=""><?php echo LANG_VALUE_109; ?> *</label>
                                <input type="text" class="form-control" name="cust_zip" value="x<?php echo $_SESSION['customer']['cust_zip']; ?>">
                            </div>
                            
                            
                                                    <div class="col-12">
                                                        
                                                        <div class="form-group mb--0">
                                                            <input type="submit" class="axil-btn" value="Save Changes" name="form1_updt_p">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-accountx" role="tabpanel">
                                    
<?php
if (isset($_POST['form1_updt_pass'])) {

    $valid = 1;

    if( empty($_POST['cust_password']) || empty($_POST['cust_re_password']) ) {
        $valid = 0;
        $error_message .= LANG_VALUE_138."<br>";
    }

    if( !empty($_POST['cust_password']) && !empty($_POST['cust_re_password']) ) {
        if($_POST['cust_password'] != $_POST['cust_re_password']) {
            $valid = 0;
            $error_message .= LANG_VALUE_139."<br>";
        }
    }
    
    if($valid == 1) {

        // update data into the database

        $password = strip_tags($_POST['cust_password']);
        
        $statement = $pdo->prepare("UPDATE tbl_customer SET cust_password=? WHERE cust_id=?");
        $statement->execute(array(md5($password),$_SESSION['customer']['cust_id']));
        
        $_SESSION['customer']['cust_password'] = md5($password);        

        $success_message = LANG_VALUE_141;
        header("location: ./dashboard.php");
    }
}
?>

                                    <div class="col-lg-9">
                                        <div class="axil-dashboard-account">
                                            <?php
                                if($error_message != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$error_message."</div>";
                                }
                                if($success_message != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$success_message."</div>";
                                }
                                ?>
                                            <form action="" method="post" class="account-details-form">
                                                <?php $csrf->echoInputField(); ?>
                                                <div class="row">
                                               
                                                  
                                                   
                                                    <div class="col-12">
                                                        <h6 class="text-center">
                        <?php echo LANG_VALUE_99; ?>
                    </h6>
                                                        <div class="form-group">
                                                            <label for=""><?php echo LANG_VALUE_100; ?> *</label>
                                    <input type="password" class="form-control" name="cust_password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""><?php echo LANG_VALUE_101; ?> *</label>
                                    <input type="password" class="form-control" name="cust_re_password">
                                                        </div>
                                                        
                                                        <div class="form-group mb--0">
                                                            <input type="submit" class="axil-btn" value="<?php echo LANG_VALUE_5; ?>" name="form1_updt_pass">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End My Account Area  -->

        <!-- Start Axil Newsletter Area  -->
        <!-- End Axil Newsletter Area  -->
    </main>

<script>                                
function myFunct() {
  var copyText = document.getElementById("myInput_");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the address: " + copyText.value);
}
</script>

<?php
include('templates/newsletter.php');
?>      <!-- Start Footer Area  -->
<?php
include('templates/footer.php');
?> 

<?php
include('templates/product_embed.php');
include('templates/search_embed.php');
include('templates/cart_embed.php');
?>  

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/js.cookie.js"></script>
    <!-- <script src="assets/js/vendor/jquery.style.switcher.js"></script> -->
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="assets/js/vendor/sal.js"></script>
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="assets/js/vendor/counterup.js"></script>
    <script src="assets/js/vendor/waypoints.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>