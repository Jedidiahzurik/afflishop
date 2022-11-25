
<?php
include('high_header.php');
?>   

<body class="sticky-header"  onload="opencart();init_balh();<?php if($_SESSION['customer']['is_aff'] == 1){echo "init_copy()";} ?>">
    <?php echo $after_body; ?>
    
<?php
if(!isset($_REQUEST['id'])) {
    header('location: index.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if( $total == 0 ) {
        header('location: index.php');
        exit;
    }
}


if(isset($_REQUEST['ven'])) {
   $_SESSION['ven_set'] = urldecode(base64_decode($_REQUEST['ven']));
//   print_r($_SESSION['ven_set']);
//   die;
}
if(!isset($_SESSION['ven_set']) || $_SESSION['ven_set'] == ""){
    $_SESSION['ven_set'] = "SYSTEM";
}
    // print_r($_SESSION['ven_set']);
//   die;
foreach($result as $row) {
    $p_id = $row['p_id'];
    $p_name = $row['p_name'];
    $p_old_price = $row['p_old_price'];
    $p_current_price = $row['p_current_price'];
    $p_qty = $row['p_qty'];
    $p_featured_photo = $row['p_featured_photo'];
    $p_description = $row['p_description'];
    $p_short_description = $row['p_short_description'];
    $p_feature = $row['p_feature'];
    $p_condition = $row['p_condition'];
    $p_return_policy = $row['p_return_policy'];
    $p_total_view = $row['p_total_view'];
    $p_is_featured = $row['p_is_featured'];
    $p_is_active = $row['p_is_active'];
    $ecat_id = $row['ecat_id'];
    $aff_percent = $row['aff_percent'];
    $owner_token = $row['owner_token'];
    $main_product = $row['main_product'];
    
}

// Getting all categories name for breadcrumb
$statement = $pdo->prepare("SELECT
                        t1.ecat_id,
                        t1.ecat_name,
                        t1.mcat_id,

                        t2.mcat_id,
                        t2.mcat_name,
                        t2.tcat_id,

                        t3.tcat_id,
                        t3.tcat_name

                        FROM tbl_end_category t1
                        JOIN tbl_mid_category t2
                        ON t1.mcat_id = t2.mcat_id
                        JOIN tbl_top_category t3
                        ON t2.tcat_id = t3.tcat_id
                        WHERE t1.ecat_id=?");
$statement->execute(array($ecat_id));
$total = $statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $ecat_name = $row['ecat_name'];
    $mcat_id = $row['mcat_id'];
    $mcat_name = $row['mcat_name'];
    $tcat_id = $row['tcat_id'];
    $tcat_name = $row['tcat_name'];
}


$p_total_view = $p_total_view + 1;

$statement = $pdo->prepare("UPDATE tbl_product SET p_total_view=? WHERE p_id=?");
$statement->execute(array($p_total_view,$_REQUEST['id']));


$statement = $pdo->prepare("SELECT * FROM tbl_product_size WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $size[] = $row['size_id'];
}

$statement = $pdo->prepare("SELECT * FROM tbl_product_color WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $color[] = $row['color_id'];
}


if(isset($_POST['form_review'])) {
    
    $statement = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=? AND cust_id=?");
    $statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id']));
    $total = $statement->rowCount();
    
    if($total) {
        $error_message = LANG_VALUE_68; 
    } else {
        $statement = $pdo->prepare("INSERT INTO tbl_rating (p_id,cust_id,comment,rating) VALUES (?,?,?,?)");
        $statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id'],$_POST['comment'],$_POST['rating']));
        $success_message = LANG_VALUE_163;    
    }
    
}

// Getting the average rating for this product
$t_rating = 0;
$statement = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$tot_rating = $statement->rowCount();
if($tot_rating == 0) {
    $avg_rating = 0;
} else {
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
    foreach ($result as $row) {
        $t_rating = $t_rating + $row['rating'];
    }
    $avg_rating = $t_rating / $tot_rating;
}

