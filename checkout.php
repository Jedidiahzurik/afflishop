
<?php
include('high_header.php');
?>   
<?php
$error_message = "";
function rand_f_($l)
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
if($_POST){
    if(isset($_POST['for_verify'])){
$valid = 1;        
                              $purpose = $_POST['purpose'];
                                $coin = $_POST['payment'];
                                $wallet = $_SESSION['customer']['cust_wallet_address'];
                                $email = $_SESSION['customer']['cust_email'];
                                $value  = $_POST['value'];
                                if($_SESSION['ven_set'] == $email ){
                                    //	$valid = 0;
                                      //  $error_message .= 'You cannot purchase your own product(s) !! <br>';
                                }
//dig_p
    $path_m = $_FILES['dig_p']['name'];
    $path_tmp_m = $_FILES['dig_p']['tmp_name'];

    if($path_m!='') {
        $ext_m = pathinfo( $path_m, PATHINFO_EXTENSION );
        $file_name_m = basename( $path_m, '.' . $ext_m );
        
    } else {
    	$valid = 0;
        $error_message .= 'You must Upload your transaction screenshot to continue<br>';
    }       
    
     if($valid == 1) {
         $ai_id = rand_f_(24);
         $dig_p = 'srcshot-'.$ai_id.'.'.$ext_m;
		if(isset($dig_p)){
                    move_uploaded_file( $path_tmp_m, './assets/uploads/'.$dig_p );

        }
        $f_xid = md5(time());
                                $statement = $pdo->prepare("INSERT INTO tbl_unv_pay (purpose,coin,wallet,email,amount,xid,date,scr_shots) VALUES (?,?,?,?,?,?,?,?)");
                                $statement->execute(array($purpose,$coin,$wallet,$email,$value,$f_xid,date("Y-m-d h:i:sa"), $dig_p));
                             
                                 $var_x = "ipayed(xid='".$f_xid."');";
     }
}  
    if(isset($_POST['form1_sin'])) {
        
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
            if( $row_password != md5($cust_password )) {
                $error_message .= LANG_VALUE_139.'<br>';
            } else {
                if($cust_status == 0) {
                    $error_message .= LANG_VALUE_148.'<br>';
                } else {
                    $_SESSION['customer'] = $row;
                    header("location: ".BASE_URL."checkout.php");
                }
            }
            
        }
    }
}                            
}                     
                                ?>
<body class="sticky-header"  onload="opencart();<?=$var_x?>">
    <?php echo $after_body; ?>
    
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_checkout = $row['banner_checkout'];
}
?>

<?php
if(!isset($_SESSION['cart_p_id'])) {
    header('location: cart.php');
    exit;
}
// print_r($_SESSION);
//                         die;
?>    

    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    <!-- Start Header -->
