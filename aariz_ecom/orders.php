<!--head -->
<?php require('header.php');
if(!isset($_SESSION['USER_LOGIN'])){
    
    ?>
        <script>
            window.location.href='login.php';
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
                            <span class="breadcrumb-item active">Orders</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->


<!-- main -->
<?php 
$userid = $_SESSION['USER_ID'];
// echo "select orders.*, order_status.* from orders,order_status  where orders.user_id = '$userid' and orders.order_status = order_status.status_id";
$sql = "select orders.*, order_status.* from orders,order_status  where orders.user_id = '$userid' and orders.order_status = order_status.status_id";
$result = mysqli_query($con, $sql);
// echo pr(mysqli_fetch_assoc($result));
if(mysqli_num_rows($result) == 0){
    ?>
<section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">Sorry!!!</h2>
                    <p>You have not placed any order yet</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- main -->
<?php }else{?>
<!-- wishlist-area start -->
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        
                                        <th class="product-add-to-cart"> Address</th>
                                        <th class="product-price"> Price </th>
                                        <th class="product-price"> Payment Type </th>
                                        <th class="product-price"> Payment Status </th>
                                        <th class="product-price"> Order Date </th>
                                        <th class="product-stock-stauts"> Order Status </th>
                                        <th class="product-name"> Order Details</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // $uid = $_SESSION['USER_ID'];
                                        // $res = mysqli_query($con,"select orders.*, order_status.* from orders,order_status  where orders.user_id = '$uid' and orders.order_status = order_status.status_id ");
                                        // echo pr(mysqli_fetch_assoc($result));
                                        while($row=mysqli_fetch_assoc($result))
                                        {
                                            // echo pr($row);
                                    ?>
                                    <!-- <tr onclick="getOrderDetail(<?php echo $row['order_id'] ?>)"> -->
                                    <tr>  
                                        <!-- <td class="product-name"><?php echo $row['order_id'] ?></td> -->
                                        <td class="product-add-to-cart"> 
                                            <?php echo $row['ship_address'] ?>, <?php echo $row['city'] ?><br>
                                            <?php echo $row['pincode'] ?>, <?php echo $row['state'] ?><br>
                                            
                                        </td>
                                        <td class="product-price">&#8377;<?php echo $row['total_amount'] ?></td>
                                        <td class="product-price"><?php echo $row['payment_type'] ?></td>
                                        <td class="product-price"><?php echo $row['payment_status'] ?></td>
                                        <td class="product-price"><?php echo $row['added_on'] ?></td>
                                        <td class="product-stock-status"><?php echo $row['status_name'] ?></td>
                                        <td class="product-add-to-cart"><a href="order_details.php?order_id=<?php echo $row['order_id'] ?>">Get More Details</a> </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                
                            </table>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wishlist-area end -->
<?php } ?>
<!-- footer -->
<?php require('footer.php') ?>
<!-- footer-->

<script>
    function getOrderDetail(id){
        window.location.href = "order_details.php?order_id="+id;
    }
</script>