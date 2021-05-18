<?php
   require('session.inc.php');

   if(isset($_GET['type']) && $_GET['type']!=''){
      $type = get_safe_value($con, $_GET['type']);
      
      // delete
      if($type == 'delete'){
         $id = get_safe_value($con, $_GET['id']);
         $delete_sql = "delete from users where id='$id' ";
         mysqli_query($con, $delete_sql);
      }
   }

   $sql = "select * from users order by added_on desc";
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
               <h1>Users</h1>
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
                           <th>User Id</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Mobile Number</th>
                           <th>Password</th>
                           <th>Added On</th>
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
                           <td><?php echo $row['name']; ?></td>
                           <td><?php echo $row['email']; ?></td>
                           <td><?php echo $row['mobile']; ?></td>
                           <td><?php echo $row['password']; ?></td>
                           <td><?php echo $row['added_on']; ?></td>
                           
                           <td>
                              <?php 
                              echo "<button type='button' class='btn btn-danger btn-sm'><a href='?type=delete&id=".$row['id']."' style='color: white;'>Delete</a></button>";
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