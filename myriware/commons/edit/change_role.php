<?php

session_start();

include "get_common_info.php";

if (get()[0]['CommonOwner'] !== $_SESSION['login']['ID']['UUID']) {
    exit;
}

$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../../data/_"));

$new_role = trim($_GET['role']);
$user = $_GET['user'];
$id = $_GET['id'];

try {
    $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //start
    $stmt = $conn->prepare("UPDATE CommonsRegistry SET CommonRole = '$new_role' WHERE CommonUser = '$user' AND CommonID = '$id'");
    $stmt->execute();
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>