if(isset($_POST['form_add_to_cart'])) {

	// getting the currect stock of this product
	$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$current_p_qty = $row['p_qty'];
	}
	if($_POST['p_qty'] > $current_p_qty):
		$temp_msg = 'Sorry! There are only '.$current_p_qty.' item(s) in stock';
		?>
		<script type="text/javascript">alert('<?php echo $temp_msg; ?>');</script>
		<?php
	else:
    if(isset($_SESSION['cart_p_id']))
    {
        $arr_cart_p_id = array();
        $arr_cart_size_id = array();
        $arr_cart_color_id = array();
        $arr_cart_p_qty = array();
        $arr_cart_p_current_price = array();

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
        foreach($_SESSION['cart_color_id'] as $key => $value) 
        {
            $i++;
            $arr_cart_color_id[$i] = $value;
        }
        
        $i=0;
        foreach($_SESSION['cart_p_old_price'] as $key => $value) 
        {
            $i++;
            $arr_cart_p_old_price[$i] = $value;
        }


        $added = 0;
        if(!isset($_POST['size_id'])) {
            $size_id = 0;
        } else {
            $size_id = $_POST['size_id'];
        }
        if(!isset($_POST['color_id'])) {
            $color_id = 0;
        } else {
            $color_id = $_POST['color_id'];
        }
        for($i=1;$i<=count($arr_cart_p_id);$i++) {
            if( ($arr_cart_p_id[$i]==$_REQUEST['id']) && ($arr_cart_size_id[$i]==$size_id) && ($arr_cart_color_id[$i]==$color_id) ) {
                $added = 1;
                break;
            }
        }
        if($added == 1) {
           $error_message1 = 'This product is already added to the shopping cart.';
        } else {

            $i=0;
            foreach($_SESSION['cart_p_id'] as $key => $res) 
            {
                $i++;
            }
            $new_key = $i+1;

            if(isset($_POST['size_id'])) {

                $size_id = $_POST['size_id'];

                $statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
                $statement->execute(array($size_id));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                foreach ($result as $row) {
                    $size_name = $row['size_name'];
                }
            } else {
                $size_id = 0;
                $size_name = '';
            }
            
            if(isset($_POST['color_id'])) {
                $color_id = $_POST['color_id'];
                $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
                $statement->execute(array($color_id));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                foreach ($result as $row) {
                    $color_name = $row['color_name'];
                }
            } else {
                $color_id = 0;
                $color_name = '';
            }
          

            $_SESSION['cart_p_id'][$new_key] = $_REQUEST['id'];
            $_SESSION['cart_size_id'][$new_key] = $size_id;
            $_SESSION['cart_size_name'][$new_key] = $size_name;
            $_SESSION['cart_color_id'][$new_key] = $color_id;
            $_SESSION['cart_color_name'][$new_key] = $color_name;
            $_SESSION['cart_p_qty'][$new_key] = $_POST['p_qty'];
            $_SESSION['cart_p_current_price'][$new_key] = $_POST['p_current_price'];
            $_SESSION['cart_p_name'][$new_key] = $_POST['p_name'];
            $_SESSION['cart_p_featured_photo'][$new_key] = $_POST['p_featured_photo'];
            $_SESSION['cart_p_old_price'][$new_key] = $_POST['p_old_price'];

            $_SESSION['cart_p_description'][$new_key] = $_POST['p_description'];
            $_SESSION['cart_p_short_description'][$new_key] = $_POST['p_short_description'];
            $_SESSION['cart_p_feature'][$new_key] = $_POST['p_feature'];
            $_SESSION['cart_p_condition'][$new_key] = $_POST['p_condition'];
            $_SESSION['cart_p_return_policy'][$new_key] = $_POST['p_return_policy'];
            $_SESSION['cart_p_total_view'][$new_key] = $_POST['p_total_view'];
            $_SESSION['cart_p_is_featured'][$new_key] = $_POST['p_is_featured'];
            $_SESSION['cart_p_is_active'][$new_key] = $_POST['p_is_active'];
            $_SESSION['cart_ecat_id'][$new_key] = $_POST['ecat_id'];
            $_SESSION['cart_aff_percent'][$new_key] = $_POST['aff_percent'];
            $_SESSION['cart_download_path'][$new_key] = $_SESSION['main_product_x'];
            
            
   

            $success_message1 = 'Product is added to the cart successfully!';
        }
        
    }
    else
    {

        if(isset($_POST['size_id'])) {

            $size_id = $_POST['size_id'];

            $statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
            $statement->execute(array($size_id));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                $size_name = $row['size_name'];
            }
        } else {
            $size_id = 0;
            $size_name = '';
        }
        
        if(isset($_POST['color_id'])) {
            $color_id = $_POST['color_id'];
            $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
            $statement->execute(array($color_id));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                $color_name = $row['color_name'];
            }
        } else {
            $color_id = 0;
            $color_name = '';
        }
        

        $_SESSION['cart_p_id'][1] = $_REQUEST['id'];
        $_SESSION['cart_size_id'][1] = $size_id;
        $_SESSION['cart_size_name'][1] = $size_name;
        $_SESSION['cart_color_id'][1] = $color_id;
        $_SESSION['cart_color_name'][1] = $color_name;
        $_SESSION['cart_p_qty'][1] = $_POST['p_qty'];
        $_SESSION['cart_p_current_price'][1] = $_POST['p_current_price'];
        $_SESSION['cart_p_old_price'][1] = $_POST['p_old_price'];
        $_SESSION['cart_p_name'][1] = $_POST['p_name'];
        $_SESSION['cart_p_featured_photo'][1] = $_POST['p_featured_photo'];
        
            $_SESSION['cart_p_description'][1] = $_POST['p_description'];
            $_SESSION['cart_p_short_description'][1] = $_POST['p_short_description'];
            $_SESSION['cart_p_feature'][1] = $_POST['p_feature'];
            $_SESSION['cart_p_condition'][1] = $_POST['p_condition'];
            $_SESSION['cart_p_return_policy'][1] = $_POST['p_return_policy'];
            $_SESSION['cart_p_total_view'][1] = $_POST['p_total_view'];
            $_SESSION['cart_p_is_featured'][1] = $_POST['p_is_featured'];
            $_SESSION['cart_p_is_active'][1] = $_POST['p_is_active'];
            $_SESSION['cart_ecat_id'][1] = $_POST['ecat_id'];
            $_SESSION['cart_aff_percent'][1] = $_POST['aff_percent'];
            $_SESSION['cart_download_path'][1] = $_SESSION['main_product_x'];
            

        $success_message1 = 'Product is added to the cart successfully!';
    }
	endif;
}
?>

