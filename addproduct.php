<?php

include 'components/sidenav.php';
include 'components/nav.php';

include 'config.php';
?>

<div class="form-container">
    <h2 class="text-center text-white">Add Product</h2>
    <form id="productForm" action="productslogic.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label text-white">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            <small class="text-danger" id="nameError"></small>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
            <small class="text-danger" id="descError"></small>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Price</label>
            <input type="number" name="price" id="price" class="form-control" required>
            <small class="text-danger" id="priceError"></small>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Category</label>
            <select name="category" id="category" class="form-control" required>
                <option value="">Select Category</option>
                <option value="Electronics">Electronics</option>
                <option value="Clothing">Clothing</option>
                <option value="Accessories">Accessories</option>
            </select>
            <small class="text-danger" id="categoryError"></small>
        </div>

               <!-- Image Upload Field -->
        <div class="mb-3">
            <label class="form-label text-white">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/jpeg, image/png" required>
            <small class="text-danger" id="imageError"></small>
        </div>

        <button type="submit" name="upload" class="btn btn-primary w-100">Add Product</button>
    </form>
</div>


<script>
    document.getElementById("productForm").addEventListener("submit", function(event) {
        let valid = true;

        // Name Validation
        let name = document.getElementById("name").value;
        if (name.length < 3) {
            document.getElementById("nameError").innerText = "Name must be at least 3 characters.";
            valid = false;
        } else {
            document.getElementById("nameError").innerText = "";
        }

        // Description Validation
        let description = document.getElementById("description").value;
        if (description.length < 10) {
            document.getElementById("descError").innerText = "Description must be at least 10 characters.";
            valid = false;
        } else {
            document.getElementById("descError").innerText = "";
        }

        // Price Validation
        let price = document.getElementById("price").value;
        if (price <= 0 || isNaN(price)) {
            document.getElementById("priceError").innerText = "Enter a valid price greater than 0.";
            valid = false;
        } else {
            document.getElementById("priceError").innerText = "";
        }

        // Category Validation
        let category = document.getElementById("category").value;
        if (category === "") {
            document.getElementById("categoryError").innerText = "Please select a category.";
            valid = false;
        } else {
            document.getElementById("categoryError").innerText = "";
        }
        if (!imageFile) {
            document.getElementById("imageError").innerText = "Please upload an image.";
            valid = false;
        } else {
            let allowedTypes = ["image/jpeg", "image/png"];
            if (!allowedTypes.includes(imageFile.type)) {
                document.getElementById("imageError").innerText = "Only JPG and PNG formats are allowed.";
                valid = false;
            } else if (imageFile.size > 2 * 1024 * 1024) { // 2MB limit
                document.getElementById("imageError").innerText = "Image must be less than 2MB.";
                valid = false;
            } else {
                document.getElementById("imageError").innerText = "";
            }
        }

        if (!valid) {
            event.preventDefault(); // Stop form submission if validation fails
        }
    });
</script>

<?php
include 'components/footer.php';
?>      




