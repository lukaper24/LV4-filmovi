<?php

$conn = mysqli_connect("localhost", "root", "", "lv4_filmovi");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>