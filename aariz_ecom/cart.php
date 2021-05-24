<!--head -->
<?php require('header.php'); 
// prx($_SESSION);
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
                            <span class="breadcrumb-item active">Shopping Cart</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php
                if(isset($_SESSION['cart'])){
                ?>
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $total = 0;
                                foreach($_SESSION['cart'] as $key=>$val){
                                    $ProductArr = get_product($con, '', '',$key);
                                    // pr($ProductArr);
                                    $pname = $ProductArr[0]['name'];
                                    $image = $ProductArr[0]['image'];
                                    $price = $ProductArr[0]['price'];
                                    $mrp = $ProductArr[0]['mrp'];

                                    $qty = $val['qty'];
                                    $subtotal = $qty*$price;
                                    
                                    // $total = $total + $subtotal;
                                ?>
                                <tr>
                                    <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image; ?>" alt="<?php echo $pname; ?>" /></a></td>
                                    <td class="product-name"><a href="#"><?php echo $pname; ?></a>
                                        <ul  class="pro__prize">
                                            <li class="old__prize"><del>&#8377;<?php echo $mrp; ?></del></li>
                                            <li>&#8377;<?php echo $price; ?></li>
                                        </ul>
                                    </td>
                                    <td class="product-price"><span class="amount">&#8377;<?php echo $price; ?></span></td>
                                    <td class="product-quantity"><input type="number" id="<?php echo $key ?>-qty" onchange="manage_cart('<?php echo $key ?>','update')" value="<?php echo $qty; ?>" />
                                        <!-- <br><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a> -->
                                    </td>

                                    <td class="product-subtotal">&#8377;<?php echo $subtotal ?></td>
                                    <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="icon-trash icons"></i></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="<?php echo SITE_PATH ?>">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <!-- <a href="#">update</a> -->
                                    <a href="<?php echo SITE_PATH ?>checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="ht__coupon__code">
                                <span>enter your discount code</span>
                                <div class="coupon__box">
                                    <input type="text" placeholder="">
                                    <div class="ht__cp__btn">
                                        <a href="#">enter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="htc__cart__total">
                                <h6>cart total</h6>
                                <div class="cart__desk__list">
                                    <ul class="cart__desc">
                                        <li>cart total</li>
                                        <li>tax</li>
                                        <li>shipping</li>
                                    </ul>
                                    <ul class="cart__price">
                                        <li>&#8377;<?php echo $total ?></li>
                                        <li>$9.00</li>
                                        <li>0</li>
                                    </ul>
                                </div>
                                <div class="cart__total">
                                    <span>order total</span>
                                    <span>$918.00</span>
                                </div>
                                <ul class="payment__btn">
                                    <li class="active"><a href="#">payment</a></li>
                                    <li><a href="#">continue shopping</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </form> 
                <?php } else { ?>
                    <h2>Your Cart is empty</h2>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->

<!-- footer -->
<?php require('footer.php') ?>
<!-- footer-->