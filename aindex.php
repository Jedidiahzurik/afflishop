
<?php
include('high_header.php');
?>   
<body onload="opencart();openproduct();">
    <?php echo $after_body; ?>

<?php
$ictt =0;
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $featured_product_title = $row['featured_product_title'];
    $featured_product_subtitle = $row['featured_product_subtitle'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $total_featured_product_home = $row['total_featured_product_home'];
    $total_latest_product_home = $row['total_latest_product_home'];
    $total_popular_product_home = $row['total_popular_product_home'];
    $home_service_on_off = $row['home_service_on_off'];
    $home_welcome_on_off = $row['home_welcome_on_off'];
    $home_featured_product_on_off = $row['home_featured_product_on_off'];
    $home_latest_product_on_off = $row['home_latest_product_on_off'];
    $home_popular_product_on_off = $row['home_popular_product_on_off'];

}


?>    
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
    <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>
    <!-- Start Header -->
<?php
include('templates/header.php');
?>
    <main class="main-wrapper">

        <!-- Start Slider Area -->
        <div class="axil-main-slider-area main-slider-style-2 main-slider-style-8">
            <div class="container">
                <div class="slider-offset-left">
                    <div class="row row--20">
                        <div class="col-lg-9">
                            <div class="slider-box-wrap">
                                <div class="slider-activation-one axil-slick-dots">
                                    <?php
        $i=0;
        $statement = $pdo->prepare("SELECT * FROM tbl_slider");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {            
            ?>
                                    <div class="single-slide slick-slide">
                                        <div class="main-slider-content">
                                            <span class="subtitle"><i class="fal fa-badge-percent"></i> <?php echo nl2br($row['content']); ?></span>
                                            <h1 class="title"><?php echo $row['heading']; ?></h1>
                                            <div class="shop-btn">
                                                <a href="<?php echo $row['button_url']; ?>" class="axil-btn">Shop Now <i class="fal fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="main-slider-thumb">
                                            <img src="assets/uploads/<?php echo $row['photo']; ?>" alt="Product">
                                        </div>
                                    </div>
<?php
            $i++;
        }
        ?>                                    
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="slider-product-box">
                                <div class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="assets/images/product/product-41.png" alt="Product">
                                    </a>
                                </div>
                                <h6 class="title"><a href="single-product.html">Stylish Leather Bag</a></h6>
                                <span class="price">$29.99</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Slider Area -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view-modal" id="self_p"></a>

