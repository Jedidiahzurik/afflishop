<?php require_once('high_header.php'); ?>


<body>
    <?php echo $after_body; ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_forget_password = $row['banner_forget_password'];
}
?>

<?php
if(isset($_POST['form1'])) {

    $valid = 1;
        
    if(empty($_POST['cust_email'])) {
        $valid = 0;
        $error_message .= LANG_VALUE_131."\\n";
    } else {
        if (filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $error_message .= LANG_VALUE_134."\\n";
        } else {
            $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
            $statement->execute(array($_POST['cust_email']));
            $total = $statement->rowCount();                        
            if(!$total) {
                $valid = 0;
                $error_message .= LANG_VALUE_135."\\n";
            }
        }
    }

    if($valid == 1) {

        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $forget_password_message = $row['forget_password_message'];
        }

        $token = md5(rand());
        $now = time();

        $statement = $pdo->prepare("UPDATE tbl_customer SET cust_token=?,cust_timestamp=? WHERE cust_email=?");
        $statement->execute(array($token,$now,strip_tags($_POST['cust_email'])));
        
        // $message = '<p>'.LANG_VALUE_142.'<br> <a href="https://afflishop.com/reset-password.php?email='.$_POST['cust_email'].'&token='.$token.'">Click here</a>';
         $message = '
		<html>
		
		<div style="font-family: Trebuchet MS,sans-serif; background-color: #151d24; padding: 5px; margin: 5px; border: 5px">
<p align="center">
<img src="https://afflishop.com/assets/images/logo/logo.png"  width="250" height="87"></p>
<div style="background-color: #f4f4f4; font-size: 14px; padding: 15px 25px 15px 25px; margin: 10px 10px 14px 10px; border: 5px; border: 4px solid #ddd; border-radius: 0px 25px 0px 0px">

<p style="color:; margin: 0; font-size: 14px;">Hi ' . $_POST['cust_name'] . ',</p>

<p>
'.LANG_VALUE_142.'
</p>



<p><strong><a href="https://afflishop.com/reset-password.php?email='.$_POST['cust_email'].'&token='.$token.'" rel="noreferrer" target="_blank">Click here</a></strong></p>

<p>Unable to click on the link above, copy and paste the link below to your browser:</p>

<p><strong><a href="https://afflishop.com/reset-password.php?email='.$_POST['cust_email'].'&token='.$token.'" rel="noreferrer" target="_blank">https://afflishop.com/reset-password.php?email='.$_POST['cust_email'].'&token='.$token.'</a></strong></p>


<p><font color="red"><strong>NB:</strong></font> Do not disclose your login details to anyone. Kindly contact our 24/7 customer support immediately via live chat or email if you did not authorize this or notice any suspicious login.</p>

<p>Thank you for choosing Afflishop!</p></div></div>


<div style="background-color: #151d24">
<div align="center" id="v1m_3302656928823941670rc_sig" style="padding: 4px 4px 4px 4px">

<font color="#fff"><small>

<p><strong>Afflishop &copy; 2022</strong></p>

<p><img src="https://afflishop.com/assets/images/logo/logo.png" width="16px" height="16px">  Have Questions? Email us at support@afflishop.com or contact our 24/7 Live support team on the website to connect with any of our available agents.</p>

<p><a href="https://afflishop.com" rel="noreferrer" target="_blank"><img src="https://afflishop.com/assets/images/logo/logo.png" width="60px" height="60px"></a></p>

</small></font>

<p><img src="https://afflishop.com/assets/images/logo/logo.png"  width="250" height="87"></p>

<p><small><a href="https://afflishop.com" rel="noreferrer" target="_blank"><font color="#FFF">https://afflishop.com</font></a></small></p>

</div>
</div>
		
		
		</html>
		
		';
        $to      = $_POST['cust_email'];
        $subject = LANG_VALUE_143;
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
        $success_message = $forget_password_message;
    }
}
?>
    

    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-xl-4 col-sm-6">
                    <a href="https://afflishop.com" class="site-logo"><img src="./assets/images/logo/logo.png" style="width:100px;height:100px;" alt="logo"></a>
                </div>
                <div class="col-md-2 d-lg-block d-none">
                    <a href="login.php" class="back-btn"><i class="far fa-angle-left"></i></a>
                </div>
                <div class="col-xl-6 col-lg-4 col-sm-6">
                    <div class="singin-header-btn">
                        <p>Already a member?
                        <a href="login.php" class="sign-up-btn axil-btn btn-bg-secondary">Sign In</a></p>
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
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title"><br>Forgot Password?</h3>
                        <p class="b2 mb--55">Enter the email address you used when you joined and we’ll send you instructions to reset your password.</p>
                        <form class="singin-form" action="" method="post">
                            <?php $csrf->echoInputField(); ?>
                            <div class="form-group">
                            <?php
                    if($error_message != '') {
                        echo "<script>alert('".$error_message."')</script>";
                    }
                    if($success_message != '') {
                        echo "<script>alert('".$success_message."')</script>";
                    }
                    ?>
                    </div>
                                 <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_94; ?> *</label>
                                    <input type="email" class="form-control" name="cust_email" value="youremail@example.com">
                                </div>
                                
                            
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn" name="form1">Send Reset Instructions</button>
                            </div>
                        </form>
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