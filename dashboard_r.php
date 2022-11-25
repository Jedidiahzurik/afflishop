
<?php
include('high_header.php');
?>   

<body class="sticky-header" onload="opencart()">
    <?php echo $after_body; ?>
    
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_cart = $row['banner_cart'];
}
?>

  
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    <!-- Start Header -->
<?php
include('templates/header_shop_style.php');
?>      <!-- End Header -->

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
    <main class="main-wrapper">

        <!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
            <div class="container">
               Referral & Commission
                <!--<form action="" method="post">-->
                    <?php $csrf->echoInputField(); ?>
                <div class="axil-product-cart-wrap">
                    <div class="product-table-heading">
                        <!--<h6 class="">Your link for Affiliate marketing:</h6>-->
                    </div>
                    <div class="cart-update-btn-area">
                        <div class="input-group product-cupon" style="visibilty:hidden;">
                            
                        </div>
                        <div class="update-btn">
                            <!--<input type="submit" class="axil-btn btn-outline" value="<?php echo LANG_VALUE_20; ?>"  name="form1">-->
                        <a  id="prev_t" style="cursor:pointer;" class="axil-btn btn-outline" onclick="slide_f(-1,0)">Prev</a>

                            <a id="next_t" style="cursor:pointer;" class="axil-btn btn-outline" onclick="slide_f(1,0)">Next</a>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <div>
                            <?php
                                        $pref = base64_encode($_SESSION['customer']['cust_email']);
                                        
                                        ?>
                                        <p>Your	Referral Link: <br><input spellcheck="false" type="text" style="width:60%;" value="https://afflishop.com/?r=<?=$pref?>" id="myInput_" readonly>
				<img onclick="myFunct()" src="copy.png" style="cursor:pointer; width: 20px; height: 20px;"> click to copy</p>
				<p>For every user registered under your referral link, you get 50% profit from their registeration fee! The table below only shows referrals whose commission you are yet to withdraw.</p>
                            
                        </div>
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead>
                                  <tr>
                                    <th><small style="font-size:15px;"><?php echo '#' ?></small></th>
                                    <th><small style="font-size:15px;">Referrals</small></th>
                                    <th><small style="font-size:15px;">Vendor Commission (50%)</small></th>
                                    <th><small style="font-size:15px;">Affiliate Commission (50%)</small></th>
                                    
                                </tr>
                            </thead>
                            <tbody> <?php       $iy = 0;
                               $for_to_add = 0;
                                            $statement1 = $pdo->prepare("SELECT * FROM tbl_customer  WHERE cust_pref_email='".$_SESSION['customer']['cust_email']."' AND is_ref_paid =0");
                                            $statement1->execute();
                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) {
                                                $iy++;
                                                ?>
                                                <tr>
                                                <td data-title="#"><?php echo $iy; ?></td>
                                                <td data-title="Referrals: "><?php echo $row1['cust_name']; ?></td>
                                                <td data-title="Vendor commission (50%): "><?php if($row1['is_ven'] == 1){$for_to_add += 10; echo "$10";} else{ echo "";} ?></td> 
                                                <td data-title="Affiliate commission (50%): "><?php if($row1['is_aff'] == 1){$for_to_add +=5; echo "$5";} else{ echo "";} ?></td> 
                                                </tr>    
                                                
                                               <?php
                                            }
                                            ?>
                                                   
                                         </tbody>
                        </table>
                    </div>
                    
<script>
global_prev_next = 3;
function myFunct() {
  var copyText = document.getElementById("myInput_");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the address: " + copyText.value);
}
function slide_f(x,y){
    // -1 0 0 1
    if(global_prev_next == 0 && x == -1){
        document.getElementById("prev_t").style.visibility = "hidden";
        document.getElementById("next_t").style.visibility = "";
        return;
    } else {
                document.getElementById("prev_t").style.visibility = "";

    }
    
     if(x == -1){
         if(global_prev_next < 4){
            document.getElementById("prev_t").style.visibility = "hidden";
                document.getElementById("next_t").style.visibility = "";
            //return;
             
         }
        document.getElementById("next_t").style.visibility = "";
        bglobal_prev_next = global_prev_next;
        global_prev_next -=3;
        f_prev = document.getElementsByClassName("table_");
        for(p=0;p< f_prev.length;p++){
            f_prev[p].style.display = "none";
        }
        for(i=global_prev_next;i<bglobal_prev_next;i++){
            f_prev[i].style.display = "table-row";
        }
    }
    if(x == 1){
        global_prev_next +=3;
        bglobal_prev_next = global_prev_next;
        if(global_prev_next == 0 || x == 1){
        bglobal_prev_next == 0 ;   
        
    }
        f_prev = document.getElementsByClassName("table_");
        for(p=0;p< f_prev.length;p++){
            f_prev[p].style.display = "none";
        }
        for(i=bglobal_prev_next - 3;i<global_prev_next;i++){
            f_prev[i].style.display = "table-row";
             if(f_prev[i+1] == undefined){
                 global_prev_next -=3;
                document.getElementById("next_t").style.visibility = "hidden";
                return;
                } else {
                document.getElementById("next_t").style.visibility = "";

             }
        }
    }
}
</script>
                   
                    
                    
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
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
            </div>
        </div>
        <!--</form>-->
                
        <!-- End Cart Area  -->

 <?php
include('templates/newsletter.php');
?>          <!-- End Axil Newsletter Area  -->
    </main>


    <!-- Start Footer Area  -->
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