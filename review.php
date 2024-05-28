<?php
include 'dbconnect.php';

if (isset($_POST['add_to_review'])) {
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $star_value = $_POST['star_value'];
        $description = $_POST['discripstion'];

        if (!empty($star_value) && !empty($description)) {
            $insert_review = mysqli_query($conn, "INSERT INTO review (value, discripstion, product_id) VALUES ('$star_value', '$description', '$product_id')");
            if ($insert_review) {
                
                
               $select_reviews = mysqli_query($conn, "SELECT discripstion AS total_stars FROM review WHERE product_id = '$product_id'");
                $row = mysqli_fetch_assoc($select_reviews);
                $total_stars = $row['total_stars'] ; 
                
                $update_rating = mysqli_query($conn, "UPDATE product SET  discripstion = '$total_stars' WHERE id = '$product_id'");
                if ($update_rating) {
                    echo "<script>alert('Review added successfully!')</script>";
                } else {
                    echo "<script>alert('Failed to add review!')</script>";
                }
                
                
                
                $select_reviews = mysqli_query($conn, "SELECT SUM(value) AS total_stars FROM review WHERE product_id = '$product_id'");
                $row = mysqli_fetch_assoc($select_reviews);
                $total_stars = $row['total_stars'] / 10;


                $update_rating = mysqli_query($conn, "UPDATE product SET reting = '$total_stars' WHERE id = '$product_id'");

                if ($update_rating) {
                    echo "<script>alert('Review added successfully!')</script>";
                } else {
                    echo "<script>alert('Failed to add review!')</script>";
                }
            } else {
                echo "<script>alert('Failed to add review!')</script>";
            }
        } else {
            echo "<script>alert('Both star value and description are required!')</script>";
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
   <title></title>
   <link rel="stylesheet" href="css1/style.css">
 
   
   <style>
    .star {
        font-size: 50px;
        cursor: pointer;
    }
    .card {
        width: auto;    
    }
    .box {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        color:black;
    }
    .three {
        color:orange;
    }
   </style>
   
   
</head>
<body>
    
    <div class="container">
        <form method="post" class="box">
            <div class="card" name="rating">
                <span onclick="gfg(1)" class="star" name="star">★</span>
                <span onclick="gfg(2)" class="star" name="star">★</span>
                <span onclick="gfg(3)" class="star" name="star">★</span>
                <span onclick="gfg(4)" class="star" name="star">★</span>
                <span onclick="gfg(5)" class="star" name="star">★</span>
            </div>
             <input type="hidden" id="valueofstar" name="star_value">
             <!--<input type="hidden" id="valuesumstar" name="star_sum">-->
            
            <div class="form-group">
                <label for="discripstion">Description:</label><br>
                <input type="text" id="discripstion" name="discripstion" style="width:200px;font-size:20px" required>
            </div>
            <input type="submit" value="Add to review" name="add_to_review" class="btn">
        </form>
    </div>


    <script>
    let stars = document.getElementsByClassName("star");

    function gfg(n) {
        remove();
        for (let i = 0; i < n; i++) {
            stars[i].classList.add("three");
        }
        document.getElementById("valueofstar").value += n;
        
        // document.getElementById("valuesumstar").value += n/10;
    }

    

    function remove() {
        for (let i = 0; i < stars.length; i++) {
            stars[i].classList.remove("three");
        }
    }
    
      
     
    
    </script>


    
    
    
</body>
</html>
