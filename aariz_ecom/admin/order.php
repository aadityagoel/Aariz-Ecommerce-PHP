<?php
   require('session.inc.php');

   $sql = "select orders.*,users.name,order_status.status_name from orders,users,order_status where orders.user_id=users.id and orders.order_status=order_status.status_id order by orders.added_on desc";
   $result = mysqli_query($con, $sql); 
//    echo $sql;
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
               <h1>Orders</h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-12">
            <!-- /.card -->
            <div class="card">
               
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-hover table-head-fixed">
                     <thead>
                        <tr>
                           <th class="serial">#</th>
                           <th>Order Id</th>
                           <th>User</th>
                           <th>Ship To (City-State)</th>
                           <!-- <th>Base Price</th> -->
                           <th>Total Amount</th>
                           <th>Ordered On</th>
                           <th>Ordered Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           while($row = mysqli_fetch_assoc($result)) {
                         ?>
                        <tr>
                           <td class="serial"><?php echo $i ?></td>
                           <td><?php echo $row['order_id'] ?></td>
                           <td><?php echo $row['name']; ?></td>
                           <td><?php echo $row['city']; ?> - <?php echo $row['state']; ?></td>
                           <!-- <td>0</td> -->
                           <td>&#8377;<?php echo $row['total_amount']; ?></td>
                           <td><?php echo $row['added_on']; ?></td>
                           <td><?php echo $row['status_name']; ?></td>
                           
                           <td>
                              <?php 
                              echo "<button type='button' class='btn btn-info btn-sm'><a href='order_detail.php?order_id=".$row['order_id']."' style='color: white;'>Info</a></button>";
                              ?>
                           </td>
                        </tr> 
                        <?php 
                           $i = $i + 1;
                        }
                        ?>
                     </tbody>
                     
                  </table>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
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

</body>
</html>