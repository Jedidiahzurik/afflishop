    <header class="header axil-header header-style-2 header-style-6">
        <!-- Start Header Top Area  -->
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-sm-3 col-5">
                        <div class="header-brand">
                            <!--<a href="index.php?explore=true" class="logo logo-dark">-->
                            <!--    <h5 style="color">Affli<span>shop</span>-->
                            <!--    <sup><img src="assets/images/logo/logo.png" style="width:50px;height:50px;" alt="Logo"></sup>-->
                            <!--    </h5>-->
                            <!--</a>-->
                            <h2>
              <a href="./index.php?explore=true" style="color:#aaaaee;">
                  <span style="color:#aaeeff ;font-style:;">Affli</span><small>shop</small>
                <!--#00d4b1<sup><img src="assets/images/logo/logo.png" class="img-responsive" style="width:50px;height:25px;"></sup>-->
              </a></h2>
                            <a href="index.php?explore=true" class="logo logo-light">
                                <img src="assets/images/logo/logo-light.png" style="width:50px;height:50px;" alt="Site Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-9 col-7">
                        <div class="header-top-dropdown dropdown-box-style">
                            <div class="axil-search">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="far fa-search"></i>
                                </button>
                                <input type="search" class="placeholder product-search-input" name="search2" id="search2" value="" maxlength="128" placeholder="What are you looking for...." autocomplete="off">
                            </div>
                            <!--<div class="dropdown">-->
                            <!--    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">-->
                            <!--        USDT-->
                            <!--    </button>-->
                            <!--    <ul class="dropdown-menu">-->
                            <!--        <li><a class="dropdown-item" href="#">USDT</a></li>-->
                            <!--        <li><a class="dropdown-item" href="#">TRON</a></li>-->
                                    <!--<li><a class="dropdown-item" href="#">EUR</a></li>-->
                            <!--    </ul>-->
                            <!--</div>-->
                            <!--<div class="dropdown">-->
                            <!--    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">-->
                            <!--        EN-->
                            <!--    </button>-->
                            <!--    <ul class="dropdown-menu">-->
                            <!--        <li><a class="dropdown-item" href="#">EN</a></li>-->
                                    <!--<li><a class="dropdown-item" href="#">ARB</a></li>-->
                                    <!--<li><a class="dropdown-item" href="#">SPN</a></li>-->
                            <!--    </ul>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Top Area  -->

        <!-- Start Mainmenu Area  -->
        <div class="axil-mainmenu aside-category-menu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-nav-department">
                        <aside class="header-department">
                            <button class="header-department-text department-title">
                                <span class="icon"><i class="fal fa-bars"></i></span>
                                <span class="text">Categories</span>
                            </button>
                            <nav class="department-nav-menu">
                                <button class="sidebar-close"><i class="fas fa-times"></i></button>
                                <ul class="nav-menu-list">
                                    <?php
                                     function bgcolor(){return dechex(rand(0,10000000));}
							$statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
								?>
								<li>
                                        <a href="#" sh="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category" class="nav-link has-megamenu">
                                            <span class="menu-icon">
                                            <i class="fas fa-folder-open " style="font-size:25px;color:#<?php echo bgcolor();?>"></i>
                                                <!--<img src="./assets/images/product/categories/cat-01.png" alt="Department">-->
                                                </span>
                                            <span class="menu-text"><?php echo $row['tcat_name']; ?></span>
                                        </a>
                                        <div class="department-megamenu">
                                            
                                            <div class="department-megamenu-wrap">
                                                <div class="department-submenu-wrap">
                                                    
                                                
								
										<?php
										$statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
										$statement1->execute(array($row['tcat_id']));
										$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
										foreach ($result1 as $row1) {
											?>
											<div class="department-submenu">
                                                      <!--  <h3 class="submenu-heading">
                                                            <a href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category"><?php echo $row1['mcat_name']; ?></a>
                                                        </h3>-->
                                                        
												<ul>
													<?php
													$statement2 = $pdo->prepare("SELECT * FROM tbl_end_category WHERE mcat_id=?");
													$statement2->execute(array($row1['mcat_id']));
													$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
													foreach ($result2 as $row2) {
														?>
														<li><h3 class="submenu-heading">
														    <a href="product-category.php?id=<?php echo $row2['ecat_id']; ?>&type=end-category"><?php echo $row2['ecat_name']; ?></a>
														    </h3>
														    </li>
														<?php
													}
													?>
												</ul>
											</div>
											<?php
										}
										?>
									</div>
                                               <!-- <div class="featured-product">
                                                    <h3 class="featured-heading">Featured</h3>
                                                    <div class="product-list">
                                                        <div class="item-product">
                                                            <a href="#"><img src="./assets/images/product/product-feature1.png" alt="Featured Product"></a>
                                                        </div>
                                                        <div class="item-product">
                                                            <a href="#"><img src="./assets/images/product/product-feature2.png" alt="Featured Product"></a>
                                                        </div>
                                                        <div class="item-product">
                                                            <a href="#"><img src="./assets/images/product/product-feature3.png" alt="Featured Product"></a>
                                                        </div>
                                                        <div class="item-product">
                                                            <a href="#"><img src="./assets/images/product/product-feature4.png" alt="Featured Product"></a>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="axil-btn btn-bg-primary">See All Offers</a>
                                                </div>-->
                                            </div>
                                        
                                        </div>
                                    </li>
								<?php
							}
							?>
                                    

                                </ul>
                            </nav>
                        </aside>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="index.php?explore=true" class="logo">
                                    <img src="assets/images/logo/logo.png" alt="Site Logo">
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
                                
                                <li class="menu-item-has-children">
                                    <a href="#">Account</a>
                                    <ul class="axil-submenu">
                                         <?php
					if(isset($_SESSION['customer'])) {
						?>
                                        <li><a href="dashboard.php">Profile</a></li>
                            <?php
					    
					} else {?>         
                                        <li><a href="registration.php">Sign Up</a></li>
                                        <li><a href="login.php">Sign In</a></li>
                                        <?php
					} ?>
                                        <li><a href="privacy-policy.php">Privacy Policy</a></li>
                                        
                                        
                                    </ul>
                                </li>
                                <li><a href="about-us.php">About</a></li>
                                
                                <li><a href="contact.php">Contact</a></li>
                                <?php
                                if(isset($_SESSION['customer']) ){
                                    ?>
                                                                            <!--<li><a href="dashboard_r.php?r=r">Referrals & Commission</a></li>-->

                                <li class="menu-item-has-children">
                                    <a href="#">Dashboard</a>
                                 <ul class="axil-submenu">
                                         <?php if($_SESSION['customer']['is_aff'] == 0):?>
                                          <li><a href="upgrade.php?user=affiliate">Upgrade to Affiliate </a></li>
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
                                        
                                        <?php } ?>
                                        
                                
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
                            <li class="axil-search d-sm-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            <li class="wishlist">
                                <a href="wishlist.php">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li>
                            <li class="shopping-cart">
                                
                                <a href="<?php
                                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                echo $actual_link;
                                ?><?php
                                if(!isset($_GET)){
                                echo "?";
                                } else{
                                    echo "&";
                                }
                                //echo $_SERVER["SCRIPT_NAME"] //;strrpos($_SERVER["SCRIPT_NAME"],"/");
                                ?><?php
                                if(isset($_GET['cart']) && $_GET['cart'] == 'true')
                                {
                                    
                                } else {
                                    echo "cart=true";
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
	                    for($i=1;$i<=count($arr_cart_p_qty);$i++) {
	                    	$row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
	                        $table_total_price = $table_total_price + $row_total_price;
	                    }
						echo count($arr_cart_p_qty); //$table_total_price;
					} else {
						echo '0';
					}
					?></span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            
                            
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
						<li><a href="dashboard.php"><i class="fa fa-home"></i> Profile</a></li>
						
						<!--<li><a href="login.php"><i class="fa fa-sign-in"></i> </a></li>-->
						<!--<li><a href="registration.php"><i class="fa fa-user-plus"></i> </a></li>-->
					
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
        <!-- End Mainmenu Area  -->
    </header>