<?php if($home_featured_product_on_off == 1): ?>

        <!-- Start Flash Sale Area  -->
        <div class="axil-new-arrivals-product-area fullwidth-container flash-sale-area bg-color-white axil-section-gap pb--0">
            <div class="container ml--xxl-0">
                <div class="product-area pb--50">
                    <div class="d-md-flex align-items-end flash-sale-section">
                        <div class="section-title-wrapper">
                            <span class="title-highlighter highlighter-primary"><i class="fas fa-fire"></i> Today's</span>
                            <h2 class="title">Flash Sales</h2>
                        </div>
                        <div class="sale-countdown countdown"></div>
                    </div>
                    <div class="new-arrivals-product-activation slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">
 <?php              
                    
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? LIMIT ".$total_featured_product_home);
                    $statement->execute(array(1,1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        $ictt++;
                        ?>                        
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-four">
                                <div class="thumbnail">
                                    <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                        <img data-sal="zoom-out" data-sal-delay="100" data-sal-duration="1500" src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="Product Images">
                                    </a>
                                    <div class="label-block label-right">
                                        <div class="product-badget"><?php if($row['p_old_price']!=''){echo round(($row['p_old_price']/$row['p_current_price']), 2);}else{echo '0';}?>% OFF</div>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="wishlist"><a href="wishlist.php"><i class="far fa-heart"></i></a></li>
                                            <li class="select-option"><a href="product.php?id=<?php echo $row['p_id']; ?>">Add to Cart</a></li>
                                            <li class="quickview"><a href="#" onclick="document.getElementById('ijnk<?=$ictt?>').click()"><i class="far fa-eye"></i></a></li>
                                            
                                        <a id="ijnk<?=$ictt?>" href="?sdesc=<?php
 $vp_sdesc_ = urlencode($row['p_short_description']);
$vp_sdesc_ = base64_encode($vp_sdesc_);
echo $vp_sdesc_;

?>&pid=<?php echo $row['p_id']; ?>&cr=<?=$tot_rating?>&qnt=<?=$row['p_qty']?>&avgr=<?=$avg_rating?>&item=<?php echo $row['p_name']; ?>&op=<?=$row['p_old_price']?>&cp=<?=$row['p_current_price']?>&img=<?=$row['p_featured_photo']?>" >
<!--<i class="far fa-eye"></i>
&sdesc=<?=$row['p_short_description']?>
-->
</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h5>
                                        <div class="product-price-variant">
                                            <span class="price old-price"><?php if($row['p_old_price'] != ''): ?>
                                    
                                        $<?php echo $row['p_old_price']; ?>
                                    
                                    <?php endif; ?>
                                    </span>
                                            <span class="price current-price">$<?php echo $row['p_current_price']; ?></span>
                                        </div>
                                        <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <?php
                    }
                    ?>
<?php endif; ?>
                    
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Flash Sale Area  -->

        <!-- Start Categorie Area  -->
        <div class="axil-categorie-area bg-color-white axil-section-gapcommon">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-secondary"> <i class="far fa-tags"></i> Categories</span>
                    <h2 class="title">Browse by Category</h2>
                </div>
                <div class="categrie-product-activation slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">
                    <?php
                           

							$statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
							    
								?>
                    
                    <div class="slick-single-layout">
                        <div class="categrie-product" data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500">
                            <a href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category">
                                <i class="fas fa-folder-open img-fluid" style="font-size:50px;color:#<?php echo bgcolor();?>"></i>
                                <!--<img class="img-fluid" src="./assets/images/product/categories/elec-4.png" alt="product categorie">-->
                                <h6 class="cat-title"><?php echo $row['tcat_name']; ?></h6>
                            </a>
                        </div>
                        <!-- End .categrie-product -->
                    </div>
                    <?php } ?>
                    <!-- End .slick-single-layout -->
                    
                    
                </div>
            </div>
        </div>
        <!-- End Categorie Area  -->

        <!-- Start Best Sellers Product Area  -->
<?php if($home_popular_product_on_off == 1): ?>
        
        <div class="axil-best-seller-product-area bg-color-white axil-section-gap pt--0">
            <div class="container">
                <div class="product-area pb--50">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"> <i class="far fa-shopping-basket"></i>This Month</span>
                        <h2 class="title">Best Selling Products</h2>
                    </div>
                    <div class="new-arrivals-product-activation-2 slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile">
                        <?php
                        
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_total_view DESC LIMIT ".$total_popular_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        $ictt++;
                        ?>
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-three">
                                <div class="thumbnail">
                                    <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                        <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="Product Images">
                                    </a>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="wishlist"><a href="wishlist.php"><i class="far fa-heart"></i></a></li>
                                            <li class="select-option"><a href="product.php?id=<?php echo $row['p_id']; ?>">Add to Cart</a></li>
                                            <li class="quickview"><a href="#" onclick="document.getElementById('ijnk<?=$ictt?>').click()"><i class="far fa-eye"></i></a></li>
                                            <a id="ijnk<?=$ictt?>" href="?sdesc=<?php
 $vp_sdesc_ = urlencode($row['p_short_description']);
$vp_sdesc_ = base64_encode($vp_sdesc_);
echo $vp_sdesc_;

