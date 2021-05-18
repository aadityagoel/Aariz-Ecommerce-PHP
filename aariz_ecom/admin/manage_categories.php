<?php
   require('session.inc.php');
   
   $categories = '';
   $msg = '';

   // check whether id is valid provided in the url
   if(isset($_GET['id']) && $_GET['id']!=''){
      $id = get_safe_value($con, $_GET['id']);
      $sel = mysqli_query($con, "select * from categories where id = '$id'");
      $check = mysqli_num_rows($sel);
      if($check>0)
      {
         $row = mysqli_fetch_assoc($sel);
         $categories = $row['categories'];
      }
      else
      {
         header('location:categories.php');
      }
   }

   if(isset($_POST['submit'])){
      $categories = get_safe_value($con, $_POST['categories']);
      // check whether the data is already present in the table or not
      $sel = mysqli_query($con, "select * from categories where categories = '$categories'");
      $check = mysqli_num_rows($sel);
      if($check>0){
         $msg="Category Already Exist";
      }else{
         // if we get id the update it else add it
         if(isset($_GET['id']) && $_GET['id']!=''){
            $update = "update categories set categories='$categories' where id='$id'";
            mysqli_query($con, $update);
         }else{
            $insert = "insert into categories(categories,status) values('$categories', '1')";
            mysqli_query($con, $insert);
         }
         // echo "<script>window.location.href = 'categories.php';</script>";
         header('location:categories.php');
      }
   }
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
               <?php if(isset($_GET['id'])){ ?>
               <h1>Edit Category</h1>
               <?php }else{ ?>
               <h1>Add Category</h1>
               <?php }?>
            </div>
            
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="container">
         <div class="row">
            <!-- left column -->
            <div class="col-md-12">
               <!-- jquery validation -->
               <div class="card">
                  <!-- <div class="card-header">
                     <h3 class="card-title">Category <small>Form</small></h3>
                  </div> -->
                  <!-- /.card-header -->
                  <!-- form start -->
                  <?php if(!empty($msg)){  ?>
                  <p class="text-danger m-2 p-2"><b><?php echo $msg?></b> </p>
                  <?php } ?>
                  
                  <form role="form" method="post" id="categoriesForm">
                     <div class="card-body">
                        <div class="form-group">
                           <label for="categories">Category</label>
                           <input type="text" name="categories" class="form-control" id="categories" placeholder="Enter Categories name" value="<?php echo $categories ?>" required>
                        </div>
                     </div>
                     <!-- /.card-body --> 
                     <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-success swalDefaultError">Submit</button>
                     </div>
                  </form>
               </div>
               
               <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
            </div>
            <!--/.col (right) -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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