<?php
if($error_message1 != '') {
    echo "<script>alert('".$error_message1."')</script>";
}
if($success_message1 != '') {
    echo "<script>alert('".$success_message1."')</script>";
    header('location: product.php?id='.$_REQUEST['id']);
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
<style>
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}

/* Display list items side by side */
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}

/* Add a slash symbol (/) before/behind each list item */
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "\00a0";
}

/* Add a color to all links inside the list */
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}

/* Add a color on mouse-over */
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}
</style>
<div class="breadcrumb mb_30" style="width:100%;">
                    <ul class="breadcrumb" style="width:100%;">
                        <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                        <li>></li>
                        <li><a href="<?php echo BASE_URL.'product-category.php?id='.$tcat_id.'&type=top-category' ?>"><?php echo $tcat_name; ?></a></li>
                        <li>></li>
                        <!--<li><a href="<?php echo BASE_URL.'product-category.php?id='.$mcat_id.'&type=mid-category' ?>"><?php echo $mcat_name; ?></a></li>-->
                        <!--<li>></li>-->
                        <!--<li><a href="<?php echo BASE_URL.'product-category.php?id='.$ecat_id.'&type=end-category' ?>"><?php echo $ecat_name; ?></a></li>-->
                        <!--<li>></li>-->
                        <li><?php echo $p_name; ?></li>
                    </ul>
                </div>
    <main class="main-wrapper">
        <!-- Start Shop Area  -->
