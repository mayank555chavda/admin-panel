<?php
include 'dbconnect.php';
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_phone = $_SESSION['user_phone'];
$user_email = $_SESSION['user_email'];

if (!isset($user_name) || !isset($user_id) || !isset($user_phone) || !isset($user_email)) {
    header('location:form_page/login_page.php');
    exit;
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $select_id_query = mysqli_query($conn, "SELECT id FROM product WHERE name = '$product_name'");
    $select_id_row = mysqli_fetch_assoc($select_id_query);
    $product_id = $select_id_row['id'];

    $select_Quantity_query = mysqli_query($conn, "SELECT Quantity FROM product WHERE name = '$product_name'");
    $product_data = mysqli_fetch_assoc($select_Quantity_query);
    $available_quantity = $product_data['Quantity'];

    if ($product_quantity <=  $available_quantity) { 
        $select_cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");
        if (mysqli_num_rows($select_cart_query) > 0) {
            echo "<script>alert('Product already added to cart!')</script>";   
        } else {
            mysqli_query($conn, "INSERT INTO `cart`(user_name, user_id, product_id, user_phone, user_email, name, price, image, quantity, status) VALUES ('$user_name', '$user_id', '$product_id', '$user_phone', '$user_email', '$product_name', '$product_price', '$product_image', '$product_quantity', 'pending')") or die('query failed');
            echo "<script>alert('Product added to cart!')</script>";
            // header('location:add_cart.php');
            exit;
        }
    } else {
        echo "<script>alert('Stock not available!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>


   <link rel="stylesheet" href="css1/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   <style>
   </style>
</head>
<body>
    <div class="container">
        <div class="products">
            <h1 class="heading">Latest Products</h1>
            <a href="https://mayank.marutiinstituteofdesign.com/shopping%20cart(1)/add_cart.php">
                <i class="fa-solid fa-cart-shopping" style="color:black;font-size:50px;float:right;"></i>
            </a>
            <div class="box-container">
                <?php
                $select_product = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
                if(mysqli_num_rows($select_product) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_product)){
                ?>
                
                <form method="post" class="box">
                    <img class="product-image" src="images/<?php echo $fetch_product['image']; ?>" alt="">
                    
                    <div class="product-info">
                        <div class="name"><?php echo $fetch_product['name']; ?></div>
                        <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                        
                        <input type="number" min="1" name="product_quantity" value="1">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        
                         
                       <a href="review.php?product_id=<?php echo $fetch_product['id']; ?>" class="btn">Review</a>
                        <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
                        <div class="" id="reting">
                            <?php 
                                $reting = $fetch_product['reting']; 
                                if ($reting == 0) {
                                    echo '<img src="rating_image/Star_rating_0.png" alt="">';
                                }
                                 else if ($reting <= 0.5) {
                                    echo '<img src="rating_image/Star_rating_0.5.png" alt="">';
                                }
                                 else if ($reting <= 1) {
                                    echo '<img src="rating_image/Star_rating_1.png" alt="">';
                                }  
                                 else if ($reting <= 1.5) {
                                    echo '<img src="rating_image/Star_rating_1.5.png" alt="">';
                                }                                
                                 else if ($reting <= 2) {
                                    echo '<img src="rating_image/Star_rating_2.png" alt="">';
                                }
                                 else if ($reting <= 2.5) {
                                    echo '<img src="rating_image/Star_rating_2.5.png" alt="">';
                                }
                                 else if ($reting <= 3) {
                                    echo '<img src="rating_image/Star_rating_3.png" alt="">';
                                }
                                 else if ($reting <= 3.5) {
                                    echo '<img src="rating_image/Star_rating_3.5.png" alt="">';
                                }                                
                                 else if ($reting <= 4) {
                                    echo '<img src="rating_image/Star_rating_4.png" alt="">';
                                }
                                 else if ($reting <= 4.5) {
                                    echo '<img src="rating_image/Star_rating_4.5.png" alt="">';
                                }
                                 else if ($reting >= 5) {
                                    echo '<img src="rating_image/Star_rating_5.png" alt="">';
                                }                                  
                            ?>
                             <div class="" style= "color:black"><?php echo $fetch_product['discripstion']; ?></div>
                        </div>
                    </div>
                </form>
                <?php }
                }  ?>
            </div>
        </div>
    </div>

    <script>
    </script>
</body>
</html>
