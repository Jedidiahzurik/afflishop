
<?php
include('high_header.php');
?>   

<body class="sticky-header" onload="opencart()">
    <?php echo $after_body; ?>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
   $about_title = $row['about_title'];
    $about_content = $row['about_content'];
    $about_banner = $row['about_banner'];
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
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">About Us</li>
                            </ul>
                            <h1 class="title">About Our Store</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img src="assets/images/product/product-45.png" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb Area  -->

        <!-- Start About Area  -->
        <div class="axil-about-area about-style-1 axil-section-gap ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-6">
                        <div class="about-thumbnail">
                            <div class="thumbnail">
                                <img src="./assets/images/about/about-01.png" alt="About Us">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6">
                        <div class="about-content content-right">
                            <span class="title-highlighter highlighter-primary2"> <i class="far fa-shopping-basket"></i>About Store</span>
                            <h3 class="title">Afflishop is a digital marketplace where we help creators of digital products get more sales and connect with more customers via our platform and network of high performing affiliates.</h3>
                            
                            <div class="row">
                                <div class="col-xl-6">
                                    <h5>Are You a Product Creator? Let's Help You Sell More Of Your Digital Products</h5>
                                    <p class="mb--0">Getting affiliates to promote your digital products is the absolute fastest way to get more paying customers.

Our high performing affiliates have sold over 20,000 digital products and they can help you reach more customers.</p>
                                </div>
                                <div class="col-xl-6">
                                    <h5>Get Paid For Recommending High Value Digital Products From Top Experts</h5>
                                    <p class="mb--0">You can earn money by recommending any of the high value digital products on Expertnaire to your subscribers and followers.

All you have to do is use the unique link of each product that our system provides