<form action="" method="post">        
        <div class="axil-single-product-area bg-color-white">
            <div class="single-product-thumb axil-section-gap pb--30 pb_sm--20">
                <div class="container">
                    <div class="row row--50">
                        <div class="col-lg-6 mb--40">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-large-thumbnail-2 single-product-thumbnail axil-product slick-layout-wrapper--15 axil-slick-arrow arrow-both-side-3">
                                   
                                        <div class="thumbnail">
                                            <img src="assets/uploads/<?php echo $p_featured_photo; ?>" alt="Product Images">
                                            <?php
                                            $_SESSION['main_product_x'] = $main_product;
                                            
                                            
                                            ?>
                                        </div>
                                        <?php
                                $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                $statement->execute(array($_REQUEST['id']));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <div class="thumbnail">
                                            <img src="assets/uploads/product_photos/<?php echo $row['photo']; ?>" alt="Product Images">
                                            
                                        </div>
                                    
                                    <?php
                                }
                                ?>
                                      
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="small-thumb-wrapper product-small-thumb-2 small-thumb-style-two small-thumb-style-three">
                                        <?php
                                $i=1;
                                $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                $statement->execute(array($_REQUEST['id']));
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
                        
                        <div class="col-lg-6 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <h2 class="product-title"><?php echo $p_name; ?></h2>
                                    <div class="price-amount price-offer-amount">
                                        
                                        
                                        <span class="price current-price"> <?php echo LANG_VALUE_1; ?><?php echo $p_current_price; ?></span>
                                        <span class="price old-price"><?php if($p_old_price!=''): ?>
                                        <del><?php echo LANG_VALUE_1; ?><?php echo $p_old_price; ?></del>
                                    <?php endif; ?> </span>
                                        <span class="offer-badge"><?php if($p_old_price!=''){echo round((100 * ($p_old_price - $p_current_price)/$p_old_price), 2);}else{echo '0';}?>% OFF</span>
                                    </div>
                                    <?php if($_SESSION['customer']['is_aff'] == 1): ?>
                                    <div class="price-amount price-offer-amount">
                                        <h5>Affliate commission (<?php echo LANG_VALUE_1; ?><?=$aff_percent?>) 
                                    <span class="offer-badge"><?php if($aff_percent!='0'){echo round(($aff_percent /$p_current_price * 100),2);}else{echo '0';}?>% </span>
                                    </h5>
                                        
                                    </div>
                                    <?php endif; ?>
                                    <div class="product-rating">
                                        <div class="star-rating">
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
                                            <!--<i class="fas fa-star"></i>-->
                                            <!--<i class="fas fa-star"></i>-->
                                            <!--<i class="fas fa-star"></i>-->
                                            <!--<i class="fas fa-star"></i>-->
                                            <!--<i class="far fa-star"></i>-->
                                        </div>
                                        <div class="review-link">
                                            <a href="#">(<span><?=$tot_rating?></span> customer reviews)</a>
                                        </div>
                                    </div>
                                    <ul class="product-meta">
                                        <li><i class="fal fa-check"></i>In stock</li>
                                        <li><i class="fal fa-check"></i>Digital health is good</li>
                                        <!--<li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>-->
                                        
                                        
                                    </ul>
                                    <?php echo LANG_VALUE_55; ?>
                                    <div class="">
                                <input type="number"  class="quantity-input" step="1" min="1" max="" name="p_qty" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                                </div><br>
                                    <p class="description mb--40">
                                    <?php echo $p_short_description; ?>
                                    
                                    <input type="hidden" name="p_current_price" value="<?php echo $p_current_price; ?>">
                                    <input type="hidden" name="p_old_price" value="<?php echo $p_old_price; ?>">
                                    
                                    <input type="hidden" name="p_description" value="<?php echo base64_decode($p_description); ?>">
                                    <input type="hidden" name="p_short_description" value="<?php echo base64_decode($p_short_description); ?>">
                                    <input type="hidden" name="p_feature" value="<?php echo base64_decode($p_feature); ?>">
                                    <input type="hidden" name="p_condition" value="<?php echo base64_decode($p_condition); ?>">
                                    <input type="hidden" name="p_return_policy" value="<?php echo base64_decode($p_return_policy); ?>">
                                    
                                    <input type="hidden" name="p_total_view" value="<?php echo $p_total_view; ?>">
                                    <input type="hidden" name="p_is_featured" value="<?php echo $p_is_featured; ?>">
                                    <input type="hidden" name="p_is_active" value="<?php echo $p_is_active; ?>">
                                    <input type="hidden" name="ecat_id" value="<?php echo $ecat_id; ?>">
                                    <input type="hidden" name="aff_percent" value="<?php echo $aff_percent; ?>">
                                    
                            <input type="hidden" name="f_checkout_" value="<?php echo $owner_token; ?>">
                            <input type="hidden" name="p_name" value="<?php echo $p_name; ?>">
                            <input type="hidden" name="ecat_id_" value="<?php echo $ecat_id; ?>">
                            <input type="hidden" name="p_featured_photo" value="<?php echo $p_featured_photo; ?>">
                                    </p>

                                    <!-- Start Product Action Wrapper  -->
                                    <div class="product-action-wrapper d-flex-center">
                                        <input type="hidden" name="is_from_true_vendor" value="<?=$_SESSION['customer']['is_from_true_vendor']?>">
                                        <!-- Start Product Action  -->
                                        <ul class="product-action action-style-two d-flex-center mb--0">
                                            
                                            <li class="add-to-cart"><input type="submit" class="axil-btn btn-bg-primary" value="<?php echo LANG_VALUE_154; ?>" name="form_add_to_cart">
                                            </li>
                                            <li class="wishlist"><a href="wishlist.php" class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <!-- End Product Action  -->

                                    </div>
                                    </form>
                                    <!-- End Product Action Wrapper  -->
                                    <?php if($_SESSION['customer']['is_aff'] == 1): ?>
	<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>
                                    
                                    <div class="share">
                                        <br>
                                <?php echo LANG_VALUE_58; ?> <br>
                                <h5> As an Affiliate user you can earn as people purchase through  your shared link.</h5>
                                <div>
                                    <input type="" value="" id="f_myInput" style="width:100%;height:;">
                                    <br><br>
                                    <div class="product-hover-action">
                                    <ul class="cart-action">
                                       
                                        <li class="select-option"><a onclick="myFunct()" style="cursor:pointer;border:2px inset green;border-radius:20px;padding:10px;">
                                            <b>Copy Page Link</b></a> <b style="color:green;" id="f_copy"></b></li>
                                    </ul>
                                    <br>
                                </div>
                                    
                                </div>
								<div class="sharethis-inline-share-buttons"></div>
							</div>
							<?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- End .single-product-thumb -->
