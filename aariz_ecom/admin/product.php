<?php
   require('session.inc.php');

   if(isset($_GET['type']) && $_GET['type']!=''){
      $type = get_safe_value($con, $_GET['type']);

      // status
      if($type == 'status'){
         $operation = get_safe_value($con, $_GET['operation']);
         $id = get_safe_value($con, $_GET['id']);
         if($operation=='active'){
            $status = '1';
         }else{
            $status = '0';
         }
         $update_status_sql = "update product set status = '$status' where id='$id' ";
         mysqli_query($con, $update_status_sql);
      }

      // delete
      if($type == 'delete'){
         $id = get_safe_value($con, $_GET['id']);
         $delete_sql = "delete from product where id='$id' ";
         mysqli_query($con, $delete_sql);
      }
   }

   $sql = "select product.*, categories.categories from product,categories where product.categories_id = categories.id and categories.status = 1 order by added_on desc";
   $result = mysqli_query($con, $sql); 
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
               <h1>Products</h1>
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
               <div class="card-header d-flex">
                  <h3 class="card-title m-2"></h3>
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="manage_product.php">Add Product</a>
                    </li>
                  </ul>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-hover table-head-fixed">
                     <thead>
                        <tr>
                           <th class="serial">#</th>
                           <th>Product Id</th>
                           <th>Category </th>
                           <th>Product Name</th>
                           <th>MRP</th>
                           <th>Price</th>
                           <th>Quantity</th>
                           <th>Image</th>
                           <th>Added On</th>
                           <th>Status</th>
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
                           <td><?php echo $row['id'] ?></td>
                           <td><?php echo $row['categories']; ?></td>
                           <td><?php echo $row['name']; ?></td>
                           <td><?php echo $row['mrp']; ?></td>
                           <td><?php echo $row['price']; ?></td>
                           <td><?php echo $row['qty']; ?></td>
                           <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']; ?>" style="height: 30px; width: 30px;"> </td>
                           <td><?php echo $row['added_on']; ?></td>
                           <td>
                              <?php 
                              if($row['status']==1){
                                 echo "<span class='badge bg-success'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>";
                              }else{
                                 echo "<span class='badge bg-danger'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>";
                              }
                              ?>
                           </td>
                           <td>
                              <?php 
                              echo "<button type='button' class='btn btn-info btn-sm'><a href='manage_product.php?id=".$row['id']."' style='color: white;'>Edit</a></button>";
                              echo "&emsp;<button type='button' class='btn btn-danger btn-sm'><a href='?type=delete&id=".$row['id']."' style='color: white;'>Delete</a></button>";
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