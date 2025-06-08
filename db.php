<?php
$error = "";
$conn = mysqli_connect("localhost", "root", "", "project1");
if (!$conn) {
    $error = "Connection failed: " . mysqli_connect_error();
};
$result = mysqli_query($conn, "SELECT * FROM users");
if (!$result) {
    $error = "Query failed: " . mysqli_error($conn);
} else {
    echo "Query executed successfully.";
}