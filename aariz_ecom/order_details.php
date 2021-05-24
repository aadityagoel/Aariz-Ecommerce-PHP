<!--head -->
<?php require('header.php'); 

if ($_GET['order_id']=='' || $_GET['order_id']<=0) {

    ?>
        <script>
            window.location.href='index.php';
        </script>
    <?php
    }else{
        $order_id = mysqli_real_escape_string($con, $_GET['order_id']);
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
                            <span class="breadcrumb-item active">Orders Detail</span>
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
if(!isset($_SESSION['USER_ID'])){
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
<?php }?>
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
                                        
                                        
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name"> Product Name </th>
                                        <th class="product-name"> Price (1 item) </th>
                                        <th class="product-name"> Quantity </th>
                                        <th class="product-name"> Total Price </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $uid = $_SESSION['USER_ID'];
                                        // echo "select distinct(order_detail.id),product.name, product.image from order_detail,product,orders where order_detail.order_id = '$order_id' and orders.user_id = '$uid' and product.id = order_detail.product_id";
                                        $res = mysqli_query($con,"select distinct(order_detail.id),order_detail.*,product.name, product.image from order_detail,product,orders where order_detail.order_id = '$order_id' and orders.user_id = '$uid' and product.id = order_detail.product_id ");
                                        $total = 0;
                                        while($row=mysqli_fetch_assoc($res)){
                                        $total = $total + $row['total_price'];
                                    ?>
                                    <tr onclick="getOrderDetail(<?php echo $row['order_id'] ?>)">
                                        
                                        <td class="product-thumbnail"><a href="product.php?id=<?php echo $row['product_id']; ?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt="" /></a></td>
                                        
                                        <td class="product-name"><a href="product.php?id=<?php echo $row['product_id']; ?>"><?php echo $row['name'] ?></a></td>
                                        <td class="product-name"><?php echo $row['price'] ?></td>
                                        <td class="product-name"><?php echo $row['qty'] ?></td>
                                        <td class="product-name"><?php echo $row['total_price'] ?></td>
                                        
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">Total</td>
                                        <td class="product-name"><?php echo $total ?></td>
                                    </tr>
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

<!-- footer -->
<?php require('footer.php') ?>
<!-- footer-->