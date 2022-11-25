<?php require_once('high_header.php'); ?>

<?php
if(isset($_REQUEST['r_all']) && $_REQUEST['r_all'] == "true"){
unset($_SESSION['cart_p_id']);
unset($_SESSION['cart_size_id']);
unset($_SESSION['cart_size_name']);
unset($_SESSION['cart_color_id']);
unset($_SESSION['cart_color_name']);
unset($_SESSION['cart_p_qty']);
unset($_SESSION['cart_p_current_price']);
unset($_SESSION['cart_p_name']);
unset($_SESSION['cart_p_featured_photo']); 

unset($_SESSION['cart_p_old_price']); 
unset($_SESSION['cart_p_description']); 
unset($_SESSION['cart_p_short_description']); 
unset($_SESSION['cart_p_feature']); 
unset($_SESSION['cart_p_condition']); 
unset($_SESSION['cart_p_return_policy']); 
unset($_SESSION['cart_p_total_view']); 
unset($_SESSION['cart_p_is_featured']); 
unset($_SESSION['cart_p_is_active']); 
unset($_SESSION['cart_ecat_id']); 
unset($_SESSION['cart_aff_percent']); 

//die;
}
// Check if the product is valid or not
if( !isset($_REQUEST['id']) || !isset($_REQUEST['size']) || !isset($_REQUEST['color'])  ) {
    header('location: cart.php');
    exit;
}



$i=0;
foreach($_SESSION['cart_p_id'] as $key => $value) {
    $i++;
    $arr_cart_p_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_size_id'] as $key => $value) {
    $i++;
    $arr_cart_size_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_size_name'] as $key => $value) {
    $i++;
    $arr_cart_size_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_color_id'] as $key => $value) {
    $i++;
    $arr_cart_color_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_color_name'] as $key => $value) {
    $i++;
    $arr_cart_color_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_qty'] as $key => $value) {
    $i++;
    $arr_cart_p_qty[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_current_price'] as $key => $value) {
    $i++;
    $arr_cart_p_current_price[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_name'] as $key => $value) {
    $i++;
    $arr_cart_p_name[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_p_featured_photo'] as $key => $value) {
    $i++;
    $arr_cart_p_featured_photo[$i] = $value;
}


unset($_SESSION['cart_p_id']);
unset($_SESSION['cart_size_id']);
unset($_SESSION['cart_size_name']);
unset($_SESSION['cart_color_id']);
unset($_SESSION['cart_color_name']);
unset($_SESSION['cart_p_qty']);
unset($_SESSION['cart_p_current_price']);
unset($_SESSION['cart_p_name']);
unset($_SESSION['cart_p_featured_photo']);
$i=0;
foreach($_SESSION['cart_p_old_price'] as $key => $value) {
    $i++;
    $arr_cart_p_old_price[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_description'] as $key => $value) {
    $i++;
    $arr_cart_p_description[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_short_description'] as $key => $value) {
    $i++;
    $arr_cart_p_short_description[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_feature'] as $key => $value) {
    $i++;
    $arr_cart_p_feature[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_condition'] as $key => $value) {
    $i++;
    $arr_cart_p_condition[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_return_policy'] as $key => $value) {
    $i++;
    $arr_cart_p_return_policy[$i] = $value;
}
$i=0;
foreach($_SESSION['cart_p_total_view'] as $key => $value) {
    $i++;
    $arr_cart_p_total_view[$i] = $value;
}
foreach($_SESSION['cart_p_is_featured'] as $key => $value) {
    $i++;
    $arr_cart_p_is_featured[$i] = $value;
}
foreach($_SESSION['cart_p_is_active'] as $key => $value) {
    $i++;
    $arr_cart_p_is_active[$i] = $value;
}
foreach($_SESSION['cart_ecat_id'] as $key => $value) {
    $i++;
    $arr_cart_ecat_id[$i] = $value;
}
foreach($_SESSION['cart_aff_percent'] as $key => $value) {
    $i++;
    $arr_cart_aff_percent[$i] = $value;
}

unset($_SESSION['cart_p_old_price']); 
unset($_SESSION['cart_p_description']); 
unset($_SESSION['cart_p_short_description']); 
unset($_SESSION['cart_p_feature']); 
unset($_SESSION['cart_p_condition']); 
unset($_SESSION['cart_p_return_policy']); 
unset($_SESSION['cart_p_total_view']); 
unset($_SESSION['cart_p_is_featured']); 
unset($_SESSION['cart_p_is_active']); 
unset($_SESSION['cart_ecat_id']); 
unset($_SESSION['cart_aff_percent']);

$k=1;
for($i=1;$i<=count($arr_cart_p_id);$i++) {
    if( ($arr_cart_p_id[$i] == $_REQUEST['id']) && ($arr_cart_size_id[$i] == $_REQUEST['size']) && ($arr_cart_color_id[$i] == $_REQUEST['color']) ) {
        continue;
    } else {
        $_SESSION['cart_p_id'][$k] = $arr_cart_p_id[$i];
        $_SESSION['cart_size_id'][$k] = $arr_cart_size_id[$i];
        $_SESSION['cart_size_name'][$k] = $arr_cart_size_name[$i];
        $_SESSION['cart_color_id'][$k] = $arr_cart_color_id[$i];
        $_SESSION['cart_color_name'][$k] = $arr_cart_color_name[$i];
        $_SESSION['cart_p_qty'][$k] = $arr_cart_p_qty[$i];
        $_SESSION['cart_p_current_price'][$k] = $arr_cart_p_current_price[$i];
        $_SESSION['cart_p_name'][$k] = $arr_cart_p_name[$i];
        $_SESSION['cart_p_featured_photo'][$k] = $arr_cart_p_featured_photo[$i];

        $_SESSION['cart_p_old_price'][$k] = $arr_cart_p_old_price[$i];
        $_SESSION['cart_p_description'][$k] = $arr_cart_p_description[$i];
        $_SESSION['cart_p_short_description'][$k] = $arr_cart_p_short_description[$i];
        $_SESSION['cart_p_feature'][$k] = $arr_cart_p_feature[$i];
        $_SESSION['cart_p_condition'][$k] = $arr_cart_p_condition[$i];
        $_SESSION['cart_p_return_policy'][$k] = $arr_cart_p_return_policy[$i];
        $_SESSION['cart_p_total_view'][$k] = $arr_cart_p_total_view[$i];
        $_SESSION['cart_p_is_featured'][$k] = $arr_cart_p_is_featured[$i];
        $_SESSION['cart_p_is_active'][$k] = $arr_cart_p_is_active[$i];
        $_SESSION['cart_ecat_id'][$k] = $arr_cart_ecat_id[$i];
        $_SESSION['cart_aff_percent'][$k] = $arr_cart_aff_percent[$i];
        
        $k++;
    }
}
header('location: cart.php');
?>