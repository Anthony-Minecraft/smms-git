<?php
session_start();

$conn_servername = "indyandy.net";
$conn_username = "indyandy_myriware";
$conn_password = trim(file_get_contents("../../data/_"));

$common_ID = $_GET['id'];
$common_user = $_SESSION['login']['ID']['UUID'];

//add user
try {
    $conn = new PDO("mysql:host=$conn_servername;dbname=indyandy_myriware", $conn_username, $conn_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //start
    $sql = "INSERT INTO CommonsRegistry (CommonID, CommonUser, CommonRole)
    VALUES ('$common_ID', '$common_user', 'looker')";
    $conn->exec($sql);
    //end
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;

?>

You can close this tab