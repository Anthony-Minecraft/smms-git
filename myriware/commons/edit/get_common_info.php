<?php
session_start();
$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../../data/_"));
$common_id = trim($_GET['id']);

try {
    $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //start
    $stmt = $conn->prepare("SELECT CommonOwner, CommonName, CommonDescription FROM CommonsSetup WHERE CommonID='$common_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $key=>$value) { }
    echo json_encode($stmt->fetchAll());
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>