<?php

  include('config/db_connection.php');

  $item = $sname = $email = $bid = '';

  $errors = array('item' => '', 'sname' => '', 'email' => '', 'bid' => '');

  if(isset($_POST['submit'])){

    //check item number
    if(empty($_POST['item'])){
        $errors['item'] = 'an item number is required <br />';
    } else {
        $item = $_POST['item'];
        if(!preg_match('/^[0-9]+$/', $item)){
            $errors['item'] = 'item no must contain numbers';

        }
    }

    //check item name
    if(empty($_POST['sname'])){
        $errors['sname'] = 'an item name is required <br />';
    } else {
        $sname= $_POST['sname'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $sname)){
            $errors['sname'] = 'item must only contain letter';
        }
    }

    //check email
    if(empty($_POST['email'])){
        $errors['email'] = 'an email is required <br />';
      } else {
       $email = $_POST['email'];
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email'] = 'Email must be a valid email address';
       }
      }


      // check bid
    if(empty($_POST['bid'])){
      $errors['bid'] = 'an item number is required <br />';
    } else {
      $bid = $_POST['bid'];
      if(!preg_match('/^[0-9\s]+$/', $bid)){
        $errors['bid'] = 'bid must contain numbers';

    }
    if(array_filter($errors)){
        //echo 'errors in form';
       } else {
           $item = mysqli_real_escape_string($conn, $_POST['item']);
           $sname = mysqli_real_escape_string($conn, $_POST['sname']);
           $email = mysqli_real_escape_string($conn, $_POST['email']);
           $bid = mysqli_real_escape_string($conn, $_POST['bid']);

           //create sql
           $sql = "INSERT INTO auc(item,sname,email,bid) VALUES('$item', '$sname', '$email', '$bid')";

           //save to db and check
           if(mysqli_query($conn, $sql)){
               //success
           } else {
               //error
               echo 'query error: ' . mysqli_error($conn);
           }
           header('Location: items.php');
       }
    
      

   }
  
   
  }

  
  

?>

<!DOCTYPE html>
<html>
  <?php include('templates/header.php') ?> 
    <section class="container grey-text"> 
      <h4 class="center">Add Item Bid</h4>
      <h6 class="center" style="color: red">Add name and number as shown on previous page otherwise your bid is not valid!</h4>
        <form class="white" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <label>Item no:</label>
          <input type="text"  name="item" value="<?php echo htmlspecialchars($item); ?>">
          <div class="red-text"><?php echo $errors['item']; ?></div>

          <label>Product Name:</label>
          <input type="text" name="sname" value="<?php echo htmlspecialchars($sname); ?>">
          <div class="red-text"><?php echo $errors['sname']; ?></div>

          <label>Your Email:</label>
          <input type="text"  name="email" value="<?php echo htmlspecialchars($email); ?>">
          <div class="red-text"><?php echo $errors['email']; ?></div>

          <label>Your Bid $:</label>
            <input type="text"  name="bid" value="<?php echo htmlspecialchars($bid); ?>">
          <div class="red-text"><?php echo $errors['bid']; ?></div>

          <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
          </div>


        </form>
    
    </section>
  <?php include('templates/footer.php') ?>
</html>