<script>
function init_copy(){
         var queryString = window.location.search;

        var urlParams = new URLSearchParams(queryString);

        var f_id = urlParams.get("id");
        var f_ven = urlParams.get("ven");
        new_url = `https://afflishop.com/product.php?id=${f_id}&ven=${f_ven}`;
        document.getElementById("f_myInput").value = new_url;
        //alert(new_url);
}
function myFunct() {
  var copyText = document.getElementById("f_myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  //alert("Copied the link: " + copyText.value);
  document.getElementById("f_copy").innerHTML =`Copied <i class="fa fa-check"></i>`;
}
</script>
            <div class="woocommerce-tabs wc-tabs-wrapper bg-vista-white">
                <div class="container">
                    <div class="product-desc-wrapper mb--30 mb_sm--10">
                        <h4 class="mb--60 desc-heading">Description</h4>
                        
                        <div class="row mb--15">
                            <div class="col-lg-6 mb--30">
                                <div class="single-desc">
                                    <h5 class="title">Specifications:</h5>
                                    <p>
                                        <?php
                                        if($p_description == '') {
                                            echo LANG_VALUE_70;
                                        } else {
                                            echo $p_description;
                                        }
                                        ?>
									</p>
                                </div>
                            </div>
                            <!-- End .col-lg-6 -->
                            <div class="col-lg-6 mb--30">
                                <div class="single-desc">
                                    <h5 class="title">Features:</h5>
                                    <p>
                                        <?php
                                        if($p_feature == '') {
                                            echo LANG_VALUE_71;
                                        } else {
                                            echo $p_feature;
                                        }
                                        ?>
                                    </p>  
                                    </div>
                            </div>
                            <!-- End .col-lg-6 -->
                        </div>
                         <div class="row mb--15">
                            <div class="col-lg-6 mb--30">
                                <div class="single-desc">
                                    <h5 class="title">Conditions:</h5>
                                     <p>
                                        <?php
                                        if($p_condition == '') {
                                            echo LANG_VALUE_72;
                                        } else {
                                            echo $p_condition;
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <!-- End .col-lg-6 -->
                            <div class="col-lg-6 mb--30">
                                <div class="single-desc">
                                    <h5 class="title">Return policy:</h5>
                                    <p>
                                        <?php
                                        if($p_return_policy == '') {
                                            echo LANG_VALUE_73;
                                        } else {
                                            echo $p_return_policy;
                                        }
                                        ?>
                                    </p> 
                                    </div>
                            </div>
                            <!-- End .col-lg-6 -->
                        </div>
                        <!-- End .row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="pro-des-features">
                                    <li class="single-features">
                                        <div class="icon">
                                            <img src="assets/images/product/product-thumb/icon-3.png" alt="icon">
                                        </div>
                                        Easy Returns
                                    </li>
                                    <li class="single-features">
                                        <div class="icon">
                                            <img src="assets/images/product/product-thumb/icon-2.png" alt="icon">
                                        </div>
                                        Quality Service
                                    </li>
                                    <li class="single-features">
                                        <div class="icon">
                                            <img src="assets/images/product/product-thumb/icon-1.png" alt="icon">
                                        </div>
                                        Original Product
                                    </li>
                                </ul>
                                <!-- End .pro-des-features -->
                            </div>
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .product-desc-wrapper -->
                    <!--<div class="additional-info pb--40 pb_sm--20">-->
                    <!--    <h4 class="mb--60">Additional Information</h4>-->
                    <!--    <div class="product-additional-info">-->
                    <!--        <div class="table-responsive">-->
                    <!--            <table>-->
                    <!--                <tbody>-->
                    <!--                    <tr>-->
                    <!--                        <th>Stand Up</th>-->
                    <!--                        <td>35″L x 24″W x 37-45″H(front to back wheel)</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Folded (w/o wheels) </th>-->
                    <!--                        <td>32.5″L x 18.5″W x 16.5″H</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Folded (w/ wheels) </th>-->
                    <!--                        <td>32.5″L x 24″W x 18.5″H</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Door Pass Through </th>-->
                    <!--                        <td>24</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Frame </th>-->
                    <!--                        <td>Aluminum</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Weight (w/o wheels) </th>-->
                    <!--                        <td>20 LBS</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Weight Capacity </th>-->
                    <!--                        <td>60 LBS</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Width</th>-->
                    <!--                        <td>24″</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Handle height (ground to handle) </th>-->
                    <!--                        <td>37-45″</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Wheels</th>-->
                    <!--                        <td>Aluminum</td>-->
                    <!--                    </tr>-->
                    <!--                    <tr>-->
                    <!--                        <th>Size</th>-->
                    <!--                        <td>S, M, X, XL</td>-->
                    <!--                    </tr>-->
                    <!--                </tbody>-->
                    <!--            </table>-->
                    <!--        </div>-->
                    <!--    </div>-->
                        <!-- End .product-additional-info -->
                    <!--</div>-->

                    <div class="reviews-wrapper">
                         <?php
                                        $statement = $pdo->prepare("SELECT * 
                                                            FROM tbl_rating t1 
                                                            JOIN tbl_customer t2 
                                                            ON t1.cust_id = t2.cust_id 
                                                            WHERE t1.p_id=?");
                                        $statement->execute(array($_REQUEST['id']));
                                        $total = $statement->rowCount();
                                        ?>
                        <h4 class="mb--60">Reviews</h4>
                        
                        <div class="row">
                            <div class="col-lg-6 mb--40">
                                <div class="axil-comment-area pro-desc-commnet-area">
                                    <h5 class="title"><?php echo $total; ?> Review for this product</h5>
                                    <ul class="comment-list">
                                        <?php
                                        if($total) {
                                            $j=0;
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                $j++;
                                                ?>
                                        <!-- Start Single Comment  -->
                                        <li class="comment">
                                            <div class="comment-body">
                                                <div class="single-comment">
                                                    <div class="comment-img">
                                                        <img src="./assets/images/blog/author-image-4.png" alt="Author Images">
                                                    </div>
                                                    <div class="comment-inner">
                                                        <h6 class="commenter">
                                                            <a class="hover-flip-item-wrapper" href="#">
                                                                <span class="hover-flip-item">
                                                                    <span data-text="Cameron Williamson"><?php echo $row['cust_name']; ?></span>
                                                                </span>
                                                            </a>
                                                            <span class="commenter-rating ratiing-four-star">
                                                                <?php
                                                                for($i=1;$i<=5;$i++) {
                                                                    ?>
                                                                    <?php if($i>$row['rating']): ?>
                                                                        <i class="fa fa-star-o"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-star"></i>
                                                                    <?php endif; ?>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <!--<a href="#"><i class="fas fa-star"></i></a>-->
                                                                <!--<a href="#"><i class="fas fa-star"></i></a>-->
                                                                <!--<a href="#"><i class="fas fa-star"></i></a>-->
                                                                <!--<a href="#"><i class="fas fa-star"></i></a>-->
                                                                <!--<a href="#"><i class="fas fa-star empty-rating"></i>-->
                                                                
                                                                </a>
                                                            </span>
                                                        </h6>
                                                        <div class="comment-text">
                                                            <p>“<?php echo $row['comment']; ?>” </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                         <?php
                                            }
                                        } else {
                                            //echo LANG_VALUE_74;
                                        }
                                        ?>
                                        
                                        <?php
                                        if($error_message != '') {
                                            echo "<script>alert('".$error_message."')</script>";
                                        }
                                        if($success_message != '') {
                                            echo "<script>alert('".$success_message."')</script>";
                                        }
                                        ?>
                                        
                                    </ul>
                                </div>
                                <!-- End .axil-commnet-area -->
                            </div>
                            <!-- End .col -->
                            <div class="col-lg-6 mb--40">
                                <!-- Start Comment Respond  -->
                                <div class="comment-respond pro-des-commend-respond mt--0">
                                    <?php if(isset($_SESSION['customer'])): ?>

                                            <?php
                                            $statement = $pdo->prepare("SELECT * 
                                                                FROM tbl_rating
                                                                WHERE p_id=? AND cust_id=?");
                                            $statement->execute(array($_REQUEST['id'],$_SESSION['customer']['cust_id']));
                                            $total = $statement->rowCount();
                                            ?>
                                            <?php if($total == 0){?>
                                    <h5 class="title mb--30">Add a Review</h5>
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                    
                                      <?php } ?>
                                    <div class="rating-wrapper d-flex-center mb--40">
                                        Your Rating <span class="require">*</span>    
                                            <?php if($total==0): ?>
                                            <form action="" method="post">
                                            <div class="reating-inner ml--20">
                                                <input type="radio" style="" name="rating" class="rating" value="1" checked>
                                                <input type="radio" style="" name="rating" class="rating" value="2" checked>
                                                <input type="radio" style="" name="rating" class="rating" value="3" checked>
                                                <input type="radio" style="" name="rating" class="rating" value="4" checked>
                                                <input type="radio" style="" name="rating" class="rating" value="5" checked>
                                            </div>
                                            
                                        
                                    </div>

                                    <!--form-->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Other Notes (optional)</label>
                                                    <textarea name="comment" placeholder="Your Comment"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-submit">
                                                    <button type="submit" id="submit" name="form_review" class="axil-btn btn-bg-primary w-auto">Send Message</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php else: ?>
                                                <span style="color:red;">&nbsp;&nbsp;&nbsp;<?php echo LANG_VALUE_68; ?></span>
                                            <?php endif; ?>


                                        <?php else: ?>
                                            <p class="error">
												<?php echo LANG_VALUE_69; ?> <br>
												<a href="login.php" style="color:red;text-decoration: underline;"><?php echo LANG_VALUE_9; ?></a>
											</p>
                                        <?php endif; ?>  
                                </div>
                                <!-- End Comment Respond  -->
                            </div>
                            <!-- End .col -->
                        </div>
                    </div>
                    <!-- End .reviews-wrapper -->
                </div>
            </div>
            <!-- woocommerce-tabs -->

        </div>
        <!-- End Shop Area  -->

        <!-- Start Recently Viewed Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> <?php echo LANG_VALUE_155; ?></span>
                    <h2 class="title"><?php echo 'View related Items'; ?></h2>
                    
                </div>
                <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">

                <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_id!=?");
                    $statement->execute(array($ecat_id,$_REQUEST['id']));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        ?>
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                    <img src="assets/uploads/<?php echo $row['p_featured_photo']; ?>" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget"><?php if($row['p_old_price']!=''){echo round((100 * ($row['p_old_price'] - $row['p_current_price'])/$row['p_old_price']), 2);}else{echo '0';}?>% OFF</div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a></li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="#" data-bs-toggle="modal" data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price"><?php if($row['p_old_price'] != ''): ?>
                                    
                                        <?php echo LANG_VALUE_1; ?><?php echo $row['p_old_price']; ?>
                                    
                                    <?php endif; ?></span>
                                        <span class="price current-price"><?php echo LANG_VALUE_1; ?><?php echo $row['p_current_price']; ?> </span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
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
                                            <!--<li class="color-extra-01 active"><span><span class="color"></span></span>-->
                                            <!--</li>-->
                                            <!--<li class="color-extra-02"><span><span class="color"></span></span>-->
                                            <!--</li>-->
                                            <!--<li class="color-extra-03"><span><span class="color"></span></span>-->
                                            <!--</li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- End .slick-single-layout -->
                    
                
                 <?php
                    }
                    ?>
                    </div>
            </div>
        </div>
        <!-- End Recently Viewed Product Area  -->
        <!-- Start Axil Newsletter Area  -->
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
    <script src="assets/js/vendor/slick.min.js?a=ajh"></script>
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
    <script>
    function init_balh(){
      balh =  document.getElementsByClassName("slick-arrow");
      for(i=0;i<balh.length;i++){
      balh[i].type="button";
      }
    }
    </script>

</body>

</html>