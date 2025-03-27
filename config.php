<?php

$conn = mysqli_connect("localhost", "root", "", "phpcrud");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>