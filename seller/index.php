<?php
include ('dbconnect.php');

if(isset($_POST['submit'])) {
    

    $photo_name = $_FILES['photo']['name'];
    $photo_temp = $_FILES['photo']['tmp_name'];
    $name = $_POST['name'];
    $price = $_POST['price'];
 $Quantity = $_POST['Quantity'];
    $target_directory = "../images/";
    $target_file = $target_directory . basename($photo_name);
    $out = move_uploaded_file($photo_temp, $target_file);
    
    
    if ($out) {

        $query =  "INSERT INTO product (name,price,image, Quantity) VALUES ('$name', '$price','$photo_name','$Quantity')";
     
    
     
        $result = mysqli_query($conn, $query);
         
         
        if($result)  {
            echo "<script>alert('Successfully')</script>";
        }  else {
            echo "<script>alert('Not Successful')</script>";
        }
    }  else {
        echo "<script>alert('Error uploading file')</script>";
    }
     
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 500px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        font-weight: bold;
    }
    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    input[type="file"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    textarea {
        resize: vertical;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 15px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }

</style>
</head>
<body>

<div class="container">
    <h2>Add Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" id="price"  name="price" min="0" required>
        </div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="Quantity">Quantity:</label>
            <input type="number" id="number" name="Quantity" min="1" value="1" required>
        </div>
        
        <input type="submit" value="Submit" name="submit">
    </form>

</div>

</body>
</html>
