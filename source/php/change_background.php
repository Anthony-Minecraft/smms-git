<?php
session_start();
$new_img = $_GET['image'];
$_SESSION['login']['background'] = $new_img;
?>