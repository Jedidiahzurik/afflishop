
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

<?php

if(isset($_POST['f_withdraw'])) {
    //paid_amount txnid payment_method payment_status date
    
    $paid_amount = $_POST['paid_amount'];
    $txnid = $_POST['txnid'];
    $payment_method = "Affiliate Request: ".$_POST['payment_method'];
    $payment_status = $_POST['payment_status'];
    $date = $_POST['date'];
    
 $statement = $pdo->prepare("INSERT INTO tbl_withdraw (customer_email,txnid,paid_amount,payment_method,payment_status, payment_date) VALUES (?,?,?,?,?,?)");
 $statement->execute(array($_SESSION['customer']['cust_email'], $txnid,$paid_amount,$payment_method,$payment_status,$date));        
   
 if(true) {
//$sql = "DELETE FROM chatid WHERE s_chat_id='$q'";
     
     $statement = $pdo->prepare("DELETE FROM tbl_product_aff WHERE aff_token ='".$_SESSION['customer']['cust_email']."'");
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
?>      <!-- End Header -->

    <main class="main-wrapper">

        <!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
            <div class="container">
               
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
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead>
                               <tr>
                            <th scope="col"> # </th>
                            <th scope="col" class="product-thumbnail">Image</th>
                            <th scope="col" class="product-title">Item</th>
                            <!--<th><?php echo LANG_VALUE_157; ?></th>-->
                            <!--<th><?php echo LANG_VALUE_158; ?></th>-->
                            <th scope="col" class="product-price"><?php echo LANG_VALUE_159; ?></th>
                            <th scope="col" class="product-subtotal">Percentage profit</th>
                            <th scope="col" class="product-quantity">Date</th>
                            
                        </tr>
                            </thead>
                            <tbody>

<!--p_id-->
<!--p_name-->
<!--p_old_price-->
<!--p_current_price-->
<!--p_qty-->
<!--p_featured_photo-->
<!--p_description-->
<!--p_short_description-->
<!--p_feature-->
<!--p_condition-->
<!--p_return_policy-->
<!--p_total_view-->
<!--p_is_featured-->
<!--p_is_active-->
<!--ecat_id-->
<!--aff_token-->                                
                            <?php
$error_message = '';

    $i = 0;
    $f_total_aff_earn = 0;
    $statement = $pdo->prepare("SELECT * FROM tbl_product_aff WHERE aff_token ='".$_SESSION['customer']['cust_email']."'");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
      $i++;
?>     
	
                        <tr <?php
                        echo ' class="table_" id="table_'.$i.'" ';
                        if($i  > 3){
                            echo ' style="display:none;" ';
                        } 
                        
                        ?>>
                            <td data-title="#"><?=$i?></td>
                            <td class="product-thumbnail" data-title="Item Image">
                                <a href="product.php?id=<?=$row['p_id']?>">
                                <img src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="">
                                </a>
                            </td>
                            <td class="product-title" data-title="Name"><small><?php echo $row['p_name']; ?></small></td>
                            
                            <td class="product-price" data-title="Item Price"><?php echo LANG_VALUE_1; ?><?php echo $row['p_current_price']; ?></td>
                            
                            <td class="product-subtotal" data-title="Percentage Profit">
                                <?php echo floor(($row['aff_percent'] /$row['p_current_price']) * 100); ?>%
                            </td>
                            
                            <td class="product-quantity" data-title="date">
                               
                               <?php echo $row['date']?>
                            </td>
                            
                        </tr>
                        <?php
                        $f_total_aff_earn += $row['aff_percent'] ;
                        } ?>
                        <!--<tr>-->
                        <!--    <td data-title="#">0</td>-->
                        <!--    <td class="product-thumbnail" data-title="Item Image">-->
                                
                        <!--    </td>-->
                        <!--    <td class="product-title" data-title="Name">null</td>-->
                            
                        <!--    <td class="product-price" data-title="Item Price">null</td>-->
                        <!--    <td class="product-subtotal" data-title="Percentage Profit">-->
                        <!--        null-->
                        <!--    </td>-->
                            
                        <!--    <td class="product-quantity" data-title="date">-->
                               
                        <!--       null-->
                        <!--    </td>-->
                            
                        <!--</tr>-->
                        
                        
                       
                            </tbody>
                        </table>
                    </div>
<script>
global_prev_next = 3;
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
                            <div class="axil-order-summery mt--80">
                                <h5 class="title mb--20">Summary</h5>
                                <form action="" method="post">
                                <div class="summery-table-wrap">
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                            <!--<tr class="order-subtotal">-->
                                            <!--    <td>Subtotal</td>-->
                                            <!--    <td><?php echo LANG_VALUE_1; ?><?php echo $f_total_aff_earn; ?></td>-->
                                            <!--</tr>-->
                                            
                                            <tr class="order-total">
                                                <td>Affiliate Balance</td>
                                                <td class="order-total-amount"><?php echo LANG_VALUE_1; ?><?php echo $f_total_aff_earn; ?></td>
                                            </tr>
                                            <tr>
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
                                                    <div class="input-group">
                                                        <input type="text" id="radio3" placeholder="Enter Wallet Address" name="txnid" value="<?php echo $_SESSION['customer']['cust_wallet_address']; ?>" readonly>
                                                        <label for="radio3">Address</label>
                                                    </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                                <input type="hidden" name="paid_amount" value="<?php echo $f_total_aff_earn; ?>">
                                <input type="hidden" name="payment_status" value="Pending">
                                
                                <input type="hidden" name="date" value="<?=date('Y-m-d H:i:s')?>">
                                
                                <button type="submit" name="f_withdraw" class="axil-btn btn-bg-primary checkout-btn">Withdraw</button>
                                </form>
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