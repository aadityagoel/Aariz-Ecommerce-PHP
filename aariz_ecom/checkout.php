<!--head -->
<?php require('header.php'); 
// prx($_SESSION);
// if(!isset($_SESSION['cart'])){
if(count($_SESSION['cart'])==0){
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php
}

$total = 0;
$tax= 0;
$ship = 0;
foreach($_SESSION['cart'] as $key=>$val){
    $ProductArr = get_product($con, '', '',$key);
    // pr($ProductArr);
    
    $price = $ProductArr[0]['price'];
    $qty = $val['qty'];

    $subtotal = $qty*$price;
    
    $total = $total + $subtotal;
    // $tax = ($total * (18/100));
    // $ship = 50;
    $cart_total = $total + $tax + $ship;
}

if(isset($_POST['submit'])){
    // prx($_POST);
    $userid = $_SESSION['USER_ID'];
    $name = get_safe_value($con,$_POST['ship_user_name']);
    $address = get_safe_value($con,$_POST['ship_address']);
    $email = get_safe_value($con,$_POST['ship_email']);
    $phone = get_safe_value($con,$_POST['ship_phone']);
    $state = get_safe_value($con,$_POST['ship_state']);
    $city = get_safe_value($con,$_POST['ship_city']);
    $pincode = get_safe_value($con,$_POST['ship_pincode']);
    $payment_type = get_safe_value($con,$_POST['payment_type']);
    
    $total_amount = $cart_total;
    $payment_status = 'pending';
    // if($payment_type == 'payu'){
    //     $payment_status = 'success';
    // }
    $order_status = '1';
    // $added_on = date('Y-m-d h:i:s');

    mysqli_query($con, "insert into orders ( user_id, ship_user_name, ship_address, city, state,  pincode, phone, email, payment_type, total_amount, payment_status, order_status) values('$userid','$name','$address','$city','$state','$pincode','$phone','$email','$payment_type','$total_amount','$payment_status','$order_status')");


    $order_id = mysqli_insert_id($con);
    
    foreach($_SESSION['cart'] as $key=>$val){
        $ProductArr = get_product($con, '', '',$key);
        // pr($ProductArr);
        
        $price = $ProductArr[0]['price'];
        $qty = $val['qty'];

        $subtotal = $qty*$price;
        // $total = $total + $subtotal;
        // $tax = ($total * (18/100));
        // $ship = 50;
        // $cart_total = $total + $tax + $ship;

        mysqli_query($con, "insert into order_detail ( order_id, product_id, qty, price, total_price) values('$order_id','$key','$qty','$price','$subtotal')");
    }
    unset($_SESSION['cart']);
        ?>
        <script>
            window.location.href='thank_you.php';
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
                            <span class="breadcrumb-item active">Checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">
                            <?php 
                            $accordion_class = 'accordion__title';
                            if(!isset($_SESSION['USER_LOGIN'])){
                                $accordion_class = 'accordion__hide';
                            ?>
                            <div class="accordion__title">
                                Checkout Method
                            </div>
                            <div class="accordion__body">
                                <div class="accordion__body__form">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form id="login" method="post">
                                                    <h5 class="checkout-method__title">Login</h5>
                                                    <!-- <h5 class="checkout-method__title">Already Registered?</h5> -->
                                                    <!-- <p class="checkout-method__subtitle">Please login below:</p> -->
                                                    <div class="single-input">
                                                        <label for="login_email">Email Address</label>
                                                        <input type="email" id="login_email">
                                                        <span class="validation" id="login_email-error"></span>
                                                    </div>
                                                    
                                                    <div class="single-input">
                                                        <label for="login_password">Password</label>
                                                        <input type="password" id="login_password">
                                                        <span class="validation" id="login_password-error"></span>
                                                    </div>
                                                    
                                                    <!-- <p class="require">* Required fields</p> -->
                                                    <!-- <a href="#">Forgot Passwords?</a> -->
                                                    
                                                    <div class="dark-btn">
                                                        <button type="button" onclick="user_login()" class="fv-btn">Login</button>
                                                        <!-- <a href="#" onclick="user_login()">LogIn</a> -->
                                                    </div>

                                                    <div class="form-output login_msg">
                                                        <p class="form-messege"></p>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form id="register"  method="post">
                                                    <h5 class="checkout-method__title">Register</h5>
                                                    
                                                    <div class="single-input">
                                                        <label for="name">Name</label>
                                                        <input type="text" id="name">
                                                        <span class="validation " id="name-error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="mobile">Mobile</label>
                                                        <input type="text" id="mobile">
                                                        <span class="validation " id="mobile-error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="email">Email Address</label>
                                                        <input type="email" id="email">
                                                        <span class="validation " id="email-error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="password">Password</label>
                                                        <input type="password" id="password">
                                                        <span class="validation " id="password-error"></span>
                                                    </div>
                                                   
                                                    <div class="dark-btn">
                                                        <button type="button" onclick="user_register()" class="fv-btn">Register</button>
                                                    </div>

                                                    <div class="form-output register-msg">
                                                        <p class="form-messege"></p>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }else{ ?>

                            <form method="POST">
                                <div class="accordion__title">
                                    Billing Information
                                </div>
                                <div class="accordion__body">
                                    <div class="bilinfo">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" placeholder="Ship User Name" name="ship_user_name" id="ship_user_name" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="email" placeholder="Email address" name="ship_email" id="ship_email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="Phone number" name="ship_phone" id="ship_phone" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="Complete Address" name="ship_address" id="ship_address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="City" name="ship_city" id="ship_city" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="Post code/ zip/ Pin Code" name="ship_pincode" id="ship_pincode" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" placeholder="State" name="ship_state" id="ship_state" required>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion__title">
                                    payment information
                                </div>
                                <div class="accordion__body">
                                    <div class="shipmethod">
                                        <div class="single-input">
                                            <p>
                                                <input type="radio" name="payment_type" id="payu" value="payu" required>
                                                <label for="payu">PayU</label>
                                            </p>
                                            <p>UPI / Online Transaction / Bank Transfer</p>
                                        </div>
                                        <div class="single-input">
                                            <p>
                                                <input type="radio" name="payment_type" id="cod" value="cod" required>
                                                <label for="cod">COD </label>
                                            </p>
                                            <p>Cash on Delivery</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dark-btn">
                                    <input type="submit" name="submit" value="Proceed to Pay" >
                                </div>
                            </form>
                            <?php } ?>
                            
                            <!-- <div class="<?php echo $accordion_class ?>">
                                payment information
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                        $total = 0;
                        $tax= 0;
                        $ship = 0;
                        foreach($_SESSION['cart'] as $key=>$val){
                            $ProductArr = get_product($con, '', '',$key);
                            // pr($ProductArr);
                            $pname = $ProductArr[0]['name'];
                            $image = $ProductArr[0]['image'];
                            $price = $ProductArr[0]['price'];
                            $mrp = $ProductArr[0]['mrp'];

                            $qty = $val['qty'];
                            $subtotal = $qty*$price;
                            
                            $total = $total + $subtotal;
                            // $tax = ($total * (18/100));
                            // $ship = 50;
                            $cart_total = $total + $tax + $ship;
                        ?>
                        <div class="single-item">
                            <div class="single-item__thumb">
                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image; ?>" alt="<?php echo $pname; ?>">
                            </div>
                            <div class="single-item__content">
                                <a href="#"><?php echo $pname; ?></a>
                                <span class="price"><?php echo $subtotal; ?></span>
                            </div>
                            <div class="single-item__remove">
                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="order-details__count">
                        <div class="order-details__count__single">
                            <h5>sub total</h5>
                            <span class="price">&#8377;<?php echo $total ?></span>
                        </div>
                        <div class="order-details__count__single">
                            <h5>Tax</h5>
                            <span class="price">&#8377;<?php echo $tax ?></span>
                        </div>
                        <div class="order-details__count__single">
                            <h5>Shipping</h5>
                            <span class="price">&#8377;<?php echo $ship ?></span>
                        </div>
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price">&#8377;<?php echo $cart_total ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->
<!-- footer -->
<?php require('footer.php') ?>
<!-- footer-->