<?php
// include database connection file
$connect=mysqli_connect("localhost", "root", "","ledom");

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($connect, "DELETE FROM account WHERE id_admin=$id");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:signupPage.php");
?>