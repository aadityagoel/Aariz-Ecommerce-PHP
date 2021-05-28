<?php
   require('session.inc.php');

   if ($_GET['order_id']=='' || $_GET['order_id']<=0) {

    ?>
        <script>
            window.location.href='order.php';
        </script>
    <?php
    }else{
        $order_id = mysqli_real_escape_string($con, $_GET['order_id']);
    }

//    $sql = "select distinct(order_detail.id),order_detail.*,product.name, product.image from order_detail,product,orders where order_detail.order_id = '$order_id' and  product.id = order_detail.product_id ";
   $query = "Select * from orders where order_id = '$order_id'";
//    echo $query; 
//    $sql = "select orders.*,users.name,order_status.status_name from orders,users,order_status where orders.user_id=users.id and orders.order_status=order_status.status_id order by orders.added_on desc";
//    $result = mysqli_query($con, $sql); 
   $result = mysqli_query($con, $query); 
   $row2 = mysqli_fetch_assoc($result);
//    echo $sql;
// pr($result);
?>

<!-- head -->
<?php require('header.inc.php') ?>
<!-- head -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="order.php">Order</a></li>
              <li class="breadcrumb-item active">Order Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Aariz
                    <small class="float-right"><b>Order Date: </b><?php echo $row2['added_on'] ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info mt-3">
                <div class="col-sm-4 invoice-col">
                  <strong>Shipping Address</strong> 
                  <address>
                    <?php echo $row2['ship_user_name'] ?><br>
                    <?php echo $row2['ship_address'] ?><br>
                    <?php echo $row2['city'] ?>, <?php echo $row2['state'] ?> - <?php echo $row2['pincode'] ?><br>
                    Phone: <?php echo $row2['phone'] ?><br>
                    Email: <?php echo $row2['email'] ?>
                  </address>
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <?php
                  $status=$row2['order_status'];
                  $row3 = mysqli_fetch_assoc(mysqli_query($con, "Select * from order_status where status_id = $status"));
                  ?>
                  <b>Order Status: </b> <?php echo $row3['status_name'] ?> <br>
                  <b>Order ID:</b> <?php echo $row2['order_id'] ?><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price (1 item)</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            $res = mysqli_query($con,"select distinct(order_detail.id),order_detail.*,product.name, product.image from order_detail,product,orders where order_detail.order_id = '$order_id' and  product.id = order_detail.product_id");
                            $total = 0;
                            while($row=mysqli_fetch_assoc($res)){
                            $total = $total + $row['total_price'];
                        ?>
                        <tr>
                            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt="<?php echo $row['name'] ?>" style="height: 30px; width: 30px;" /></td>
                            <td><?php echo $row['name'] ?></td>
                            <td>&#8377;<?php echo $row['price'] ?></td>
                            <td><?php echo $row['qty'] ?></td>
                            <td>&#8377;<?php echo $row['total_price'] ?></td>
                            
                            <?php } ?>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <p class="well well-sm shadow-none" ><?php echo $row2['payment_type'] ?></p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                 

                  <div class="table-responsive">
                    <table class="table">
                      <!-- <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>&#8377;<?php echo $total ?></td>
                      </tr> -->
                      <!-- <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr> -->
                      <tr>
                        <th>Total:</th>
                        <td>&#8377;<?php echo $row2['total_amount'] ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                  <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button> -->
                  <button type="button" class="btn btn-default float-right" data-toggle="modal" data-target="#modal-default">
                    Change Order Status
                  </button>
                  <button type="button" class="btn btn-primary float-right" id="print" onclick="printPdf()" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Order Status</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php 
                if(isset($_POST['submit'])){
                  $status_id = get_safe_value($con, $_POST['update_order_status']);
                  mysqli_query($con, "update orders set order_status = $status_id where order_id = $order_id");
                }
              ?>
              <form method="POST">
                <div class="form-group">
                  
                  <label for="update_order_status">Order Status</label>
                  <select class="form-control select2" id="update_order_status" name="update_order_status" style="width: 100%;" required="">
                    <option selected="selected" value="" disabled="">Select Order Status</option>
                    <?php
                    $res = mysqli_query($con, "select * from order_status");
                    while($row = mysqli_fetch_assoc($res)) {
                      echo "<option value=".$row['status_id'].">".$row['status_name']."</option>";
                    }
                    ?> 
                  </select>
                </div>
                <input type="submit" name="submit" class="btn btn-success float-right" value="Save">
                <!-- <button type="submit" name="submit" class="btn btn-success swalDefaultError">Submit</button> -->
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!-- <button type="submit" name="submit" class="btn btn-primary">Save changes</button> -->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- footer -->
<?php require('footer.inc.php') ?>
<!-- footer -->

<!-- scripts -->
<?php require('script.inc.php') ?>
<!-- scripts -->

<script>
    function printPdf(){
        window.print();
    }
    // document.getElementById("print").addEventListener("click", window.print());
</script>
</body>
</html>