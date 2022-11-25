 <!-- Product Quick View Modal Start -->
 <?php
 //$_SERVER['SCRIPT_URI']."?id=".$_SESSION['f_get_id']."&cart=true";
 //product-category.php?id=&type=mid-category&item=&op=$row['p_old_price']&cp=$row['p_current_price']&img=$row['p_featured_photo']
 // print_r($_GET);
    //die;
 if($_GET['item']){
    
 $vp_id = $_GET['pid'];
 $vp_item = $_GET['item'];
 $vp_op = $_GET['op'];
 $vp_cp = $_GET['cp'];
 $vp_img = $_GET['img'];
 $vp_sdesc = base64_decode($_GET['sdesc']);
 $vp_sdesc = urldecode($vp_sdesc);
 $vp_avgr = $_GET['avgr'];
 $vp_qnt = $_GET['qnt'];
 $vp_cr = $_GET['cr'];
 ?>

    <div class="modal fade quick-view-product " id="quick-view-modal" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="single-product-thumb">
                        <div class="row">
                            <div class="col-lg-7 mb--40">
                                <div class="row">
                                    <div class="col-lg-10 order-lg-2">
                                        <div class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                           <?php
                                $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                $statement->execute(array($vp_id));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                   
                                    
                                            <div class="thumbnail">
                                                <img src="assets/uploads/product_photos/<?=$row['photo']?>" alt="Product Images">
                                                <div class="label-block label-right">
                                                    <div class="product-badget"><?php if($vp_op!=''){echo round(($vp_op/$vp_cp), 2);}else{echo '0';}?>% OFF</div>
                                                </div>
                                                <div class="product-quick-view position-view">
                                                    <a href="assets/uploads/product_photos/<?=$row['photo']?>" class="popup-zoom">
                                                        <i class="far fa-search-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                    <?php
                                   
                                }
                                ?>        
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 order-lg-1">
                                        <div class="product-small-thumb small-thumb-wrapper">
                                            <?php
                                $i=1;
                                $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                $statement->execute(array($vp_id));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <div class="small-thumb-img ">
                                            <img src="assets/uploads/product_photos/<?php echo $row['photo']; ?>" alt="samll-thumb">
                                        </div>
                                    <?php
                                    $i++;
                                }
                                ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mb--40">
                                <div class="single-product-content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <div class="star-rating">
                                                
                                                   
                                                    <?php
                                                    $avg_rating = $vp_avgr;
                                                    if($avg_rating == 0) {
                                                        echo '';
                                                    }
                                                    elseif($avg_rating == 1.5) {
                                                        echo '
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        ';
                                                    } 
                                                    elseif($avg_rating == 2.5) {
                                                        echo '
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        ';
                                                    }
                                                    elseif($avg_rating == 3.5) {
                                                        echo '
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        ';
                                                    }
                                                    elseif($avg_rating == 4.5) {
                                                        echo '
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        ';
                                                    }
                                                    else {
                                                        for($i=1;$i<=5;$i++) {
                                                            ?>
                                                            <?php if($i>$avg_rating): ?>
                                                                <i class="fa fa-star-o"></i>
                                                            <?php else: ?>
                                                                <i class="fa fa-star"></i>
                                                            <?php endif; ?>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                
                                                <!--<img src="assets/images/icons/rate.png" alt="Rate Images">-->
                                            </div>
                                            <div class="review-link">
                                                <?php if($vp_avgr != "" ):?>
                                                <a href="#">(<span><?=$vp_cr?></span> customer reviews)</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <h3 class="product-title"><?=$vp_item?></h3>
                                        <span class="price-amount"><?php echo LANG_VALUE_1; ?><?php echo $vp_cp; ?></span>
                                        <ul class="product-meta">
                                            <li><i class="fal fa-check"></i>In stock</li>
                                            <li><i class="fal fa-check"></i>File Health is Good</li>
                                            <!--<li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>-->
                                        </ul>
                                        <p class="description"><?=$vp_sdesc?></p>


                                        <!-- Start Product Action Wrapper  -->
                                        <div class="product-action-wrapper d-flex-center">
                                            <!-- Start Quentity Action  -->
                                            <div class="pro-qty"><input type="text" value="<?=$vp_qnt?>" readonly></div>
                                            <!-- End Quentity Action  -->

                                            <!-- Start Product Action  -->
                                            <ul class="product-action d-flex-center mb--0">
                                                <li class="add-to-cart"><a href="product.php?id=<?php echo $vp_id; ?>" class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                                <li class="wishlist"><a href="wishlist.php" class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                            <!-- End Product Action  -->

                                        </div>
                                        <!-- End Product Action Wrapper  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Quick View Modal End -->
    
    <?php } else{ ?>

<?php if($cur_page == 'xindex.php' && !isset($_GET['explore'])):?>        

    <div class="modal fade quick-view-product " id="quick-view-modal" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <h3 style="text-align:center;padding-top:15px;margin-bottom:-30px;color:blue;">WELCOME TO AFFLISHOP!</h3>
                
                <div class="modal-header">
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>-->
                </div>
                <div class="modal-body">
                    <div class="single-product-thumb">
                        <div class="row">
                            <div class="col-lg-7 mb--40">
                                 <div class="row">
                                    <div class="col-lg-10 order-lg-2">
                                        <div class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                          
                                    
                                            <div class="thumbnail">
                                                <img src="https://afflishop.com/assets/images/logo/logo.png" alt="Product Images">
                                                
                                                
                                            </div>
                                    
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                               
                            </div>
                             
                            <div class="col-lg-5 mb--40">
                                <div class="single-product-content">
                                    <div class="inner" style="color:blue;">
                                        
                                       
                                        <!--<h5 class="title">Here we help creators of digital products get more sales and connect with more customers and network of high performing affiliates.</h5>-->



                                        <h5>How would you like to continue?</h5>
                                        <div>
                                            <center>
                                        <p><a href="registration.php?user=vendor" class="axil-btn btn-bg-primary">Continue as a <b>Vendor</b></a></p>
                                        <p><a href="registration.php?user=affiliate" class="axil-btn btn-bg-primary">Continue as an <b>Affiliate</b></a></p>
                                        
                                        <!--<em><b>OR</b></em><br>-->
                                        <!--<em>Wanna take a look around?</em><br>-->
                                        <p><a href="?explore=true" class="axil-btn btn-bg-primary"> <b>Click here to Explore</b></a></p>
                                        </center>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>        

<?php } ?>
    
    <script>
    function openproduct(){
     try{  
    x= document.getElementById("self_p");
   
    x.click();
     }
     catch(e){}
    
    }
    </script>
    <?php
                            
                                $_SESSION['f_get_id'] = "";
                                $_SESSION['f_get_type'] ="";
                             
                            ?>
   