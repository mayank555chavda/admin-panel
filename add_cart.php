    <?php
    include 'dbconnect.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $user_phone = $_SESSION['user_phone'];
    $user_email = $_SESSION['user_email'];
    
    
if(!isset($user_name) || !isset($user_id) || !isset($user_phone) || !isset($user_email) ){
  header('location:form_page/login_page.php');
}


if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    
 $select_Quantity = mysqli_query($conn, "SELECT Quantity FROM product WHERE name = '$product_name'");
    $product_data = mysqli_fetch_assoc($select_Quantity);
    
    if ($product_quantity <=  $product_data['Quantity']) { 
      
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id' AND user_name = '$user_name' AND user_phone = '$user_phone' AND user_email = '$user_email'");
    
        if (mysqli_num_rows($select_cart) > 0) {
                echo "<script>alert('Product already added to cart!')</script>";
        }  else {

       mysqli_query($conn, "INSERT INTO `cart`(user_name, user_id, user_phone, user_email, name, price, image, quantity,status) VALUES ('$user_name', '$user_id', '$user_phone', '$user_email', '$product_name', '$product_price', '$product_image', '$product_quantity','pending')") or die('query failed');
     echo "<script>alert('Product added to cart!')</script>";
    //   header('location:add_cart.php');
   }
    }
    
    else {
        echo "<script>alert('stock Not available!')</script>";
    }
}

 
  
if(isset($_POST['update_cart'])){
    $update_quantity = $_POST['cart_quantity'];
    $update_id = $_POST['cart_id'];
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE id = '$update_id'");
    $fetch_cart = mysqli_fetch_assoc($cart_query);
    $product_name = $fetch_cart['name'];
    
    // Fetch product quantity from product table
    $select_Quantity = mysqli_query($conn, "SELECT Quantity FROM product WHERE name = '$product_name'");
    $product_data = mysqli_fetch_assoc($select_Quantity);
    
    if ($update_quantity <= $product_data['Quantity']) {
        mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
        $message[] = 'Cart quantity updated successfully!';
    } else {
        echo "<script>alert('Stock not available!')</script>";
    }
}

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
    // header('location:add_cart.php'); 
    exit(); 
}
    
    

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
  // header('location:index.php'); 
}
 
    
if(isset($_GET['delete_all'])){
  mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id' AND user_phone = '$user_phone' AND user_email = '$user_email'") or die('query failed');
//   header('location:index.php');
}


 ?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css1/style.css">

   <title>Shopping Cart</title>

   <!-- custom css file link  -->

</head>
<body>




    <?php
    if(isset($message)) {
       foreach($message as $msg) {
          echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
       }
    }
    ?>


<div class="container">

<div class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>
      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>action</th>
         <th>total price</th>
         <th>status</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_name = '$user_name'AND user_id = '$user_id'AND user_phone = '$user_phone'AND user_email = '$user_email'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td ><?php echo $fetch_cart['name']; ?></td>
            <td>$<?php echo $fetch_cart['price']; ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="option-btn">
               </form>
            </td>
            <td><a href="add_cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
            <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
             <td><?php echo $fetch_cart['status']; ?></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">grand total :</td>
        <td><a href="index.php" class="btn" >Add TO Shopping</a></td>
         <td>$<?php echo $grand_total; ?>/-</td>
         <td>   <div class="cart-btn">  
      <a href="" onclick="" class="btn <?php ?>"> Confirm to Payment</a>
   </div></td>
      </tr>
   </tbody>
   </table>


</div>




    </div>
</body>
</html>
