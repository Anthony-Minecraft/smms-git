<?php
session_start();
$new_img = trim($_GET['image']);
$_SESSION['login']['background'] = $new_img;
?>