?>&pid=<?php echo $row['p_id']; ?>&cr=<?=$tot_rating?>&qnt=<?=$row['p_qty']?>&avgr=<?=$avg_rating?>&item=<?php echo $row['p_name']; ?>&op=<?=$row['p_old_price']?>&cp=<?=$row['p_current_price']?>&img=<?=$row['p_featured_photo']?>" >
<!--<i class="far fa-eye"></i>
&sdesc=<?=$row['p_short_description']?>
-->
</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <span class="icon">
                                            <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
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
                                            
                                        
                                    </span>
                                            <span class="rating-number">(<?=$tot_rating?>)</span>
                                        </div>
                                        <h5 class="title"><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$<?php echo $row['p_current_price']; ?> </span>
                                            <span class="price old-price">
                                                
                                    <?php if($row['p_old_price'] != ''): ?>
                                    
                                        $<?php echo $row['p_old_price']; ?>
                                    
                                    <?php endif; ?>
                                            </span>
                                        </div>
                                        <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                        
                       
                        
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>
        
        <!-- End  Best Sellers Product Area  -->

        <!-- Poster Countdown Area  -->
        <!--<div class="axil-poster-countdown">-->
        <!--    <div class="container">-->
        <!--        <div class="poster-countdown-wrap bg-lighter">-->
        <!--            <div class="row">-->
        <!--                <div class="col-xl-5 col-lg-6">-->
        <!--                    <div class="poster-countdown-content">-->
        <!--                        <div class="section-title-wrapper">-->
        <!--                            <span class="title-highlighter highlighter-secondary"> <i class="fal fa-headphones-alt"></i> Don’t Miss!!</span>-->
        <!--                            <h2 class="title">Enhance Your Music Experience</h2>-->
        <!--                        </div>-->
        <!--                        <div class="poster-countdown countdown mb--40"></div>-->
        <!--                        <a href="#" class="axil-btn btn-bg-primary">Check it Out!</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="col-xl-7 col-lg-6">-->
        <!--                    <div class="poster-countdown-thumbnail">-->
        <!--                        <img src="./assets/images/product/poster/poster-03.png" alt="Poster Product">-->
        <!--                        <div class="music-singnal">-->
        <!--                            <div class="item-circle circle-1"></div>-->
        <!--                            <div class="item-circle circle-2"></div>-->
        <!--                            <div class="item-circle circle-3"></div>-->
        <!--                            <div class="item-circle circle-4"></div>-->
        <!--                            <div class="item-circle circle-5"></div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- End Poster Countdown Area  -->

        <!-- Start Expolre Product Area  -->

        <div class="axil-product-area bg-color-white axil-section-gap">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"> <i class="fal fa-store"></i> Our Products</span>
                    <h2 class="title">Explore our Products</h2>
                </div>
                <div class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                   
                   
                    <div class="slick-single-layout" id="explore">
                        <div class="row row--15">
                            
                            <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY  RAND() LIMIT 8 ");
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        $ictt++;
                        ?>
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                                <div class="axil-product product-style-one">
                                    <div class="thumbnail">
                                        <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                            <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" class="main-img" src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="Product Images">
                                            <img class="hover-img" src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="Product Images">
                                        </a>
                                        <div class="label-block label-right">
                                            <div class="product-badget"><?php if($row['p_old_price']!=''){echo round(($row['p_old_price']/$row['p_current_price']), 2);}else{echo '0';}?>% Off</div>
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="quickview">
                                                    
                                                    <a href="#" onclick="document.getElementById('ijnk<?=$ictt?>').click()"><i class="far fa-eye"></i></a></li>
                                            <a id="ijnk<?=$ictt?>" href="?sdesc=<?php
 $vp_sdesc_ = urlencode($row['p_short_description']);
$vp_sdesc_ = base64_encode($vp_sdesc_);
echo $vp_sdesc_;

