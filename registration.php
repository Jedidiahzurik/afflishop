<?php require_once('high_header.php');

if(isset($_GET['user'])){
    switch($_GET['user']){
        case "vendor":
            $_SESSION['user_as'] = "vendor";
        break;
        case "affiliate":
            $_SESSION['user_as'] = "affiliate";
        break;
        case "explore":
            $_SESSION['user_as'] = "explorer";
        break;
        
    }
}
?>



<body>
    <?php echo $after_body; ?>  

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_registration = $row['banner_registration'];
}
?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    if(empty($_POST['cust_name'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_123."<br>";
    }

    if(empty($_POST['cust_email'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_131."<br>";
    } else {
        if (filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $error_message .= LANG_VALUE_134."<br>";
        } else {
            $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
            $statement->execute(array($_POST['cust_email']));
            $total = $statement->rowCount();                            
            if($total) {
                $valid = 0;
                $error_message .= LANG_VALUE_147."<br>";
            }
        }
    }

   /*
   if(empty($_POST['cust_phone'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_124."<br>";
    }

    if(empty($_POST['cust_address'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_125."<br>";
    }
    */
    if(empty($_POST['cust_country'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_126."<br>";
    }

   /*
   if(empty($_POST['cust_city'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_127."<br>";
    }

    if(empty($_POST['cust_state'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_128."<br>";
    }

    if(empty($_POST['cust_zip'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_129."<br>";
    }
    */

    if( empty($_POST['cust_password']) || empty($_POST['cust_re_password']) ) {
        $valid = 0;
        $error_message .= LANG_VALUE_138."<br>";
    }
        if(empty($_POST['cust_wallet_address'])) {
        $valid = 0;
        $error_message .= "Please enter wallet address to receive and make payment from"."<br>";
    }

    if( !empty($_POST['cust_password']) && !empty($_POST['cust_re_password']) ) {
        if($_POST['cust_password'] != $_POST['cust_re_password']) {
            $valid = 0;
            $error_message .= LANG_VALUE_139."<br>";
        }
    }
    if($_SESSION['pref'] == ""){
        $f_pref_ = "afflishop.com";
    } else {
        $f_pref_ = base64_decode($_SESSION['pref']);
    }

    if($valid == 1) {

        $token = md5(time());
        $cust_datetime = date('Y-m-d h:i:s');
        $cust_timestamp = time();

        // saving into the database
        $statement = $pdo->prepare("INSERT INTO tbl_customer (
                                        cust_name,
                                        cust_cname,
                                        cust_email,
                                        cust_phone,
                                        cust_country,
                                        cust_address,
                                        cust_city,
                                        cust_state,
                                        cust_zip,
                                        cust_b_name,
                                        cust_b_cname,
                                        cust_b_phone,
                                        cust_b_country,
                                        cust_b_address,
                                        cust_b_city,
                                        cust_b_state,
                                        cust_b_zip,
                                        cust_s_name,
                                        cust_s_cname,
                                        cust_s_phone,
                                        cust_s_country,
                                        cust_s_address,
                                        cust_s_city,
                                        cust_s_state,
                                        cust_s_zip,
                                        cust_password,
                                        cust_token,
                                        cust_datetime,
                                        cust_timestamp,
                                        cust_status,
                                        cust_pref_email,
                                        cust_wallet_address
                                        
                                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array(
                                        strip_tags($_POST['cust_name']),
                                        strip_tags($_POST['cust_cname']),
                                        strip_tags($_POST['cust_email']),
                                        strip_tags($_POST['cust_phone']),
                                        strip_tags($_POST['cust_country']),
                                        strip_tags($_POST['cust_address']),
                                        strip_tags($_POST['cust_city']),
                                        strip_tags($_POST['cust_state']),
                                        strip_tags($_POST['cust_zip']),
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        md5($_POST['cust_password']),
                                        $token,
                                        $cust_datetime,
                                        $cust_timestamp,
                                        0,
                                        strip_tags($f_pref_),
                                        strip_tags($_POST['cust_wallet_address'])
                                    ));

        // Send email for confirmation of the account
        $from = "Afflishop <no-reply@afflishop.com>" . "\r\n";
        $to = $_POST['cust_email'];
        $subject = "Email Confirmation";//LANG_VALUE_150;
        $verify_link = 'https://afflishop.com/verify.php?email='.$to.'&token='.$token.'&y='.$_SESSION['user_as'];
        $message = '
		<html>
		
		<div style="font-family: Trebuchet MS,sans-serif; background-color: #151d24; padding: 5px; margin: 5px; border: 5px">
<p align="center">
<img src="https://afflishop.com/assets/images/logo/logo.png"   width="250" height="87"></p>
<div style="background-color: #f4f4f4; font-size: 14px; padding: 15px 25px 15px 25px; margin: 10px 10px 14px 10px; border: 5px; border: 4px solid #ddd; border-radius: 0px 25px 0px 0px">

<p style="color:; margin: 0; font-size: 14px;">Hi ' . $_POST['cust_name'] . ',</p>

<p>
'.LANG_VALUE_151.'
</p>



<p><strong><a href="'.$verify_link.'" rel="noreferrer" target="_blank">Click here to verify your account</a></strong></p>

<p>Unable to click on the link above, copy and paste the link below to your browser to log in:</p>

<p><strong><a href="'.$verify_link.'" rel="noreferrer" target="_blank">'.$verify_link.'</a></strong></p>


<p><font color="red"><strong>NB:</strong></font> Do not disclose your login details to anyone. Kindly contact our 24/7 customer support immediately via live chat or email if you did not authorize this registration or notice any suspicious login.</p>

<p>Thank you for choosing Afflishop!</p></div></div>


<div style="background-color: #151d24">
<div align="center" id="v1m_3302656928823941670rc_sig" style="padding: 4px 4px 4px 4px">

<font color="#fff"><small>

<p><strong>Afflishop &copy; 2022</strong></p>

<p><img src="https://afflishop.com/assets/images/logo/logo.png" width="16px" height="16px">  Have Questions? Email us at support@afflishop.com or contact our 24/7 Live support team on the website to connect with any of our available agents.</p>

<p><a href="https://afflishop.com" rel="noreferrer" target="_blank"><img src="https://afflishop.com/assets/images/logo/logo.png" width="60px" height="60px"></a></p>

</small></font>

<p><img src="https://afflishop.com/assets/images/logo/logo.png" width="250" height="87"></p>

<p><small><a href="https://afflishop.com" rel="noreferrer" target="_blank"><font color="#FFF">https://afflishop.com</font></a></small></p>

</div>
</div>
		
		
		</html>
		
		';
	
//          $message = '
// '.LANG_VALUE_151.'<br><br>

// <a href="'.$verify_link.'">'.$verify_link.'</a>';

        	$message = wordwrap($message, 70, "\r\n");
			$headers = "From:" . $from;
			$headers .= "Return-Path: no-reply@afflishop.com" . "\r\n";
			$headers .= "BCC: system@afflishop.com" . "\r\n";
			$headers .= "Organization: afflishop" . "\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
			$returnpath = '-f no-reply@afflishop.org';
		
			if(@mail($to, $subject, $message, $headers, $returnpath)){
			    
			 }
        /*
        $returnpath = "-f support@".$_SERVER['NAME'];
        $headers = "From: noreply@" . $_SERVER['NAME'] . "\r\n" .
                   "Reply-To: noreply@" . $_SERVER['NAME'] . "\r\n" .
                   "X-Mailer: PHP/" . phpversion() . "\r\n" . 
                   "MIME-Version: 1.0\r\n" . 
                   "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        // Sending Email
        mail($to, $subject, $message, $headers,$returnpath);
        */

        unset($_POST['cust_name']);
        unset($_POST['cust_cname']);
        unset($_POST['cust_email']);
        unset($_POST['cust_phone']);
        unset($_POST['cust_address']);
        unset($_POST['cust_city']);
        unset($_POST['cust_state']);
        unset($_POST['cust_zip']);

        $success_message = LANG_VALUE_152;
    }
}
?>

  
  
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="https://afflishop.com" class="site-logo">
                        <img src="./assets/images/logo/logo.png" style="width:100px;height:100px;" alt="logo">
                        </a>
                </div>
                <div class="col-md-6">
                    <div class="singin-header-btn">
                        <p style="margin-bottom:10px;">Already a member? <a href="login.php" class="axil-btn btn-bg-secondary sign-up-btn">Sign In</a></p>
                        <br>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    <h3 class="title">Afflishop</h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap" style="overflow-y:;">
                   <div class="axil-signin-form" >
                    <div style="position:;z-index:99999;width:100%;padding:10px;background:azure;">
                         <h3 class="title"><br>I'm New Here</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        </div>
                        
                        <form class="singin-form" action="" method="post" >
                            <?php $csrf->echoInputField(); ?>
                        <div id="next1">
                            <div class="form-group">
                                <?php $csrf->echoInputField(); ?>
                            <?php
                                if($error_message != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$error_message."</div>";
                                }
                                if($success_message != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$success_message."</div>";
                                }
                                ?>
                                </div>
                            <div class=" form-group">
                                    <label for="">Username*</label>
                                    <input type="text" class="form-control" name="cust_name" value="<?php if(isset($_POST['cust_name'])){echo $_POST['cust_name'];} ?>">
                                </div>   
                            <div class=" form-group" style="display:none;">
                                    <label for=""><?php echo LANG_VALUE_103; ?></label>
                                    <input type="text" class="form-control" name="cust_cname" value="<?php if(isset($_POST['cust_cname'])){echo $_POST['cust_cname'];} ?>">
                                </div>
                                <div class=" form-group">
                                    <label for=""><?php echo LANG_VALUE_94; ?> *</label>
                                    <input type="email" class="form-control" name="cust_email" value="<?php if(isset($_POST['cust_email'])){echo $_POST['cust_email'];} ?>">
                                </div>
                                <div class=" form-group">
                                    <label for="">Enter Tron/Usdt trc20 Wallet Address *</label>
                                    <input type="text" class="form-control" name="cust_wallet_address" value="<?php if(isset($_POST['cust_wallet_address'])){echo $_POST['cust_wallet_address'];} ?>">
                                </div>
                                <div class=" form-group" style="display:none;">
                                    <label for=""><?php echo LANG_VALUE_104; ?> *</label>
                                    <input type="text" class="form-control" name="cust_phone" value="<?php if(isset($_POST['cust_phone'])){echo $_POST['cust_phone'];} ?>">
                                </div>
                                <div class="col-md-12 form-group" style="display:none;">
                                    <label for=""><?php echo LANG_VALUE_105; ?> *</label>
                                    <textarea name="cust_address" class="form-control" cols="30" rows="10" style="height:70px;"><?php if(isset($_POST['cust_address'])){echo $_POST['cust_address'];} ?></textarea>
                                </div>
                                <div class="form-group">
                                <button type="button" onclick="document.getElementById('next1').style.display ='none';document.getElementById('next2').style.display ='block'" class="axil-btn btn-bg-primary submit-btn" >Next</button>
                            </div>
                        </div>      
                        
                        <div id="next2" style="display:none;"> 
                        <br>
                                <div class=" form-group">
                                    <label for=""><?php echo LANG_VALUE_106; ?> *</label>
                                    <select name="cust_country" class="form-control select2">
                                        <option value="">Select country</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                                    foreach ($result as $row) {
                                        ?>
                                        <option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
                                        <?php
                                    }
                                    ?>    
                                    </select>                                    
                                </div>
                                
                                <div class=" form-group" style="display:none;">
                                    <label for=""><?php echo LANG_VALUE_107; ?> *</label>
                                    <input type="text" class="form-control" name="cust_city" value="<?php if(isset($_POST['cust_city'])){echo $_POST['cust_city'];} ?>">
                                </div>
                                <div class=" form-group" style="display:none;">
                                    <label for=""><?php echo LANG_VALUE_108; ?> *</label>
                                    <input type="text" class="form-control" name="cust_state" value="<?php if(isset($_POST['cust_state'])){echo $_POST['cust_state'];} ?>">
                                </div>
                                <div class=" form-group" style="display:none;">
                                    <label for=""><?php echo LANG_VALUE_109; ?> *</label>
                                    <input type="text" class="form-control" name="cust_zip" value="<?php if(isset($_POST['cust_zip'])){echo $_POST['cust_zip'];} ?>">
                                </div>
                                <div class=" form-group">
                                    <label for=""><?php echo LANG_VALUE_96; ?> *</label>
                                    <input type="password" class="form-control" id="pass_f" name="cust_password">
                                    <b style="cursor:pointer;"> <input type="radio" onclick="f_seen()" id="seen"> <i class="fas fa-hand-pointer"></i> Click to Show</b>
                                </div>
                                <script>
                            var shit = true;
                            function f_seen(){
                                if(shit == true){
                                    document.getElementById('pass_f').type = "text";
                                    shit = false;
                                } else{
                                    document.getElementById('pass_f').type = "password";
                                    shit = true;
                                }
                            }
                            </script>
                                <div class=" form-group">
                                    <label for=""><?php echo LANG_VALUE_98; ?> *</label>
                                    <input type="password" class="form-control" name="cust_re_password">
                                    
                                </div>
                                  
                            
                            <div class="form-group">
                                <button type="button" onclick="document.getElementById('next2').style.display ='none';document.getElementById('next1').style.display ='block'" class="axil-btn btn-bg-primary submit-btn" >Previous</button>
                                
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn" name="form1"><?php echo LANG_VALUE_15; ?></button>
                            </div>
</div>                            
                            
                        </form>
                        <br> <br> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

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