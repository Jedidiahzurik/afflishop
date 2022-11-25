
<?php
include('high_header.php');
$_SESSION['paycount'] =0;
$error_message= "";
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
?>   

<body class="sticky-header"  onload="opencart();<?php
if($_POST){
    $valid = 1;
                                $purpose = $_POST['purpose'];
                                $coin = $_POST['payment'];
                                $wallet = $_SESSION['customer']['cust_wallet_address'];
                                $email = $_SESSION['customer']['cust_email'];
                                $value  = $_POST['value'];
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
         $dig_p = 'product-'.$ai_id.'.'.$ext_m;
		if(isset($dig_p)){
                    move_uploaded_file( $path_tmp_m, './assets/uploads/'.$dig_p );

        }
                                        
                                $statement = $pdo->prepare("INSERT INTO tbl_unv_pay (purpose,coin,wallet,email,amount,xid,date,scr_shots) VALUES (?,?,?,?,?,?,?,?)");
                                $statement->execute(array($purpose,$coin,$wallet,$email,$value,md5(time()),date("Y-m-d h:i:sa"),$dig_p));
                                 echo "izpayed()";
     }
}                     
                                ?>">
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
if(!isset($_SESSION['customer']) || !isset($_GET['user'])) {
    header('location: dashboard.php');
    exit;
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

        <!-- Start Checkout Area  -->
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            
                            

                            <div class="axil-checkout-billing">
                                <h4 class="title mb--40">SCAN</h4>
                                <h4 style="color:orange;"><?=$error_message?></h4>
                            
                           
                            </div>
                                                        <iframe src="gatepay.php" style="width:100%;height:100vh;"></iframe>

                        </div>
                        
                        
                        <div class="col-lg-6">
                            <div class="axil-order-summery order-checkout-summery">
                                <h5 class="title mb--20"> Upgrading to <?php if($_GET['user'] == "affiliate"){ echo 'Affiliate';}?>
                                <?php if($_GET['user'] == "vendor"){ echo 'Vendor';}?> Account!</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table">
                                        <thead>
                                            <!--<tr>-->
                                            <!--    <p>Confirm Account to upgrade to</p>-->
                                                
                                            <!--</tr>-->
                                        </thead>
                                        <tbody>
                                                          
                                            
                                            
                                            <tr class="order-shipping">
                                                <td colspan="2">
                                                    <div class="shipping-amount">
                                                        <!--<span class="title">Buying as? </span>-->
                                                        <!--<span class="amount">$35.00</span>-->
                                                    </div>
                                                    <!--<div class="input-group">-->
                                                    <!--    <input type="radio" id="radio1" name="shipping" checked>-->
                                                    <!--    <label for="radio1">Normal User</label>-->
                                                    <!--</div>-->
                                                    <!--<div class="input-group">
                                                        <input type="radio" id="radio2" name="shipping" <?php if($_GET['user'] == "affiliate"){ echo 'checked';}?>>
                                                        <label for="radio2">Affliate User</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio3" name="shipping" <?php if($_GET['user'] == "vendor"){ echo 'checked';}?>>
                                                        <label for="radio3">Vendor</label>
                                                    </div>-->
                                                    
                                                </td>
                                            </tr>
                                            <tr class="order-subtotal">
                                                <td>Upgrade charges</td>
                                                <td style="font-size:20px;"><?php echo LANG_VALUE_1; ?><span id="_camt"><?php if($_GET['user'] == "affiliate"){ echo 10;}?>
                                                <?php if($_GET['user'] == "vendor"){ echo 20;}?>
                                                </span></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <p>Pay the Upgrade charges and click verify to continue!</p>
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
                                    
                                    <div class="single-payment">	
                                        <div class="input-group justify-content-between align-items-center">
                                            <!--<input type="radio" id="radio6" name="payment" >-->
                                            <label for="radio6"> Select method and Verify</label>
                                        </div>
                                        
                                        
                                        
                                        <div class="input-group">
                                            <input type="radio" id="radio4" name="payment" value="usdt" checked>
                                                        <label for="radio_usdt">USDT</label>
                                                    </div>
                                        <div class="input-group">
                                            <input type="radio" id="radio5" name="payment" value="tron">
                                                        <label for="radio_tron">TRON</label>
                                                    </div>           
                                                    <input type="hidden" name="purpose" value="<?=$_GET['user']?>"></input>
                                                    <input type="hidden" name="value" value="<?php if($_GET['user'] == "affiliate"){ echo 10;}?>
                                                <?php if($_GET['user'] == "vendor"){ echo 20;}?>"></input>
                                                    
                                        <!--<p>Enter the wallet address you made payment from.-->
                                        <!--        <div class="input-group">-->
                                        <!--                <input type="text" id="f_wallet" placeholder="Enter Wallet Address" name="shipping" >-->
                                                        
                                        <!--            </div>                                         -->
                                        <!--</p>-->
                                        
                                        <div class="input-group">
                                            <input type="file" name="dig_p" id="scr_shot">
                                            <label for="scr_shot">Upload Transaction Screenshot </label>
                                        </div>
                                    </div>
                                </div>
                              <button type="submit"  class="axil-btn btn-bg-primary checkout-btn">Verify</button>

                                <!--<button type="submit" class="axil-btn btn-bg-primary checkout-btn">Verify</button>-->
                                
                                
                                
                                Pay with...
                                    <div class="single-payment">
                                        <div class="input-group justify-content-between align-items-center">
                                            <!--<input type="radio" id="radio4" name="payment" checked>-->
                                            <label for="radio4">Crypto</label>
                                            <img src="./assets/images/others/payment.png" alt="USDT TRC20">
                                            
                                        </div>
                                        <p>Make your payment directly from your crypto wallet via USDT TRC20 or TRON (TRX). Please ensure to pay the displayed sum in full, installments will be considered false payment. Your order will be readily available upon payment completion.</p>
                                    </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
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
// function ipayed(){
//     payin = $('input[name=payment]:checked').val();
//   //payin = "blah";//document.getElementById("myInput").value;
//   payfrom = document.getElementById("myInput2").value;
//   amount_c = document.getElementById("_camt").innerHTML;
//     if(payfrom == ""){
//         return alert("Invalid address detected!");
//     } else{
//     $("#preper").html(`<i class="fa fa-spinner w3-spin" style="text-shadow:2px 2px 2px #000;font-size:20px;"></i><b><h3><small> Awaiting payment...</small></h3>Keep this page open, verification only take a few seconds and is done automatically upon payment.</b>`);
        
//     }
    
//   pay_arr.push(payin.trim());
//   pay_arr.push(payfrom);
//   pay_arr.push(amount_c);

   

// var rekur_ = setTimeout (function sendRequest(){
// $.ajax({

// type: "POST",
//         url: "pay_mu_.php",
//         data: {
//             payin: pay_arr[0],
//             payfrom: pay_arr[1],
//             amount_c: pay_arr[2]
            
//         },
// success: function(data){
// //json = $.parseJSON(data);
// $("#preper").html(`Order Submitted`);
// //$("#b_prepper").html('');
// //$("#preper_err").html(`${json.pay_err}`);
// //if(json.status == "True"){
//   // toastr["info"](json.pay_err);

//     clearTimeout(rekur_);
// //is_paid();
// redir_f();
// }
// },
// error : function(e){
// $("#preper").html(e); 
// },
// })},5000);

//}
function is_paid(){
    cuteAlert({
  type: "success",
  title: "Paid",
  message: "This transaction is confirmed, Click okay to view details.",
  img: "img/success.svg",
  buttonText: "Okay",
  closeStyle: "circle"
});
}
function redir_f(){
    var ctt =11;
var rekur2_ = setInterval (function for_rd(){
    ctt--;
$("#preper_p").html(`You will be redirected in <b>${ctt}</b> seconds`);
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