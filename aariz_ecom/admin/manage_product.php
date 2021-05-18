<?php
   require('session.inc.php');
   
   $categories_id = '';
   $name = '';
   $mrp = '';
   $price = '';
   $qty = '';
   $image = '';
   $short_desc = '';
   $description = '';
   $meta_title = '';
   $meta_desc = '';
   $meta_keyword = '';
   $msg = '';

   $image_required = 'required';

   // check whether id is valid provided in the url
   if(isset($_GET['id']) && $_GET['id']!=''){
      $image_required = '';
      $id = get_safe_value($con, $_GET['id']);
      $sel = mysqli_query($con, "select * from product where id = '$id'");
      $check = mysqli_num_rows($sel);
      if($check>0)
      {
         $row = mysqli_fetch_assoc($sel);
         $categories_id = $row['categories_id'];
         $name = $row['name'];
         $mrp = $row['mrp'];
         $price = $row['price'];
         $qty = $row['qty'];
         $short_desc = $row['short_desc'];
         $description = $row['description'];
         $meta_title = $row['meta_title'];
         $meta_desc = $row['meta_desc'];
         $meta_keyword = $row['meta_keyword'];
      }
      else
      {
         header('location:product.php');
      }
   }

   if(isset($_POST['submit'])){
      $categories_id = get_safe_value($con, $_POST['categories_id']);
      $name = get_safe_value($con, $_POST['name']);
      $mrp = get_safe_value($con, $_POST['mrp']);
      $price = get_safe_value($con, $_POST['price']);
      $qty = get_safe_value($con, $_POST['qty']);
      $short_desc = get_safe_value($con, $_POST['short_desc']);
      $description = get_safe_value($con, $_POST['description']);
      $meta_title = get_safe_value($con, $_POST['meta_title']);
      $meta_desc = get_safe_value($con, $_POST['meta_desc']);
      $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);

      // image validation
      // if($_FILES['image']['type']='' && ($_FILES['image']['type']!= 'image/png' || $_FILES['image']['type']!= 'image/jpg' || $_FILES['image']['type']!= 'image/jpeg')){
      //    $msg = "Please select only png, jpg and jpeg image format";
      // }
      // if ($_FILES["image"]["size"] > 500000) {
      //   $msg = "Sorry, your file is too large.";
      // }

      // check whether the data is already present in the table or not
      $sel = mysqli_query($con, "select * from product where name = '$name'");
      $check = mysqli_num_rows($sel);
      if($check>0){
         $msg="Product Already Exist";
      }else{
         $image = rand(111111111, 999999999).'_'.$_FILES['image']['name'];
         move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH.$image);

         $insert = "insert into product(categories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword', '1', '$image')";
         mysqli_query($con, $insert);
         header('location:product.php');
      }
      

      // if we get id then update it
      if(isset($_GET['id']) && $_GET['id']!=''){
         if ($_FILES['image']['name']!='') {
            $image = rand(111111111, 999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH.$image);

            $update = "update product set categories_id='$categories_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc', description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword', image='$image' where id='$id'";
         }else{
            $update = "update product set categories_id='$categories_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc', description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword' where id='$id'";
         }
         mysqli_query($con, $update);
         header('location:product.php');
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
               <h1>Edit Product</h1>
               <?php }else{ ?>
               <h1>Add Product</h1>
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
                  
                  <form role="form" method="post" id="Form" enctype="multipart/form-data">
                     <div class="card-body">
                        <div class="form-group">
                           <label for="categories">Category</label>
                           <select class="form-control select2" name="categories_id" style="width: 100%;" required="">
                             <option selected="selected" value="" disabled="">Select Category</option>
                             <?php
                              $res = mysqli_query($con, "select id, categories from categories order by categories");
                              while($row = mysqli_fetch_assoc($res)) {
                                 if($row['id'] == $categories_id){
                                    echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                 }else{
                                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                 }
                                 
                             }
                              ?> 
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="name">Product Name</label>
                           <input type="text" name="name" class="form-control" id="name" placeholder="Enter Product name" value="<?php echo $name ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="mrp">MRP</label>
                           <input type="number" name="mrp" class="form-control" id="mrp" placeholder="Enter Product MRP" value="<?php echo $mrp ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="price">Price</label>
                           <input type="number" name="price" class="form-control" id="price" placeholder="Enter Product price" value="<?php echo $price ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="qty">Product Quantity</label>
                           <input type="number" name="qty" class="form-control" id="qty" placeholder="Enter Product Quantity" value="<?php echo $qty ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="image">Product Image</label>
                           <input type="file" name="image" class="form-control" id="image" <?php echo $image_required; ?> >
                        </div>
                        <div class="form-group">
                           <label for="short_desc">Short Description</label>
                           <textarea class="form-control" name="short_desc" id="short_desc" rows="3" placeholder="Enter Short Description ..." required=""><?php echo $short_desc ?></textarea>
                        </div>
                        <div class="form-group">
                           <label for="description">Description</label>
                           <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter Description ..." required=""><?php echo $description ?></textarea>
                        </div>
                        <div class="form-group">
                           <label for="meta_title">Meta Title</label>
                           <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Enter Meta Title" value="<?php echo $meta_title ?>">
                        </div>
                        <div class="form-group">
                           <label for="meta_desc">Meta Description</label>
                           <textarea class="form-control" name="meta_desc" id="meta_desc" rows="3" placeholder="Enter Meta Description ..."><?php echo $meta_desc ?></textarea>
                        </div>
                        <div class="form-group">
                           <label for="meta_keyword">Meta Keyword</label>
                           <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="Enter Meta Keyword" value="<?php echo $meta_keyword ?>">
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