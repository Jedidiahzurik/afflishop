 <header class="header axil-header header-style-5">
                                    <?php if($cur_page == "nonedashboard.php"):?>
     
     <div class="axil-header-top">
            <div class="container">

                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-dropdown">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    English
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">English</a></li>
                                    <!--<li><a class="dropdown-item" href="#">Arabic</a></li>-->
                                    <!--<li><a class="dropdown-item" href="#">Spanish</a></li>-->
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    USDT
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">USDT</a></li>
                                    <li><a class="dropdown-item" href="#">TRON</a></li>
                                    <!--<li><a class="dropdown-item" href="#">EUR</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-link">
                            <ul class="quick-link">
                                <li><a href="#">Help</a></li>
                                <?php
					if(!isset($_SESSION['customer'])) {
						?>
                                <li><a href="registration.php">Join Us</a></li>
                                <li><a href="login.php">Sign In</a></li>
                        <?php
					        }
                        ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        <?php endif;?>

        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="index.php?explore=true" class="logo logo-dark">
                            <img src="assets/images/logo/logo.png" style="width:50px;height:50px;" alt="Logo">
                        </a>
                        <a href="index.php?explore=true" class="logo logo-light">
                            <img src="assets/images/logo/logo-light.png" style="width:100px;height:100px;" alt="Site Logo">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="index.php?explore=true" class="logo">
                                    <img src="assets/images/logo/logo.png" style="width:50px;height:50px;" alt="Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li >
                                    <a href="https://afflishop.com/?explore=true">Home</a>
                                    
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Shop</a>
                                    <ul class="axil-submenu">
                                        <li><a href="wishlist.php">Wishlist</a></li>
                                        <li><a href="cart.php">Cart</a></li>
                                        <li><a href="checkout.php">Checkout</a></li>
                                        <?php
                                        if(isset($_SESSION)){
                                            ?>
                                        <!--<li><a href="dashboard_ro.php?r=o">Orders</a></li>-->
                                        <li><a href="dashboard_rd.php?r=d">Download</a></li>
                                        <?php } ?>
                                        <!--<li><a href="shops.php">Shops & Products</a></li>-->
                                        <!--<li><a href="coming-soon.php">Coming Soon</a></li>-->
                                       
                                    </ul>
                                </li>
                                <?php
                              //  if($cur_page != "dashboard.php" || $cur_page != "dashboard_w.php"
                                // || $cur_page != "dashboard_ww.php"
                                // || $cur_page != "dashboard_r.php"
                                // || $cur_page != "dashboard_a.php"
                                // || $cur_page != "dashboard_ro.php"
                                // || $cur_page != "dashboard_rd.php"
                                //){
                                switch($cur_page){
                                    case "dashboard.php":
                                    case "dashboard_w.php":
                                    case "dashboard_ww.php":
                                    case "dashboard_r.php":
                                    case "dashboard_a.php":
                                    case "dashboard_ro.php":
                                    case "dashboard_rd.php":    
                                       // print_r($_SESSION['customer']);
                                        //die;
                                        break;
                                        default:
                                    ?>
                                <li class="menu-item-has-children">
                                    <a href="#">Account</a>
                                    <ul class="axil-submenu">
                                        <?php
					if(isset($_SESSION['customer'])) {
					    if($cur_page != "dashboard.php"){
						?>
                                        <li><a href="dashboard.php">Profile</a></li>
                            <?php
					    
				}	} else {?>         
                                        <li><a href="registration.php">Sign Up</a></li>
                                        <li><a href="login.php">Sign In</a></li>
                                        <?php
					} ?>
                                        
                                        <li><a href="privacy-policy.php">Privacy Policy</a></li>
                                        
                                        
                                    </ul>
                                </li>
                                <?php if(
                                    $cur_page == "product.php"
                                    || $cur_page == "product-category.php"
                                    || $cur_page == "cart.php"
                                    || $cur_page == "checkout.php"
                                    || $cur_page == "upgrade.php"

                                ):?>
                                
                                <?php else: ?>
                                <li><a href="about-us.php">About</a></li>
                                
                                <li><a href="contact.php">Contact</a></li>
                                <?php endif;?>
                               <?php
                               //break;
                                }
                                ?>
                                <?php 
                                if($cur_page == "dashboard.php"
                                || $cur_page == "dashboard_w.php"
                                || $cur_page == "dashboard_ww.php"
                                || $cur_page == "dashboard_r.php"
                                || $cur_page == "dashboard_a.php"
                                || $cur_page == "dashboard_ro.php"
                                || $cur_page == "dashboard_rd.php"
                                ):
                                ?>
                                <li class="menu-item-has-children">
                                    <a href="#">Transactions</a>
                                    <ul class="axil-submenu">
                                <li><a href="dashboard_ww.php">Payment History</a></li>
                                <li><a href="dashboard_w.php?">Withdrawal History</a></li>
                                </ul>
                                </li>
                                
                                        <li><a href="dashboard_r.php?r=r">Referrals & Commission</a></li>

                                        <li class="menu-item-has-children">
                                    <a href="#">Dashboard</a>
                                    <ul class="axil-submenu">
                                         <?php if($_SESSION['customer']['is_aff'] == 0):?>
                               <li><a href="upgrade.php?user=affiliate">Upgrade to Affiliate</a></li>
                                            <?php else: ?>
                                          <li>  <a href="dashboard_a.php?user=affiliate">Go to Affiliate Dashboard</a></li>
                                            
                                        <?php endif; ?> 
                                        
                                     
                                         <?php if($_SESSION['customer']['is_ven'] == 0):?>
                                                          <li>  <a href="upgrade.php?user=vendor">Upgrade to Vendor</a></li>
                                            <?php else: ?>
                                           <li> <a href="./u/product.php">Go to Vendor Dashboard</a></li>
                                        </ul>
                                        </li>
                                        <?php endif; ?>
                                        <?php
                                        //}
                                        ?>
                                        <?php endif;?>
                                <?php 
                                if($cur_page == "product.php"
                                || $cur_page == "product-category.php"
                                || $cur_page == "cart.php"
                                || $cur_page == "checkout.php"
                                || $cur_page == "upgrade.php"

                                
                                ):
                                ?>
                                <li class="menu-item-has-children">
                                    <a href="#">Transactions</a>
                                    <ul class="axil-submenu">
                                <li><a href="dashboard_ww.php">Payment History</a></li>
                                <li><a href="dashboard_w.php?">Withdrawal History</a></li>
                                </ul>
                                </li>
                                

                                        <li class="menu-item-has-children">
                                    <a href="#">Dashboard</a>
                                    <ul class="axil-submenu">
                                         <?php if($_SESSION['customer']['is_aff'] == 0):?>
                               <li><a href="upgrade.php?user=affiliate">Upgrade to Affiliate</a></li>
                                            <?php else: ?>
                                          <li>  <a href="dashboard_a.php?user=affiliate">Go to Affiliate Dashboard</a></li>
                                            
                                        <?php endif; ?> 
                                        
                                     
                                         <?php if($_SESSION['customer']['is_ven'] == 0):?>
                                                          <li>  <a href="upgrade.php?user=vendor">Upgrade to Vendor</a></li>
                                            <?php else: ?>
                                           <li> <a href="./u/product.php">Go to Vendor Dashboard</a></li>
                                        </ul>
                                        </li>
                                        <?php endif; ?>
                                        <?php
                                        //}
                                        ?>
                                        <?php endif;?>        
                                        
                                                       
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                       <style>
                    .header-action .shopping-cart .cart-dropdown-btnx .cart-count {
    text-align: center;
    background-color: var(--color-primary);
    border: 2px solid var(--color-white);
    font-size: 12px;
    font-weight: 500;
    color: var(--color-white);
    border-radius: 50%;
    height: 22px;
    width: 22px;
    line-height: 19px;
    position: absolute;
    top: -12px;
    right: -12px;
}
                    
                    </style>
                    <div class="header-action">
                        <ul class="action-list">
                            <?php 
                            // if($cur_page != "dashboard.php"
                            // || $cur_page != "dashboard_w.php"
                            //     || $cur_page != "dashboard_ww.php"
                            //     || $cur_page != "dashboard_r.php"
                            //     || $cur_page != "dashboard_a.php"
                            //     || $cur_page != "dashboard_ro.php"
                            //     || $cur_page != "dashboard_rd.php"
                            // ):
                            switch($cur_page){
                                    case "dashboard.php":
                                    case "dashboard_w.php":
                                    case "dashboard_ww.php":
                                    case "dashboard_r.php":
                                    case "dashboard_a.php":
                                    case "dashboard_ro.php":
                                    case "dashboard_rd.php":    
                                       // print_r($_SESSION['customer']);
                                        //die;
                                        break;
                                        default:
                                ?>
                            <li class="axil-search d-xl-block d-none">
                                <input type="search" class="placeholder product-search-input" name="search2" id="search2" value="" maxlength="128" placeholder="What are you looking for?" autocomplete="off">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </li>
                            <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            <li class="wishlist">
                                <a href="wishlist.php">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li>
                            <li class="shopping-cart"><a href="
                            <?php
                            if(isset($_GET['id'])){
                                $_SESSION['f_get_id'] = $_GET['id'];
                                $_SESSION['f_get_type'] = $_GET['type'];
                            } 
                            if($is_product_page == true && isset($_SESSION['f_get_id']))
                            {
                                switch($stance_){
                            case "product.php":
                                $ven_prop = "";
                                if($_SESSION['customer']['is_aff'] == 1 && !$_REQUEST['ven']){
                        	    $ven_email = urlencode($_SESSION['customer']['cust_email']);
                        	    $ven_email = base64_encode($ven_email);
                        	    $ven_prop = "&ven=".$ven_email;
                        	    $_REQUEST['cart'] == "true" ? $cartt = "&cart=true" : $cartt = "";
                        	    $ven_page = "product.php?id=".$_REQUEST['id'].$ven_prop.$cartt;
                        	    header("Location: ".$ven_page );
                        	    
                        	}
                        	if($_REQUEST['ven']){
                        	    $ven_email = base64_decode($_REQUEST['ven']);
                        	    $ven_email = urldecode($ven_email);
                        	    if($ven_email == $_SESSION['customer']['cust_email']){
                        	        $_SESSION['customer']['is_from_true_vendor'] = $ven_email;
                        	    }
                        	}
                             echo $_SERVER['SCRIPT_URI']."?id=".$_SESSION['f_get_id'].$ven_prop."&cart=true";
                            break;
                            case "product-category.php":
                            echo $_SERVER['SCRIPT_URI']."?id=".$_SESSION['f_get_id']."&type=".$_SESSION['f_get_type']."&cart=true";
                            break;
                                }
                            } else{
                            echo "?cart=true";
                            }
                            ?>" class="cart-dropdown-btnx">
                            <span class="cart-count">
                            
                            <?php
					if(isset($_SESSION['cart_p_id'])) {
						$table_total_price = 0;
						$i=0;
	                    foreach($_SESSION['cart_p_qty'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_qty[$i] = $value;
	                    }                    $i=0;
	                    foreach($_SESSION['cart_p_current_price'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_current_price[$i] = $value;
	                    }
	                   // for($i=1;$i<=count($arr_cart_p_qty);$i++) {
	                   // 	$row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
	                   //     $table_total_price = $table_total_price + $row_total_price;
	                   // }
						echo count($arr_cart_p_qty); //$table_total_price;
					} else {
						echo '0';
					}
					?></span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            <?php
                            }
                            //endif;
                            ?>
                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                    <span class="title">ACCOUNTS</span>
                                    <ul>
                                        <?php
					if(isset($_SESSION['customer'])) {
						?>
						<li><i class="fa fa-user"></i> <?php echo LANG_VALUE_13; ?> <?php echo $_SESSION['customer']['cust_name']; ?></li>
					<?php if($cur_page != "dashboard.php"){?>	<li><a href="dashboard.php"><i class="fa fa-home"></i> Profile</a></li><?php } ?>
						<li>
                                            <a href="logout.php">Logout >></a>
                                        </li>
					
                                    </ul>
                                    <?php
            					} else {
            						?>
                                    <a href="login.php" class="axil-btn btn-bg-primary"> <?php echo LANG_VALUE_9; ?></a>
                                    <div class="reg-footer text-center">No account yet? <a href="registration.php" class="btn-link"> <?php echo LANG_VALUE_15; ?></a></div>
                                	<?php	
            					}
            					?>    
                                </div>
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
        <div class="header-top-campaign">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-10">
                        <div class="header-campaign-activation axil-slick-arrow arrow-both-side header-campaign-arrow">
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>BUY AND SELL SECURELY WITH AFFLISHOP!  <a href="https://afflishop.com/?explore=true">EXPLORE</a></p>
                                </div>
                            </div>
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>BECOME AN AFFILIATE MARKETER OR A VENDOR! <a href="login.php">MAKE PROFIT, MAKE SALES</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
   <?php
    // print_r($_SESSION['customer']);
    // die;
   ?>