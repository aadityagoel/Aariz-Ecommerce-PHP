<?php
  require('connection.inc.php');
  require('functions.inc.php');

  $name = get_safe_value($con, $_POST['name']);
  $email = get_safe_value($con, $_POST['email']);
  $mobile = get_safe_value($con, $_POST['mobile']);
  $password = get_safe_value($con, $_POST['password']);
  $added_on = date('Y-m-d h:i:s');

  $check = mysqli_num_rows(mysqli_query($con, "select * from users where email = '$email'" ));

  if($check>0){
      echo "Present";
  }else{
      mysqli_query($con, "insert into users(name, email, mobile, password, added_on) values('$name', '$email', '$mobile', '$password', '$added_on')");
      echo "Not Present";
  }
  
?>