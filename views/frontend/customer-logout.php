<?php 
session_start();
unset($_SESSION['logincustomer']);
unset($_SESSION['name']);
unset($_SESSION['user_id']);
unset($_SESSION['image']);
header('location:index.php')
?>