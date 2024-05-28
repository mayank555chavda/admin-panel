<?php
include('dbconnect.php');

// if (isset($_POST['update_quantity'])) {
//     $product_id = $_POST['product_id'];
//     $new_quantity = $_POST['new_quantity'];
    
//     $query = "UPDATE product SET Quantity = '$new_quantity' WHERE id = '67'";
//     $result = mysqli_query($conn, $query);

//     if ($result) {
//         echo "Quantity updated successfully!";
//     } else {
//         echo "Error updating quantity: " . mysqli_error($conn);
//     }
// }



    $product_id = $_POST['product_id'];
    $requested_quantity = $_POST['requested_quantity'];


    $database_quantity_query = mysqli_query($conn, "SELECT Quantity FROM product WHERE id = '67'");
    $product_quantity_row = mysqli_fetch_assoc($database_quantity_query);
    $available_quantity = $product_quantity_row['Quantity'];

   
    $database_quantity_query1 = mysqli_query($conn, "SELECT quantity FROM cart WHERE id = '108'");
    $product_quantity_row1 = mysqli_fetch_assoc($database_quantity_query1);
    $requested_quantity = $product_quantity_row1['quantity'];  


    if ($requested_quantity <= $available_quantity) {
        $new_quantity = $available_quantity - $requested_quantity;
        $update_query = "UPDATE product SET Quantity = '$new_quantity' WHERE id = '67'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo "Purchase successful!";
        } else {
            echo "Error updating quantity: " . mysqli_error($conn);
        }
    } else {
        echo "Requested quantity not available!";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
</head>
<body>

<!--<form method="post">-->
<!--    <input type="hidden" name="product_id" value="PRODUCT_ID_HERE">-->
<!--    Requested Quantity: <input type="number" name="new_quantity" min="1">-->
<!--    <input type="submit" name="update_quantity" value="Update Quantity">-->
<!--</form>-->
   
<!--<form action="" method="post">-->
<!--    <input type="hidden" name="product_id" value="PRODUCT_ID_HERE">-->
    <!--Requested Quantity: <input type="number" name="requested_quantity" min="1">-->
<!--    <input type="submit" name="purchase" value="Purchase">-->
<!--</form>-->

</body>
</html>
