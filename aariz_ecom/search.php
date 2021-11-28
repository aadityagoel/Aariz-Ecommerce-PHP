<!--head -->
<?php 
    require('header.php');
    $str = mysqli_real_escape_string($con, $_GET['str']);
    if ($str!='') {
        $get_product = get_product($con, '', '', '', $str);
        
    }else{
        ?>
        <script>
            window.location.href='index.php';
        </script>
        <?php
    }
    
?>
<!-- head -->

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(assets/images/bg/banner_bg.png) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                          <a class="breadcrumb-item" href="index.php">Home</a>
                          <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                          <span class="breadcrumb-item active">Search</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
        <?php if(count($get_product)>0){ ?>
            <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                <div class="htc__product__rightidebar">
                    
                    <!-- Start Product View -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                <?php
                                foreach ($get_product as $list) {
                                ?>
                                <!-- Start Single Product -->
                                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                                    <div class="category">
                                        <div class="ht__cat__thumb">
                                            <a href="product.php?id=<?php echo $list['id']; ?>">
                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']; ?>" alt="product images">
                                            </a>
                                        </div>
                                        <div class="fr__hover__info">
                                            <ul class="product__action">
                                                <li><a href="wishlist.php?id=<?php echo $list['id']; ?>"><i class="icon-heart icons"></i></a></li>

                                                <li><a href="cart.php?id=<?php echo $list['id']; ?>"><i class="icon-handbag icons"></i></a></li>

                                                <li><a href="product.php?id=<?php echo $list['id']; ?>"><i class="fa fa-info"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="fr__product__inner">
                                            <h4><a href="product.php?id=<?php echo $list['id']; ?>"><?php echo $list['name']; ?></a></h4>
                                            <ul class="fr__pro__prize">
                                                <li class="old__prize"><del>&#8377;<?php echo $list['mrp']; ?></del></li>
                                                <li>&#8377;<?php echo $list['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                                <?php } ?>
                            </div>
                            
                        </div>
                    </div>
                    <!-- End Product View -->
                </div>
                <!-- Start Pagenation -->
                <!-- <div class="row">
                    <div class="col-xs-12">
                        <ul class="htc__pagenation">
                           <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li> 
                           <li><a href="#">1</a></li> 
                           <li class="active"><a href="#">3</a></li>   
                           <li><a href="#">19</a></li> 
                           <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li> 
                        </ul>
                    </div>
                </div> -->
                <!-- End Pagenation -->
            </div>
            <?php } else { ?>
                <h2>No Product Found</h2>
            <?php }?>
            
        </div>
    </div>
</section>
<!-- End Product Grid -->

<!-- footer -->
<?php require('footer.php') ?>
<!-- footer