<?php
include('templates/header_shop_style.php');
?>     <!-- End Header -->
<?php
/*
if(isset($_POST['form1_sin'])) {
        
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
            if( $row_password != md5($cust_password )) {
                $error_message .= LANG_VALUE_139.'<br>';
            } else {
                if($cust_status == 0) {
                    $error_message .= LANG_VALUE_148.'<br>';
                } else {
                    $_SESSION['customer'] = $row;
                    header("location: ".BASE_URL."checkout.php");
                }
            }
            
        }
    }
}
*/
?>

    <main class="main-wrapper">

        <!-- Start Checkout Area  -->
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                   <div class="row">
                        <div class="col-lg-6">
                            <div class="axil-checkout-notice">
                                <?php if(!isset($_SESSION['customer'])): ?>
                                <div class="axil-toggle-box">
                                    <div class="toggle-bar active">
                                        <i class="fas fa-user"></i> Returning customer? 
                                        <a href="javascript:void(0)" class="toggle-btn" onclick="document.getElementById('tokopen').style.display='block';this.style.display='none'" >Click here to login <i class="fas fa-angle-down"></i></a>
                                    </div>
                                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>   
                                    <div class="axil-checkout-login toggle-open" id="tokopen">
                                        <p>If you didn't Logged in, Please Log in first.</p>
                                        <div class="signin-box">
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
                                                <label for=""><?php echo LANG_VALUE_94; ?> *</label>
                                    <input type="email" class="form-control" name="cust_email">
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo LANG_VALUE_96; ?> *</label>
                                    <input type="password" class="form-control" name="cust_password">
                                            </div>
                                            <div class="form-group mb--0">
                                                <button type="submit" class="axil-btn btn-bg-primary submit-btn" name="form1_sin">Sign In</button>
                                                <p><em>Don't have an account? <a href="registration.php">Click HERE to Sign Up</a></em></p>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <?php else: ?>
                                <div class="axil-toggle-box">
                                    <div class="toggle-bar"><i class="fas fa-pencil"></i> Have a coupon? <a href="javascript:void(0)" class="toggle-btn">Click here to enter your code <i class="fas fa-angle-down"></i></a>
                                    </div>

                                    <div class="axil-checkout-coupon toggle-open">
                                        <p>If you have a coupon code, please apply it below.</p>
                                        <div class="input-group">
                                            <input placeholder="Enter coupon code" type="text">
                                            <div class="apply-btn">
                                                <button type="submit" class="axil-btn btn-bg-primary">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="axil-checkout-billing">
                                <h4 class="title mb--40">SCAN</h4>
                                                              <h4 style="color:orange;"><?=$error_message?></h4>

                            </div>
                            <form action="" method="post" enctype="multipart/form-data"> 

                            <?php if(isset($_SESSION['customer'])): ?>
                                  <iframe src="gatepay.php" style="width:100%;height:100vh;"></iframe>
                            <?php endif; ?>      

                        </div>
                        <div class="col-lg-6">
                            <div class="axil-order-summery order-checkout-summery">
                                <h5 class="title mb--20">Your Order</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody><?php
                        $table_total_price = 0;

                        $i=0;
                        foreach($_SESSION['cart_p_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_p_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_size_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_size_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_size_name'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_size_name[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_color_id'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_color_id[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_color_name'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_color_name[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_p_qty'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_p_qty[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_p_current_price'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_p_current_price[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_p_name'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_p_name[$i] = $value;
                        }

                        $i=0;
                        foreach($_SESSION['cart_p_featured_photo'] as $key => $value) 
                        {
                            $i++;
                            $arr_cart_p_featured_photo[$i] = $value;
                        }
                        
                        ?>
                        <?php 
                        $f_purpose_name_checkout = ""  ; 
                        for($i=1;$i<=count($arr_cart_p_id);$i++): ?>
                                            <tr class="order-product">
                                                <td><?php $f_purpose_name_checkout .= $arr_cart_p_name[$i] . ". ";echo $arr_cart_p_name[$i]; ?> <span class="quantity">x<?php echo $arr_cart_p_qty[$i]; ?></span></td>
                                                <td><?php
                                $row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
                                $table_total_price = $table_total_price + $row_total_price;
                                ?>
                                <?php echo LANG_VALUE_1; ?><?php echo $row_total_price; ?>
                                
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_name" value="<?=$arr_cart_p_name[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_cprice" value="<?=$arr_cart_p_current_price[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_oprice" value="<?=$arr_cart_p_name[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_name" value="<?=$arr_cart_p_name[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_name" value="<?=$arr_cart_p_name[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_name" value="<?=$arr_cart_p_name[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_name" value="<?=$arr_cart_p_name[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_name" value="<?=$arr_cart_p_name[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_name" value="<?=$arr_cart_p_name[$i]?>">
                                <input class="hidden_cart<?=$i?>" type="hidden" name="item_name" value="<?=$arr_cart_p_name[$i]?>">
                                
                                </td>
                                            </tr>
                        <?php endfor; ?>                                            
                                            
                                            <tr class="order-subtotal">
                                                <td>Subtotal</td>
                                                <td><?php echo LANG_VALUE_1; ?><?php echo $table_total_price; ?></td>
                                            </tr>
                                            <tr class="order-shipping">
                                                <td colspan="2">
                                                    <div class="shipping-amount">
                                                        <span class="title">Buying as? </span>
                                                        <!--<span class="amount">$35.00</span>-->
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio1" name="shipping" checked>
                                                        <label for="radio1">Normal User</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio2" name="shipping">
                                                        <label for="radio2">Affliate User</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio3" name="shipping">
                                                        <label for="radio3">Vendor</label>
                                                    </div>

                                                    
                                                </td>
                                            </tr>
                                            <!--<tr class="order-subtotal">-->
                                            <!--    <td>Site charges (8%)</td>-->
                                            <!--    <td><?php echo LANG_VALUE_1; ?><?php echo $table_total_price * 0.08; ?></td>-->
                                            <!--</tr>-->
                                            <tr class="order-total">
                                                <td>Total</td>
                                                <td class="order-total-amount"><?php echo LANG_VALUE_1; ?><?php $_SESSION['t_f_check_out'] = $table_total_price; echo $_SESSION['t_f_check_out']; ?></td>
                                            </tr>
                                              <input type="hidden" name="purpose" value="Checkout: <?=$f_purpose_name_checkout?>"></input>
                                                <input type="hidden" name="value" value="<?=$_SESSION['t_f_check_out']?>"></input>

                                        </tbody>
                                    </table>

                 <hr>
				<h3 id="preper_p"></h3>
				<!--<div id="preper"></div>-->
				
                                                <div class="input-group" id="preper">
                                           <br>
                                           <!--<h5>Enter below the wallet address you made payment from.</h5>-->
                                               <p>Payment will be accepted form your registered wallet address:</p>
                                                    
                                                        <input type="text" id="myInput2" placeholder="Enter Wallet Address" value="<?=$_SESSION['customer']['cust_wallet_address']?>" name="shipping" readonly>
                                                    <br>                                           <small>To change address go to your dashboard and update details</small>
    
                                                     
                                                    
                                                    </div>
                <hr>                                                    

                                </div>
                                <div class="order-payment-method">
                                    Pay with...
                                    <div class="single-payment">
                                        <div class="input-group justify-content-between align-items-center">
                                            <input type="radio" id="radio4" name="payment" value="usdt" checked>
                                            <label for="radio4">USDT TRC20</label>
                                            <img src="./assets/images/others/payment.png" alt="USDT TRC20">
                                            
                                        </div>
                                        <p>Make your payment directly from your crypto wallet via USDT TRC20. Please ensure to pay the displayed sum in full, installments will be considered false payment. Your order will be readily available upon payment completion.</p>
                                    </div>
                                    <div class="single-payment">
                                        <div class="input-group justify-content-between align-items-center">
                                            <input type="radio" id="radio5" name="payment" value="tron">
                                            <label for="radio5">TRON (TRX)</label>
                                            <img src="./assets/images/others/payment.png" alt="TRON (TRX)">
                                            
                                        </div>
                                        <p>Make your payment directly from your crypto wallet via TRON (TRX). Please ensure to pay the displayed sum in full, installments will be considered false payment. Your order will be readily available upon payment completion.</p>
                                    </div>
                                    <!--<div class="single-payment">-->
                                    <!--    <div class="input-group justify-content-between align-items-center">-->
                                    <!--        <input type="radio" id="radio6" name="payment" value="paypal">-->
                                    <!--        <label for="radio6">Paypal</label>-->
                                    <!--        <img src="./assets/images/others/payment.png" alt="Paypal payment">-->
                                    <!--    </div>-->
                                    <!--    <p>This Payment method is currently unavailable but will be integrated soon.-->
                                        <!--Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.-->
                                    <!--    </p>-->
                                    <!--</div>-->
                                    <div class="single-payment">
                                        <div class="input-group justify-content-between align-items-center">
                                            <input type="file" name="dig_p" id="scr_shot">
                                            <label for="scr_shot">Upload Transaction Screenshot </label>
                                        </div>
                                        </div>
                                </div>
                                                    <button type="submit"  name="for_verify" class="axil-btn btn-bg-primary checkout-btn">Verify</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
        <!-- End Checkout Area  -->

    </main>



<?php
include('templates/newsletter.php');
?>      <!-- Start Footer Area  -->
<?php
include('templates/footer.php');
?>      <!-- End Footer Area  -->


<?php
include('templates/product_embed.php');
include('templates/search_embed.php');
include('templates/cart_embed.php');
?>  
    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
        
<script>
var pay_arr = [];
function izpayed(){
    cuteAlert({
  type: "success",
  title: "Entry Recieved",
  message: "This transaction is being verified, Upon success, the result will be reflected on your dashboard.",
  img: "img/success.svg",
  buttonText: "Okay",
  closeStyle: "circle"
});
}
function ipayed(xid){
   // payin = $('input[name=payment]:checked').val();
   //payin = "blah";//document.getElementById("myInput").value;
  // payfrom = document.getElementById("myInput2").value;
    // if(payfrom == ""){
    //     return alert("Invalid address detected!");
    // } else{
    $("#preper").html(`<i class="fa fa-spinner w3-spin" style="text-shadow:2px 2px 2px #000;font-size:20px;"></i><b><h3><small> Awaiting payment...</small></h3>Keep this page open, verification only take a few seconds and is done automatically upon payment.</b>`);
        
    // }
    
   //pay_arr.push(payin.trim());
   pay_arr.push(xid);

   

// var rekur_ = setTimeOut (function sendRequest(){
    
    
$.ajax({

type: "POST",
        url: "pay_mu.php",
        data: {
            pay_xid: pay_arr[0],
           // payfrom: pay_arr[1]
            
        },
success: function(data){
//json = $.parseJSON(data);
$("#preper").html(`Order submitted`);
//$("#b_prepper").html('');
//$("#preper_err").html(`${json.pay_err}`);
//if(json.status == "True"){
   // toastr["info"](json.pay_err);

  //  clearTimeout(rekur_);
//is_paid();
//redir_f();
izpayed();
//}
},
error : function(e){
//$("#preper").html(e); 
},
})
    
    
// },1000);

}
function is_paid(){
    cuteAlert({
  type: "success",
  title: "Paid",
  message: "This transaction is confirmed, Click okay to view details. You will be redirected to your user dashboard, click on `downloads tab` to access this product!",
  img: "img/success.svg",
  buttonText: "Okay",
  closeStyle: "circle"
});
}
function redir_f(){
    var ctt =11;
var rekur2_ = setInterval (function for_rd(){
    ctt--;
$("#preper_p").html(`You will be redirected in <b>${ctt}</b> seconds<hr><small>Click on \`downloads tab\` to access this product!</small>`);
if(ctt == 0){
    clearInterval(rekur2_);
    window.location.assign("./dashboard_ww.php");
}
},1000);
}
</script>
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
        <script src="cutealert/cute-alert.js?a=a"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>