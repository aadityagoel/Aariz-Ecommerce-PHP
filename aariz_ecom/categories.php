<!--head -->
<?php 
    require('header.php');

    //sorting
    $price_low_high_selected = "";
    $price_high_low_selected = "";
    $new_selected = "";
    $old_selected = "";
    if(isset($_GET['sort'])){
        $sort=mysqli_real_escape_string($con, $_GET['sort']);
        if($sort=="price_low_high"){
            $sort_order = " order by product.price asc ";
            $price_low_high_selected = "selected";
        }elseif($sort=="price_high_low"){
            $sort_order = " order by product.price desc ";
            $price_high_low_selected = "selected";
        }elseif($sort=="new"){
            $sort_order = " order by product.id desc ";
            $new_selected = "selected";
        }elseif($sort=="old"){
            $sort_order = " order by product.id asc ";
            $old_selected = "selected";
        }
    }else{
        $sort_order = ''; 
    }
    //sorting

    if ($_GET['id']=='' || $_GET['id']<=0) {

        ?>
        <script>
            window.location.href='index.php';
        </script>
        <?php
        // header('location:index.php');
        // $id='';
        // $cat_id = mysqli_real_escape_string($con, $id);
    }else{
        $cat_id = mysqli_real_escape_string($con, $_GET['id']);
    }
    $get_product = get_product($con, '', $cat_id, '', '', $sort_order);
?>
<!-- head -->

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                          <a class="breadcrumb-item" href="index.php">Home</a>
                          <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                          <span class="breadcrumb-item active">Products</span>
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
            <div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">
                <div class="htc__product__rightidebar">
                    <div class="htc__grid__top">
                        <div class="htc__select__option">
                            <select class="ht__select" onchange="sort_product_drop('<?php echo $cat_id ?>','<?php echo SITE_PATH ?>')" id="sort_product_id">
                                <option value="">Default softing</option>
                                <option value="price_low_high" <?php echo $price_low_high_selected ?>>Sort by price Low to High</option>
                                <option value="price_high_low" <?php echo $price_high_low_selected ?>>Sort by price High to Low</option>
                                <option value="new" <?php echo $new_selected ?>>Sort by new first</option>
                                <option value="old" <?php echo $old_selected ?>>Sort by old first</option>
                            </select>
                        </div>
                        <!-- <div class="ht__pro__qun">
                            <span>Showing 1-12 of 1033 products</span>
                        </div> -->
                        <!-- Start List And Grid View -->
                        <ul class="view__mode" role="tablist">
                            <li role="presentation" class="grid-view active"><a href="#grid-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-grid"></i></a></li>
                            <li role="presentation" class="list-view"><a href="#list-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-view-list"></i></a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                    <!-- Start Product View -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                <?php
                                foreach ($get_product as $list) {
                                ?>
                                <!-- Start Single Product -->
                                <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
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
                            <div role="tabpanel" id="list-view" class="single-grid-view tab-pane fade clearfix">
                                <div class="col-xs-12">
                                    <div class="ht__list__wrap">
                                        <?php
                                        foreach ($get_product as $list) {
                                        ?>
                                        <!-- Start List Product -->
                                        <div class="ht__list__product">
                                            <div class="ht__list__thumb">
                                                <a href="product.php?id=<?php echo $list['id']; ?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']; ?>" alt="<?php echo $list['name']; ?>"></a>
                                            </div>
                                            <div class="htc__list__details">
                                                <h2><a href="product.php?id=<?php echo $list['id']; ?>"><?php echo $list['name']; ?></a></h2>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize"><del>&#8377;<?php echo $list['mrp']; ?></del></li>
                                                    <li>&#8377;<?php echo $list['price']; ?></li>
                                                </ul>
                                                <!-- <ul class="rating">
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li class="old"><i class="icon-star icons"></i></li>
                                                    <li class="old"><i class="icon-star icons"></i></li>
                                                </ul> -->
                                                <p><?php echo $list['short_desc']; ?></p>
                                                <div class="fr__list__btn">
                                                    <a class="fr__btn" href="cart.php?id=<?php echo $list['id']; ?>">Add To Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End List Product -->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Product View -->
                </div>
                <!-- Start Pagenation -->
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="htc__pagenation">
                           <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li> 
                           <li><a href="#">1</a></li> 
                           <li class="active"><a href="#">3</a></li>   
                           <li><a href="#">19</a></li> 
                           <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li> 
                        </ul>
                    </div>
                </div>
                <!-- End Pagenation -->
            </div>
            <?php } else { ?>
                <h2>No Product Found</h2>
            <?php }?>
            <div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 col-sm-12 col-xs-12 smt-40 xmt-40">
                <div class="htc__product__leftsidebar">
                    <!-- Start Prize Range -->
                    <div class="htc-grid-range">
                        <h4 class="title__line--4">Price</h4>
                        <div class="content-shopby">
                            <div class="price_filter s-filter clear">
                                <form action="#" method="GET">
                                    <div id="slider-range"></div>
                                    <div class="slider__range--output">
                                        <div class="price__output--wrap">
                                            <div class="price--output">
                                                <span>Price :</span><input type="text" id="amount" readonly>
                                            </div>
                                            <div class="price--filter">
                                                <a href="#">Filter</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Prize Range -->
                    <!-- Start Category Area -->
                    <div class="htc__category">
                        <h4 class="title__line--4">categories</h4>
                        <ul class="ht__cat__list">
                            <?php
                            $get_category = get_category($con);
                            foreach ($get_category as $cate) {
                            ?>
                            <li><a href="categories.php?id=<?php echo $cate['id']; ?>"><?php echo $cate['categories']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- End Category Area -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Grid -->

<!-- footer -->
<?php require('footer.php') ?>
<!-- footer