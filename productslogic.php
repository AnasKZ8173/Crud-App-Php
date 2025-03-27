<?php

include 'config.php';



if(isset($_POST['upload'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];

    $target = "images/".basename($image);

    $sql = "INSERT INTO products (p_name, p_desc, p_price, p_category, p_image) VALUES ('$name', '$description', '$price', '$category', '$image')";

    $query = mysqli_query($conn, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        header("Location: tables.php");
    } else {
        echo "Failed to upload image";
    }
}



if (isset($_POST['update'])) {


    $productId = mysqli_real_escape_string($conn, $_POST['productId']);
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $productDescription = mysqli_real_escape_string($conn, $_POST['productDescription']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
    $productCategory = mysqli_real_escape_string($conn, $_POST['productCategory']);

    // Update query to modify existing product details except the image
    $sql = "UPDATE products SET 
                p_name = '$productName', 
                p_desc = '$productDescription', 
                p_price = '$productPrice', 
                p_category = '$productCategory' 
            WHERE id = '$productId'";

    if (mysqli_query($conn, $sql)) {
        // Redirect to tables.php after successful update
        header("Location: tables.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if(isset($_POST['delete'])) {
    $productId = mysqli_real_escape_string($conn, $_POST['productId']);

    // Delete query to remove product from database
    $sql = "DELETE FROM products WHERE id = '$productId'";

    if (mysqli_query($conn, $sql)) {
        // Redirect to tables.php after successful delete
        header("Location: tables.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}


?>