?>&pid=<?php echo $row['p_id']; ?>&cr=<?=$tot_rating?>&qnt=<?=$row['p_qty']?>&avgr=<?=$avg_rating?>&item=<?php echo $row['p_name']; ?>&op=<?=$row['p_old_price']?>&cp=<?=$row['p_current_price']?>&img=<?=$row['p_featured_photo']?>" >
<!--<i class="far fa-eye"></i>
&sdesc=<?=$row['p_short_description']?>
-->
</a>
                                                <li class="select-option">
                                                    <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                        Add to Cart
                                                    </a>
                                                </li>
                                                <li class="wishlist"><a href="wishlist.php"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <div class="product-rating">
                                            <span class="icon">
                                            <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
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
                                            
                                        
                                    </span>
                                            <span class="rating-number">(<?=$tot_rating?>)</span>
                                        </div>
                                             <h5 class="title"><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">$<?php echo $row['p_current_price']; ?> </span>
                                            <span class="price old-price">
                                                
                                    <?php if($row['p_old_price'] != ''): ?>
                                    
                                        $<?php echo $row['p_old_price']; ?>
                                    
                                    <?php endif; ?>
                                            </span>
                                        </div>
                                        <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                         <!---->
                         
                         <!---->
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <!-- End .slick-single-layout -->
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center mt--20 mt_sm--0">
                        <a href="?#explore" class="axil-btn btn-bg-lighter btn-load-more">View More Products</a>
                    </div>
                </div>

            </div>
        </div>

        <!-- End Expolre Product Area  -->

        <!-- Start Testimonila Area  -->
        <!-- End Testimonila Area  -->

        <!-- Start New Arrivals Product Area  -->
        <?php if($home_latest_product_on_off == 1): ?>

        <div class="axil-new-arrivals-product-area bg-color-white axil-section-gap pb--50">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Latest</span>
                    <h2 class="title">New Arrivals</h2>
                </div>
                <div class="new-arrivals-product-activation slick-layout-wrapper--30 axil-slick-arrow  arrow-top-slide">
                    <?php
                    
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT ".$total_latest_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        $ictt++;
                        ?>
                    <div class="slick-single-layout">
                        <div class="axil-product product-style-two has-color-pick">
                            <div class="thumbnail">
                                <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                    <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget"><?php if($row['p_old_price']!=''){echo round(($row['p_old_price']/$row['p_current_price']), 2);}else{echo '0';}?>% OFF</div>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <div class="color-variant-wrapper">
                                        <!--<ul class="color-variant">-->
                                        <!--    <li class="color-extra-01 active"><span><span class="color"></span></span>-->
                                        <!--    </li>-->
                                        <!--    <li class="color-extra-02"><span><span class="color"></span></span>-->
                                        <!--    </li>-->
                                        <!--    <li class="color-extra-03"><span><span class="color"></span></span>-->
                                        <!--    </li>-->
                                        <!--</ul>-->
                                    </div>
                                    <h5 class="title"><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">
                                            
                                    <?php if($row['p_old_price'] != ''): ?>
                                    
                                        $<?php echo $row['p_old_price']; ?>
                                   
                                    <?php endif; ?>
                                            
                                        </span>
                                        <span class="price current-price">$<?php echo $row['p_current_price']; ?> </span>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action justify-content-center">
                                        <li class="wishlist"><a href="wishlist.php"><i class="far fa-heart"></i></a></li>
                                        <li class="select-option"><a href="product.php?id=<?php echo $row['p_id']; ?>">Add to Cart</a></li>
                                        <li class="quickview">
                                            <a href="#" onclick="document.getElementById('ijnk<?=$ictt?>').click()"><i class="far fa-eye"></i></a></li>
                                            <a id="ijnk<?=$ictt?>" href="?sdesc=<?php
 $vp_sdesc_ = urlencode($row['p_short_description']);
$vp_sdesc_ = base64_encode($vp_sdesc_);
echo $vp_sdesc_;

?>&pid=<?php echo $row['p_id']; ?>&cr=<?=$tot_rating?>&qnt=<?=$row['p_qty']?>&avgr=<?=$avg_rating?>&item=<?php echo $row['p_name']; ?>&op=<?=$row['p_old_price']?>&cp=<?=$row['p_current_price']?>&img=<?=$row['p_featured_photo']?>" >
<!--<i class="far fa-eye"></i>
&sdesc=<?=$row['p_short_description']?>
-->
</a>
                                            
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                     <?php
                    }
                    ?>
                    <!-- End .slick-single-layout -->
                    
                    <!-- End .slick-single-layout -->
                </div>
            </div>
        </div>
<?php endif; ?>
        
        <!-- End New Arrivals Product Area  -->

        <!-- Start Axil Newsletter Area  -->
        <?php
include('templates/newsletter.php');
?>  
        <!-- End Axil Newsletter Area  -->

    </main>


    
    <!-- Start Footer Area  -->
    
<?php
include('templates/footer.php');
?>    
    <!-- End Footer Area  -->

   
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