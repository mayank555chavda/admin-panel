
<?php
include 'dbconnect.php';

if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    $update_query = "UPDATE `cart` SET `status` = '$new_status' WHERE `id` = '$order_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>alert('Status updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update status: " . mysqli_error($conn) . "');</script>";
    }

    
    if ($new_status == 'success') {
        $product_id = $_POST['product_id'];
        $requested_quantity = $_POST['requested_quantity'];

        $database_quantity_query = mysqli_query($conn, "SELECT Quantity FROM product WHERE id = '$product_id'");
        $product_quantity_row = mysqli_fetch_assoc($database_quantity_query);
        $available_quantity = $product_quantity_row['Quantity'];

        if ($requested_quantity <= $available_quantity) {
            $new_quantity = $available_quantity - $requested_quantity;
            $update_query = "UPDATE product SET Quantity = '$new_quantity' WHERE id = '$product_id'";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                echo "";
            } else {
                echo "Error updating quantity: " . mysqli_error($conn);
            }
        } else {
            echo "Requested quantity not available!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css1/style.css">
    <style>
        .container {
            max-width: 0;
            margin: 0;
            padding: 0;
        }
        select {
            font-size: 25px;
        }
        input {
            font-size: 30px;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="shopping-cart">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Phone</th>
                    <th>User Email</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $select_product = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                    if (mysqli_num_rows($select_product) > 0) {
                        while ($fetch_product = mysqli_fetch_assoc($select_product)) {
                    ?>
                            <tr>
                                <td><?php echo $fetch_product['id']; ?></td>
                                <td><?php echo $fetch_product['product_id']; ?></td>
                                <td><?php echo $fetch_product['user_id']; ?></td>
                                <td><?php echo $fetch_product['user_name']; ?></td>
                                <td><?php echo $fetch_product['user_phone']; ?></td>
                                <td><?php echo $fetch_product['user_email']; ?></td>
                                <td><img src="../images/<?php echo $fetch_product['image']; ?>" height="100" alt=""></td>
                                <td><?php echo $fetch_product['name']; ?></td>
                                <td>$<?php echo $fetch_product['price']; ?>/-</td>
                                <td><?php echo $fetch_product['quantity']; ?></td>
                                <td><?php echo $fetch_product['status']; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $fetch_product['product_id']; ?>">
                                        <input type="hidden" name="order_id" value="<?php echo $fetch_product['id']; ?>">
                                        <input type="hidden" name="requested_quantity" value="<?php echo $fetch_product['quantity']; ?>">
                                        <select name="new_status">
                                            <option value="pending" <?php if ($fetch_product['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                            <option value="success" <?php if ($fetch_product['status'] == 'success') echo 'selected'; ?>>Success</option>
                                            <option value="deleted" <?php if ($fetch_product['status'] == 'deleted') echo 'selected'; ?>>Deleted</option>
                                        </select>
                                        <input type="submit" name="update_status" value="Update">
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    };
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>




   
         
