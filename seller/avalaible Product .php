<?php 
    include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Distribute space evenly between products */
}

.product {
    width: calc(25% - 20px); /* Each product takes up one-third of the container width with some spacing */
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    box-sizing: border-box; /* Include padding and border in the total width */
}

.product img {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

.details {
    text-align: center;
}

.details h2 {
    margin-top: 0;
    font-size: 1.2rem;
}

.price {
    color: #009688;
    font-size: 1rem;
}

@media screen and (max-width: 768px) {
    .product {
        width: calc(50% - 20px); /* Each product takes up half of the container width on smaller screens */
    }
}

    </style>
</head>
<body>
    <div class="container">
 
            <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
          <div class="product">
         <img style ="height:200px; width:100%;" src="../images/<?php echo $fetch_product['image']; ?>" alt="">
            <div class="details">
             <h2><?php echo $fetch_product['name']; ?></h2>
             <p class="price">$<?php echo $fetch_product['price']; ?>/-</p>
            </div>
              </div>
   <?php
      };
   };
   ?>
 
       
    </div>
</body>
</html>
