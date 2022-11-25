<?php require_once('high_header.php'); 
if($_SESSION['user_as'] != "explorer"){
    if($_SESSION['user_as'] == ""){
        $log_path = "location: ".BASE_URL."dashboard.php";
    } else {
    $log_path = "location: upgrade.php?user=".$_SESSION['user_as'];
    }
} else {
    $log_path = "location: ".BASE_URL."dashboard.php";
}

/*

if($_SESSION['customer']['cust_status'] == 1){
                         header("location: https://afflishop.com/?explore=true");
                         die;
                    }

*/
?>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_login = $row['banner_login'];
}
?>

<?php
if(isset($_POST['form1'])) {
        
    if(empty($_POST['cust_email']) || empty($_POST['cust_password'])) {
        $error_message = LANG_VALUE_132.'<br>';
    } else {
        
        $cust_email = strip_tags($_POST['cust_email']);
        $cust_password = strip_tags($_POST['cust_password']);

        $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
        $statement->execute(array($cust_email));
        $total = $statement->rowCount();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row) {
            $cust_status = $row['cust_status'];
            $row_password = $row['cust_password'];
        }

        if($total==0) {
            $error_message .= LANG_VALUE_133.'<br>';
        } else {
            //using MD5 form
            if( $row_password != md5($cust_password) ) {
                $error_message .= LANG_VALUE_139.'<br>';
            } else {
                if($cust_status == 0) {
                    $error_message .= LANG_VALUE_148.'<br>';
                } else {
                    $_SESSION['customer'] = $row;
                    if($_SESSION['customer']['is_ven'] == 1 || $_SESSION['customer']['is_aff'] == 1 ){
        $log_path = "location: https://afflishop.com/?explore=true";

}

                    
                    header($log_path);
                  //  header("location: ".BASE_URL."dashboard.php");
                }
            }
            
        }
    }
}
?>






<body>
    <?php echo $after_body; ?>
    
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <a href="https://afflishop.com" class="site-logo"><img src="./assets/images/logo/logo.png"  style="width:100px;height:100px;" alt="logo"></a>
                </div>
                <div class="col-sm-8">
                    <div class="singin-header-btn">
                        <p>Not a member?
                        <a href="registration.php" class="axil-btn btn-bg-secondary sign-up-btn">Sign Up Now</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--9">
                    <h3 class="title">Afflishop</h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title"><br>Sign in to continue</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        <form class="singin-form" action="" method="post">
                            <?php $csrf->echoInputField(); ?>
                            <div class="form-group">
                            <?php
                                if($error_message != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$error_message."</div>";
                                }
                                if($success_message != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$success_message."</div>";
                                }
                                ?>
                                </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="cust_email" placeholder="youremail@example.com">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="pass_f" name="cust_password" placeholder="your password">
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
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn" name="form1">Sign In</button>
                                <a href="forget-password.php" class="forgot-btn">Forget password?</a>
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