Our highly effective tracking system ensures that you are compensated for the sales you refer.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Area  -->

        <!-- Start About Area  -->
        <div class="about-info-area">
            <div class="container">
                <div class="row row--20">
                    <div class="col-lg-4">
                        <div class="about-info-box">
                            <div class="thumb">
                                <img src="assets/images/about/shape-01.png" alt="Shape">
                            </div>
                            <div class="content">
                                <h6 class="title">350,000+ Products Sold</h6>
                                




                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="about-info-box">
                            <div class="thumb">
                                <img src="assets/images/about/shape-02.png" alt="Shape">
                            </div>
                            <div class="content">
                                <h6 class="title">87,000+ Affiliates</h6>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="about-info-box">
                            <div class="thumb">
                                <img src="assets/images/about/shape-03.png" alt="Shape">
                            </div>
                            <div class="content">
                                <h6 class="title">130+ Product Creators</h6>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Area  -->

        <!-- Start Team Area  -->
        <!--<div class="axil-team-area bg-wild-sand">-->
        <!--    <div class="team-left-fullwidth">-->
        <!--        <div class="container ml--xxl-0">-->
        <!--            <div class="section-title-wrapper">-->
        <!--                <span class="title-highlighter highlighter-primary"> <i class="fas fa-users"></i> Our Team</span>-->
        <!--                <h3 class="title">Expart Management Team</h3>-->
        <!--            </div>-->
        <!--            <div class="team-slide-activation slick-layout-wrapper--20 axil-slick-arrow  arrow-top-slide">-->
        <!--                <div class="slick-single-layout">-->
        <!--                    <div class="axil-team-member">-->
        <!--                        <div class="thumbnail"><img src="./assets/images/team/team-01.png" alt="Cody Fisher"></div>-->
        <!--                        <div class="team-content">-->
        <!--                            <span class="subtitle">Founder</span>-->
        <!--                            <h5 class="title">Rosalina D. Willson</h5>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="slick-single-layout">-->
        <!--                    <div class="axil-team-member">-->
        <!--                        <div class="thumbnail"><img src="./assets/images/team/team-02.png" alt="Cody Fisher"></div>-->
        <!--                        <div class="team-content">-->
        <!--                            <span class="subtitle">CEO</span>-->
        <!--                            <h5 class="title">Ukolilix X. Xilanorix</h5>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="slick-single-layout">-->
        <!--                    <div class="axil-team-member">-->
        <!--                        <div class="thumbnail"><img src="./assets/images/team/team-03.png" alt="Cody Fisher"></div>-->
        <!--                        <div class="team-content">-->
        <!--                            <span class="subtitle">Designer</span>-->
        <!--                            <h5 class="title">Alonso M. Miklonax</h5>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="slick-single-layout">-->
        <!--                    <div class="axil-team-member">-->
        <!--                        <div class="thumbnail"><img src="./assets/images/team/team-04.png" alt="Cody Fisher"></div>-->
        <!--                        <div class="team-content">-->
        <!--                            <span class="subtitle">Designer</span>-->
        <!--                            <h5 class="title">Alonso M. Miklonax</h5>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="slick-single-layout">-->
        <!--                    <div class="axil-team-member">-->
        <!--                        <div class="thumbnail"><img src="./assets/images/team/team-02.png" alt="Cody Fisher"></div>-->
        <!--                        <div class="team-content">-->
        <!--                            <span class="subtitle">Designer</span>-->
        <!--                            <h5 class="title">Alonso M. Miklonax</h5>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- End Team Area  -->

        <!-- Start About Area  -->
        <div class="axil-about-area about-style-2">
            <div class="container">
                <div class="row align-items-center mb--80 mb_sm--60">
                            <div class="tve-cb"><div class="thrv_wrapper thrv_text_element"><p style="text-align: center;" data-css="tve-u-16cd2fcb5e0"><strong>Frequently Asked Questions:</strong></p></div><div class="thrv_wrapper thrv_text_element"><p><strong>Question: What is Afflishop all about?</strong></p><p><strong>Re:</strong> Afflishop is an online marketplace for the sale of high value digital products. On Afflishop, there are 3 parties - The vendor, the affiliate and the customer</p><p>The vendor refers to the person who owns the product that is been sold</p><p>Affiliates are marketers who recommend the products on the platform to people and when any of the person they refer buys, they get a commission</p><p>Customers are simply those who purchase the products been sold on Afflishop&nbsp;</p><p><br></p><p><strong>Question: How do I become an affiliate on Afflishop?</strong></p><p><strong>Re:</strong> To sign up as an affiliate on Afflishop, you will have to pay a yearly renewable affiliate fee of N10,000 only. <a href="https://app.Afflishop.com/affiliate/register" target="_blank">Click here to sign up</a></p><p><br></p><p><strong>Question: How do I become a vendor on Afflishop?</strong></p><p><strong>Re:</strong> Afflishop only accepts vendors with very valuable products. To sign up as a Vendor on Afflishop, you need to send an email to <span style="color: rgb(0, 0, 0);" data-css="tve-u-16cd31cffe7"><u><a href="mailto:support@afflishop.com" class="__cf_email__" data-cfemail="">support@afflishop.com</a></u></span> providing the details of your products and access to the product itself.</p><p>Our quality control department will review your product and decide if it meets our standard.</p><p>Once your request has been approved, you will get a Vendor registration link. Vendor’s fee is N25,000 yearly. This process usually takes within 3-5 working days.</p><p><br></p><p><strong>Question: How am I sure that the products on Afflishop will deliver?</strong></p><p><strong>Re:</strong> All the products listed on the platform goes through thorough check by our quality control department before it is listed, we are always sure to confirm authenticity of every product before having it listed on our platform.</p><p><br></p><p><strong>Question: How is commission shared between vendors and affiliates?</strong></p><p><strong>Re:</strong> The vendors decide on the commissions. However, we generally advise and make vendors give out reasonable commissions to the affiliates so as to gear up interest on promoting their products.</p><p><br></p><p><strong>Question: Can I request for a higher commission on the product I want to promote?</strong></p><p><strong>Re: </strong>No you can’t. unless the vendor decides to increase it.&nbsp;</p><p><br></p><p><strong>Question: Does Afflishop teach people how to sell their products?</strong></p><p><strong>Re: </strong>No we do not. Afflishop only manages the platform to make it very useful to all the 3 parties interested. However, we created a Telegram group where you can network and learn from other top affiliates.</p><p><br></p><p><strong>Question: Do vendors make emails swipes or materials available to promote products on Afflishop?</strong></p><p><strong>Re:</strong> Some vendors do, others don't provide any marketing materials</p><p><br></p><p><strong>Question: How do I get paid?</strong></p><p><strong>Re:</strong> Afflishop pays affiliates and vendors via bank deposit. Your money is sent to a valid bank account that has your name on it. Affiliates are paid every Friday of the week. Vendors are paid bi-monthly.</p><p><br></p><p><strong>Question: Can I change the bank account details on my Afflishop account?</strong></p><p><strong>Re:</strong> Yes you can. However, the bank account must be from a Nigerian bank and must correspond with the name on the affiliate account.</p><p><br></p><p><strong>Question: Can I come to your office anytime I need help?</strong></p><p><strong>Re: </strong>There is hardly any issue that can't be resolved remotely. You can get help through our customer service channels (phone &amp; email)</p><p><br></p><p><strong>Question: How do I contact the Afflishop support as an affiliate or vendor?</strong></p><p><strong>Re:</strong> You can do so by sending an email to <u><a href="mailto:support@afflishop.com" class="__cf_email__" data-cfemail="">support@afflishop.com</a></u> </p><p><br></p></div></div>
                    
                    <!--<div class="col-lg-5">-->
                    <!--    <div class="about-thumbnail">-->
                    <!--        <img src="assets/images/about/about-02.png" alt="about">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-lg-7">-->
                    <!--    <div class="about-content content-right">-->

                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <!--<div class="row align-items-center">-->
                <!--    <div class="col-lg-5 order-lg-2">-->
                <!--        <div class="about-thumbnail">-->
                <!--            <img src="assets/images/about/about-03.png" alt="about">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-lg-7 order-lg-1">-->
                <!--        <div class="about-content content-left">-->
                            
                            
                            
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
        <!-- End About Area  -->

        <!-- Start Axil Newsletter Area  -->
        <!-- End Axil Newsletter Area  -->
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